<?php

    //to get data from form

    if(isset($_POST['submit'])){
        //assign values
        $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
        $customer_number = mysqli_real_escape_string($conn ,$_POST['customer_number']);
        $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
        $event_type = mysqli_real_escape_string($conn, $_POST['event']);
        $start = mysqli_real_escape_string($conn, $_POST['event_start']);
        $end = mysqli_real_escape_string($conn, $_POST['event_end']);
        $address = mysqli_real_escape_string($conn, $_POST['event_address']);
        $menus = $_POST['menu'];
        $extras = $_POST['extra'];
        $booking_id = rand(000, 999);
        
        //no empty values to be inserted in database
        if($customer_name == ""){
            $_SESSION['name'] = "<p class='failed'>PLEASE FILL NAME</p>";

            die();
        }

        if($customer_number == "" && $customer_email == ""){
            $_SESSION['contacts'] = "<p class='failed'>PLEASE FILL CONTACTS</p>";

            die();
        }

        if(empty($_POST['menu']) || empty($_POST['extra'])){
            $_SESSION['menu'] = "<p class='failed'>PLEASE PICK YOUR MENU OR EXTRAS</p>";

            die();
        }


         ////for storing event details to event_details table*/
        $event_id = rand(000, 999);

        
        $query = "INSERT INTO event_details
            SET id = ?,
            startTime = ?,
            endTime = ?,
            eventAddress = ?,
            event_type = (
                SELECT id 
                FROM events
                WHERE id = ?);";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssi", $event_id, $start, $end, $address, $event_type);
        $stmt->execute();
        $stmt->close();

        $query_2 = "INSERT INTO bookings
            SET id = ?,
            customer_name = ?,
            customer_contact_no = ?,
            customer_email = ?,
            eventID = (
                SELECT id
                FROM event_details
                WHERE id = ?);";

        $stmt_2 = $conn->prepare($query_2);
        $stmt_2->bind_param("isssi", $booking_id, $customer_name, $customer_number, $customer_email, $event_id);
        $stmt_2->execute();
        $stmt_2->close();    

        $menu_query = "INSERT INTO menus_bookings
            SET
            bookingID = (
                SELECT id
                FROM bookings
                WHERE id = ?),
            type = (
                SELECT id
                FROM menus_types
                WHERE id = ?);";

        $menu_stmt = $conn->prepare($menu_query);
        $menu_stmt->bind_param("ii", $booking_id, $menu);

        foreach ($menus as $menu){
           $res = $menu_stmt->execute();
        }

        if(!$res){
            echo $conn->error;
        }

        $menu_stmt->close();


        $extras_query = "INSERT INTO extras_bookings
            SET
            bookingID = (
                SELECT id
                FROM bookings
                WHERE id = ?),
            type = (
                SELECT id
                FROM extras_types
                WHERE id = ?);";

        $extras_stmt = $conn->prepare($extras_query);
        $extras_stmt->bind_param("ii", $booking_id, $extra);

        foreach ($extras as $extra){
            $res2 = $extras_stmt->execute();
        }

    
         if(!$res2){
             echo $conn->error;
         }

        $extras_stmt->close();

        $payment_id = rand(000, 999);

        $menu_sql = "SELECT SUM(mt.price) as 'menu total'
        FROM menus_types mt, menus_bookings mb
        WHERE mt.id = mb.type
        AND mb.bookingID = ?;";

        $stmt_menu = $conn->prepare($menu_sql);
        $stmt_menu->bind_param("i", $booking_id);
        $stmt_menu->execute();
        $result_menu = $stmt_menu->get_result();
        $stmt_menu->close();
        $row_menu = $result_menu->fetch_assoc();
        $menu_total = $row_menu['menu total'];

        $extras_sql = "SELECT SUM(et.price) as 'extras total'
        FROM extras_types et, extras_bookings eb
        WHERE et.id = eb.type
        AND eb.bookingID = ?;";

        $stmt_extras = $conn->prepare($extras_sql);
        $stmt_extras->bind_param("i", $booking_id);
        $stmt_extras->execute();
        $result_extras = $stmt_extras->get_result();
        $stmt_extras->close();
        $row_extras = $result_extras->fetch_assoc();
        $extras_total = $row_extras['extras total'];

        $total = $menu_total + $extras_total;
        $min = $total * .50;

        $query_pay = "INSERT INTO payment_details
            SET id = ?,
            extras_total = ?,
            menus_total = ?,
            total = ?,
            minPayment = ?;
          ";


        $stmt_pay = $conn->prepare($query_pay);
        $stmt_pay->bind_param("iiiii", $payment_id, $extras_total, $menu_total, $total, $min);
        $res = $stmt_pay->execute();
        $stmt_pay->close();

        if(!$res){
            echo $conn->error;
        } 

        $query_booking = "UPDATE bookings
            SET receiptID = (
                SELECT id 
                FROM payment_details
                WHERE id = ?)
            WHERE id = ?;
          ";


        $stmt_bookings = $conn->prepare($query_booking);
        $stmt_bookings->bind_param("ii", $payment_id, $booking_id);
        $res_bookings = $stmt_bookings->execute();
        $stmt_bookings->close();

        $_SESSION['done'] = "<h2 class='success'>BOOKED SUCCESSFULLY</h2>";
    }

?>