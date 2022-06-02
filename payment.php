<?php
        include('partials-front/header.php');
?>
    <!---main section--->
    <div style="background-color:#F7DAD9; min-height:100vh; padding-top:1em; padding-bottom:1em;">
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">
                <h2>Your Order</h2>
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
                                <th>Status</th>
                                <th></th>
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
                                            $status = $rows['status'];

                                            ?>

                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $total; ?></td>
                                                <td><?php echo $menu; ?></td>
                                                <td><?php echo $extras; ?></td>
                                                <td><?php echo $min; ?></td>
                                                <td><?php echo $paid; ?></td>
                                                <td><?php echo $balance; ?></td>
                                                <?php
                                        }
                                    }
                                }
                                //TO GET DATA
                                $sql = "SELECT * FROM bookings
                                WHERE id =  $booking;";
                                //CATCHER
                                $res = mysqli_query($conn, $sql);

                                if ($res == TRUE){
                                    // PRESENT ROWS
                                    $count = mysqli_num_rows($res);

                                    if ($count > 0){
                                        //Loop through data
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $transaction = $rows['transaction_status'];
                                            $status = $rows['status'];

                                            ?>
                                                <td><?php echo $status; ?></td>
                                                <td><?php echo $transaction; ?></td>
                                            </tr>

                                        <?php
                                        }
                                    }
                                } else {

                                }
                                ?>
                                </table>
                                <?php
                                if ($status == 'Pending'){
                                    ?>
                                    <br>
                                    <h3>Please wait for your order to be confirmed before paying.</h3>
                                    <?php
                                }
                    }
                }

                            ?>

                    <div>
                        <h2>We Accept Payment:</h2>
                        <div>
                            <h4>GCash</h4>
                            <ul>
                                <li>Go to GCash app and select "Send Money". Pick "Express Send".</li>
                                <li>Send to: 09326426458.</li>
                                <li>Enter amount.</li>
                                <li>Enter your name and given code as Message.</li>
                                <li>Example:</li>
                                <img src="./images/pay.jpg" style="width:400px;">
                            </ul>
                        </div>
                        <br>
                        <div>
                            <h4>Cash Payment</h4>
                            <ul>
                                <li>Visit our office at Poblacion, Jagna, Bohol.</li>
                            </ul>
                        </div>
                    </div>
                </form>
        </div>
    </div>


<?php
   

   include('partials-front/footer.php');
?>

