<?php
        include('partials-front/header.php');

        $booking_id = rand(000, 999);
?>
    <!---main section--->
    <div style="background-color:#F7DAD9; height:100%; padding-top:1em; padding-bottom:1em;">
        <div class="form-container">
            <form action="<?php echo SITEURL; ?>booking.php?booking=<?php echo $booking_id; ?>" method="POST" class="form-overlay">
            <?php
                if (isset($_SESSION['menu'])){
                    echo $_SESSION['menu'];
                    unset($_SESSION['menu']);
                }

                
            ?>
                <input type="hidden" value="<?php echo $booking_id; ?>">
                <h2> Order Form</h2>

                <!-----MENUS CHOICES------->
                <h2>Choose Your Menu</h2>
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
                                <input type="checkbox" name="menu[]" value="<?php echo $id; ?>">
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
                                <input type="checkbox" name="extra[]" value="<?php echo $id; ?>">
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
    $menus = $_POST['menu'];
    $extras = $_POST['extra'];
    
    //no empty values to be inserted in database

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
            WHERE id = $menu;);";
        
        $res = mysqli_query($conn, $sql);
    }*/

    foreach ($extras as $extra){
        $extras_booking_id = rand(000, 999);

        $sql_ = "INSERT INTO extras_bookings
        SET id = $extras_booking_id,
        bookingID = (
            SELECT id
            FROM bookings
            WHERE id = $booking_id),
        type = (
            SELECT id
            FROM extrass_types
            WHERE id = $extra);";

        $res_ = mysqli_query($conn, $sql_);
    }
    
    
    //$_SESSION['book'] = "<h2 class='success'>OPERATION SUCCESSFUL. PLEASE WAIT FOR CONFIRMATION TO YOUR CONTACT INFO</h2>";
    
}

?>

<?php
   

   include('partials-front/footer.php');
?>

