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
        $menu_chk = "";
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

        //for menus and extras bookings
        //loop through menus and extras selected
        //add a record to menu bookings/extras bookings

        /*foreach ($menus as $menu){
            $menu_booking_id = rand(000, 999);

            $sql = "INSERT INTO menus_bookings
            SET id = $menu_booking_id,
            bookingID = (
                SELECT id
                FROM bookings
                WHERE id = $booking_id),
            type = (
                SELECT id
                FROM menus_types
                WHERE id = $menu);";
            
            $res = mysqli_query($conn, $sql);
        }*/

        foreach ($extras as $extra){
            $extras_booking_id = rand(000, 999);
            $sql_ = "INSERT INTO extras_bookings
            SET id = $extras_booking_id,
            bookingID = bookingID = (
                SELECT id
                FROM bookings
                WHERE id = $booking_id),
            type = (
                SELECT id
                FROM extrass_types
                WHERE id = $extra);";

            $res_ = mysqli_query($conn, $sql_);
        }

        ///for payment
        $payment_id = rand(000, 999);

         ////for storing event details to event_details table*/
        $event_id = rand(000, 999);

        
        /*$query = "
        INSERT INTO payment_details
        SET id = $payment_id,
        extras_total = $extras_total,
        menus_total = $menu_total,
        total = extras_total + menus_total,
        minPayment = (extras_total + menu_total)/.50;";*/
        
        $query = "INSERT INTO event_details
            SET id = $event_id,
            startTime = '$start',
            endTime = '$end',
            eventAddress = '$address',
            event_type = (
                SELECT id 
                FROM events
                WHERE id = $event_type);";

        $query .= "INSERT INTO bookings
            SET id = $booking_id,
            customer_name = '$customer_name',
            customer_contact_no = '$customer_number',
            customer_email = '$customer_email',
            eventID = (
                SELECT id
                FROM event_details
                WHERE id = $event_id)";

        $result = mysqli_multi_query($conn, $query);
        
        
        //$_SESSION['book'] = "<h2 class='success'>OPERATION SUCCESSFUL. PLEASE WAIT FOR CONFIRMATION TO YOUR CONTACT INFO</h2>";
        
    }

?>