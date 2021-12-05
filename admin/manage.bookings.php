<?php
    include('partials/admin-header.php');

?>

    <!---main section--->
    <div class="main" style="height:100vh;">
        <div class="container">
            <h2>MANAGE BOOKINGS</h2>

            <?php

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['update-event'])){
                    echo $_SESSION['update-event'];
                    unset($_SESSION['update-event']);
                }

            ?>

            <table class="tbl-full" style="height:auto;">
                <tr>
                    <th>ID</th>
                    <th>Event ID</th>
                    <th>Customer Name</th>
                    <th>Customer Contact Number</th>
                    <th>Customer Email</th>
                    <th>Status</th>
                    <th>Receipt ID</th>
                   
                </tr>

                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM bookings;";
                    //CATCHER
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $event = $rows['eventID'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact_no = $rows['customer_contact_no'];
                                $customer_email = $rows['customer_email'];
                                $receipt = $rows['receiptID'];
                                $status = $rows['status'];

                                ?>

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $event; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact_no; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $receipt; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td class="btn-st">
                                        <a href="<?php echo SITEURL; ?>admin/update.booking.php?id=<?php echo $id; ?>" class="btn-green btn">Update</a>
                                       
                                    </td>
                                </tr>

                            <?php
                            }
                        }
                    } else {

                    }

                ?>
            </table>

        </div>
        
    </div>

<?php
    include('partials/footer.php');
?>
