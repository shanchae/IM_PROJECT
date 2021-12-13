<?php

    include('../configs/constants.php');

    //Getting the id of admin to be deleted
    $id = $_GET['id'];
    $booking = $_GET['booking'];

    //creating sql command to delete admin
    $sql = "DELETE FROM extras_bookings WHERE type=$id AND bookingID = $booking;";

    //to execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE){
        //creating session 
        $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/update.orders.php?booking='. $booking);
    } else {
        $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
        header('location:'.SITEURL.'admin/update.orders.php?booking='. $booking);
    }