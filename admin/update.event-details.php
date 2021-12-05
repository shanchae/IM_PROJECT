<?php
    include('partials/admin-header.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE EVENT DETAILS</h1>

            <?php
                //Get id to be edit
                $id = $_GET['id'];
                $booking = $_GET['booking'];
                //SQL query to get data
                $sql = "SELECT * FROM event_details WHERE id = $id;";

                //To execute the query
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE){
                    $count = mysqli_num_rows($res);

                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);
                        $id = $row['id'];
                        $event = $row['event_type'];
                        $start = $row['startTime'];
                        $end = $row['endTime'];
                        $eventAddress = $row['eventAddress'];

                    } else {
                        header('location:'.SITEURL.'admin/update.booking.php');
                    }
                }
            ?>

            <form action="" method="POST" class="form">
               <div>
                    <label for="event">Event Type:</label>
                    <input type="text" name="event" value="<?php echo $id; ?>">  
               </div>
               <div>
                    <label for="start">Time Start:</label>
                    <p><?php echo $start; ?></p>
                    <p>Change to:</p>
                    <input type="datetime-local" name="start" value="<?php echo $start; ?>">  
               </div>
               <div>
                    <label for="end">Time End:</label>
                    <p><?php echo $end; ?></p>
                    <p>Change to:</p>
                    <input type="datetime-local" name="end" value="<?php echo $end; ?>">  
               </div>
               <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?php echo $eventAddress; ?>">  
               </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>
        </div>
    </div>

<?php

    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $event = $_POST['event'];
        $eventAddress = $_POST['address'];

        if ($_POST['start']){
            $start = $_POST['start'];
        }

        if ($_POST['end']){
            $end = $_POST['end'];
        }

        //SQL query to to update admin
        $sql = "UPDATE event_details
            SET 
            event_type = '$event',
            startTime = '$start',
            endTime = '$end',
            eventAddress = '$eventAddress'
            WHERE id = $id;";

        //to execute the query

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            $_SESSION['update-event'] = "<h2 class='success'>UPDATE EVENT SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.bookings.php");
        } else {
            $_SESSION['update-event'] = "<h2 class='failed'>UPDATE EVENT FAILED</h2>";
            header("location:".SITEURL."admin/manage.bookings.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>