<?php

    include('../configs/constants.php');

    //Getting the id of admin to be deleted
    $menu_id = $_GET['menu_id'];
    $id = $_GET['id'];
    $booking = $_GET['booking'];

    //creating sql command to delete admin
    $sql_menu = "DELETE FROM menus_bookings WHERE type=? AND bookingID = ?;";
    $stmt_menu = $conn->prepare($sql_menu);
    $stmt_menu->bind_param("ii", $menu_id, $booking);
    $stmt_menu->execute();

    $menu_sql = "SELECT SUM(mt.price) as 'menu total'
        FROM menus_types mt, menus_bookings mb
        WHERE mt.id = mb.type
        AND mb.bookingID = ?;";
    $stmt_menu2 = $conn->prepare($menu_sql);
    $stmt_menu2->bind_param("i", $booking);
    $stmt_menu2->execute();
    $result_menu = $stmt_menu2->get_result();
    $row_menu = $result_menu->fetch_assoc();
    $menu_total = $row_menu['menu total'];

    $extras_sql = "SELECT SUM(et.price) as 'extras total'
    FROM extras_types et, extras_bookings eb
    WHERE et.id = eb.type
    AND eb.bookingID = ?;";

    $stmt_extras = $conn->prepare($extras_sql);
    $stmt_extras->bind_param("i", $booking);
    $stmt_extras->execute();
    $result_extras = $stmt_extras->get_result();
    $row_extras = $result_extras->fetch_assoc();
    $extras_total = $row_extras['extras total'];

    $total = $menu_total + $extras_total;
    $min = $total * .50;

    $sql_pay = "UPDATE payment_details 
            SET
            extras_total = ?,
            menus_total = ?,
            total = ?,
            minPayment = ?;
          ";


    $stmt_pay = $conn->prepare($sql_pay);
    $stmt_pay->bind_param("iiii", $extras_total, $menu_total, $total, $min);
    $res = $stmt_pay->execute();

    if ($res == TRUE){
        //creating session 
        $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/update.orders.php?booking='. $booking.'&id='.$id);
    } else {
        $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
        header('location:'.SITEURL.'admin/update.orders.php?booking='. $booking.'&id='.$id);
    }