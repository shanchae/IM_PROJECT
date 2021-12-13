<?php
        include('partials-front/header.php');
?>
    <!---main section--->
    <div style="background-color:#F7DAD9; height:100vh; padding-top:1em; padding-bottom:1em;">
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">
                <h2>Payment</h2>
                <div>
                
                    <label for="booking">Enter Code</label>
                    <input type="text" name="booking">
              
                   <button class="button" type="submit" name="submit" >Submit</button> 
                   
                </div>
            <?php
                if(isset($_POST['submit'])){
                    $booking = mysqli_real_escape_string($conn, $_POST['booking']);

                    if($booking){?>
                        <table class="tbl-full" style="height:auto;">
                            <tr>
                                <th>ID</th>
                                <th>Total</th>
                                <th>Menu Total</th>
                                <th>Extras Total</th>
                                <th>Minimum Payment</th>
                                <th>Paid</th>
                                <th>Balance</th>
                            
                            </tr>

                            <?php
                                //TO GET DATA
                                $sql = "SELECT * FROM payment_details
                                WHERE id = (
                                    SELECT receiptID
                                    FROM bookings
                                    WHERE id = $booking);";
                                //CATCHER
                                $res = mysqli_query($conn, $sql);

                                if ($res == TRUE){
                                    // PRESENT ROWS
                                    $count = mysqli_num_rows($res);

                                    if ($count > 0){
                                        //Loop through data
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $extras = $rows['extras_total'];
                                            $menu = $rows['menus_total'];
                                            $min = $rows['minPayment'];
                                            $paid = $rows['paid'];
                                            $balance = $rows['balance'];
                                            $total = $rows['total'];

                                            ?>

                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $total; ?></td>
                                                <td><?php echo $menu; ?></td>
                                                <td><?php echo $extras; ?></td>
                                                <td><?php echo $min; ?></td>
                                                <td><?php echo $paid; ?></td>
                                                <td><?php echo $balance; ?></td>
                                                <td><a href="https://www.paymaya.com/" class="btn-blue" style="color:white; padding:1em;">Pay With PayMaya</a></td>
                                            </tr>

                                        <?php
                                        }
                                    }
                                } else {

                                }

                            ?>
                            <?php
                            }
                        }
                            ?>
                    </table>
                </form>
        </div>
    </div>


<?php
   

   include('partials-front/footer.php');
?>

