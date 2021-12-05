<?php
    include('partials/admin-header.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE BOOKINGS</h1>

            <?php
                //Get id to be edit
                $id = $_GET['id'];
                //SQL query to get data
                $sql = "SELECT * FROM bookings WHERE id = $id;";

                //To execute the query
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE){
                    $count = mysqli_num_rows($res);

                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);
                        $event = $row['eventID'];
                        $customer_name = $row['customer_name'];
                        $customer_contact_no = $row['customer_contact_no'];
                        $customer_email = $row['customer_email'];
                        $receipt = $row['receiptID'];
                        $status = $row['status'];

                    } else {
                        header('location:'.SITEURL.'admin/manage.bookings.php');
                    }
                }
            ?>

            <form action="" method="POST" class="form">
               <div>
                    <label for="event">Event ID:</label>
                    <input type="text" name="event" value="<?php echo $event; ?>">  
               </div>
               <div>
                    <label for="name">Customer Name:</label>
                    <input type="text" name="name" value="<?php echo $customer_name; ?>">  
               </div>
               <div>
                    <label for="number">Customer Number:</label>
                    <input type="text" name="number" value="<?php echo $customer_contact_no; ?>">  
               </div>
               <div>
                    <label for="email">Customer Email:</label>
                    <input type="email" name="email" value="<?php echo $customer_email; ?>">  
               </div>
               <div>
                    <label for="receipt">Receipt:</label>
                    <input type="text" name="receipt" value="<?php echo $receipt; ?>">  
               </div>
               <div>
                    <label for="status">Status:</label>
                    <select name="status">
                        <option value="Confirmed">Confirmed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
               </div>
               
                <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
               <br><br>
               <a href="<?php echo SITEURL; ?>admin/update.event-details.php?$id=<?php echo $event; ?>&booking=<?php echo $id; ?>" class="btn-green btn">Go to event details</a>
           </form>
        </div>
    </div>


<?php

    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $event = $_POST['event'];
        $customer_name = $_POST['name'];
        $customer_contact_no = $_POST['number'];
        $customer_email = $_POST['email'];
        $receipt = $_POST['receipt'];
        $status = $_POST['status'];

        //SQL query to to update admin
        $sql = "UPDATE bookings
            SET eventID = $event,
            customer_name = '$customer_name',
            customer_contact_no = $customer_contact_no,
            customer_email = '$customer_email',
            receiptID = '$receipt',
            status = '$status',
            WHERE id = $id;";

        //to execute the query

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.bookings.php");
        } else {
            $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
            header("location:".SITEURL."admin/manage.bookings.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>