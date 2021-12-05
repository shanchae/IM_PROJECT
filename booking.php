<?php
        include('partials-front/header.php');
?>
    <!---main section--->
    <div style="background-color:#F7DAD9; height:100%; padding-top:1em; padding-bottom:1em;">
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">
            <?php
                if (isset($_SESSION['name'])){
                    echo $_SESSION['name'];
                    unset($_SESSION['name']);
                }

                if (isset($_SESSION['contacts'])){
                    echo $_SESSION['contacts'];
                    unset($_SESSION['contacts']);
                }
                if (isset($_SESSION['event'])){
                    echo $_SESSION['event'];
                    unset($_SESSION['event']);
                }
                if (isset($_SESSION['menu'])){
                    echo $_SESSION['menu'];
                    unset($_SESSION['menu']);
                }
                if (isset($_SESSION['book'])){
                    echo $_SESSION['book'];
                    unset($_SESSION['book']);
                }
            ?>
                <h2> Order Form</h2>
                <div class="input">
                    <div>
                        <label for="customer_name">Full Name</label>
                    </div>
                    <div>
                        <input type="text" name="customer_name">
                    </div>
                    <div>
                        <label for="customer_number">Contact Number</label>
                    </div>
                    <div>
                        <input type="text" name="customer_number">
                    </div>
                    <div>
                        <label for="customer_email">Email Address</label>
                    </div>
                    <div>
                        <input type="email" name="customer_email">
                    </div>
                </div>
                <div class="input">
                    
                    Event Details

                    <select name="event" id="">
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM events;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $title = $row['title'];
                                    $id = $row['id'];
                        ?>
                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                            <?php 
                                }
                            } 
                        ?>
                    </select>
                            
                    <input type="datetime-local" name="event_start">
                    <input type="datetime-local" name="event_end">
                    <input type="text" name="event_address" placeholder="Address">                    
                     
                </div>

                <!-----MENUS CHOICES------->
                <h2>Menus</h2>
                <div class="input">
                
                    <div class="grid-container">
                        
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM menus_types;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image'];
                                    $descritpion = $row['description'];
                                    $price = $row['price'];
                        ?>
                            <div class="center">
                                <img src="<?php echo SITEURL; ?>images/menus/<?php echo $image_name; ?>" alt="" width="100px" height="200px">
                                <div>
                                    <h3><?php echo $title ?></h3>
                                    <p class="desc"><?php echo $descritpion; ?></p>
                                    <p><?php echo $price; ?></p>
                                </div>
                                <input type="checkbox" name="menu[]" value="<?php echo $id?>">
                            </div>
                            <?php 
                                }
                            }
                        ?>
                            
                    </div>
                </div>

                <!-----EXTRAS CHOICES------->
                <h2>Extras</h2>
                <div class="input">
                
                    <div class="grid-container">
                        
                        <?php
                            //to get data from database
                            $sql = "SELECT * FROM extras_types;";
                            //execute the query
                            $res = mysqli_query($conn, $sql);
                            //count rows
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image'];
                                    $descritpion = $row['description'];
                                    $price = $row['price'];
                        ?>
                            <div class="center">
                                <img src="<?php echo SITEURL; ?>images/extras/<?php echo $image_name; ?>" alt="" width="100px" height="200px">
                                <div>
                                    <h3><?php echo $title ?></h3>
                                    <p class="desc"><?php echo $descritpion; ?></p>
                                    <p><?php echo $price; ?></p>
                                </div>
                                <input type="checkbox" name="extra[]" value="<?php echo $id?>">
                            </div>
                            <?php 
                                }
                            }
                        ?>
                            
                    </div>
                </div>
                <center style="margin-top: 20px;">
                   <button class="button" type="submit" name="submit" >Submit</button> 
     
                </center>
                
            </form>
        </div>
    </div>

<?php 

    //to get data from form

    if(isset($_POST['submit'])){
        //assign values
        $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
        $customer_number = mysqli_real_escape_string($conn ,$_POST['customer_number']);
        $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
        $event_type = mysqli_real_escape_string($conn, $_POST['event']);
        $event_start = mysqli_real_escape_string($conn, $_POST['event_start']);
        $event_end = mysqli_real_escape_string($conn, $_POST['event_end']);
        $event_address = mysqli_real_escape_string($conn, $_POST['event_address']);
        //$menus = mysqli_real_escape_string($conn, $_POST['menu']);
        //$extras = mysqli_real_escape_string($conn, $_POST['extra']);
        $booking_id = rand(000, 999);
        $event_id = NULL;
        
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

        ///loop through checkboxes
       
        
        //for menus and extras bookings
        //loop through menus and extras selected
        //add a record to menu bookings/extras bookings
        /*foreach ($menus as $menu){
            $menu_booking_id = rand(000, 999);
            $sql = "INSERT INTO menus_bookings(id, type, bookingID) 
                    VALUES('$menu_booking_id', '$menu', '$booking_id');";
            $res = mysql_query($conn, $sql);
        }

        foreach ($extras as $extra){
            $extras_booking_id = rand(000, 999);
            $sql_ = "INSERT INTO extras_bookings(id, type, bookingID) 
                    VALUES('$extras_booking_id', '$extra', '$booking_id');";
            $res_ = mysql_query($conn, $sql_);
        }

        //SQL query to get menu total
        $sql_menu_total = "SELECT SUM(t.price) AS 'total'
            FROM menus_types t, menus_bookings b
            WHERE t.id = b.type
            AND b.bookingID = '$booking_id';";

        $res_menu = mysqli_query($conn, $sql_menu_total);
        //get result
        $row_menu = mysqli_fetch_assoc($res_menu);
        $menu_total = $row_menu['total'];

        //SQL query to get extras total
        $sql_extras_total = "SELECT SUM(t.price) AS 'total'
            FROM extras_types t, extras_bookings b
            WHERE t.id = b.type
            AND b.bookingID = '$booking_id';";

        $res_extras = mysqli_query($conn, $sql_extras_total);
        //get result
        $row_extras = mysqli_fetch_assoc($res_extras);
        $extras_total = $row_extras['total'];

        ///for payment
        $payment_id = rand(000, 999);*/

         ////for storing event details to event_details table
        $event_id = rand(000, 999);

        
        /*$query = "
        INSERT INTO payment_details(id, extras_total, menus_total, total, minPayment) 
        VALUES ('$payment_id', '$extras_total', '$menu_total', '$extras_total'+'$menu_total', ('$extras_total'+'$menu_total')/.50);";*/
        $query = "
            INSERT INTO event_details(id, event_type, startTime, endTime, eventAddress) 
            VALUES('$event_id', '$event_type', '$event_start', '$event_end', '$event_address');";

        $query .= "INSERT INTO bookings
                SET id = '$booking_id',
                customer_name = '$customer_name',
                customer_contact_no = '$customer_number',
                customer_email = '$customer_email',
                eventID = (
                SELECT id
                FROM event_details
                WHERE id = '$event_id')";

        $result = mysqli_multi_query($conn, $query);
        
        $_SESSION['book'] = "<h2 class='success'>OPERATION SUCCESSFUL. PLEASE WAIT FOR CONFIRMATION TO YOUR CONTACT INFO</h2>";
        
    }

?>

<?php
   

   include('partials-front/footer.php');
?>

