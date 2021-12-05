<?php
    include('partials/admin-header.php');
?>

    <!---main section--->
    <div class="main">
        <div class="add-body" style="height:57.6vh">
            <div class="container">
            <h1>ADD PAYMENT METHOD</h1>

            <form action="" method="POST" class="form">
                <div>
                        <label for="name">Name</label>
                        <input type="text" name="name">  
                </div>
                <button class="button" type="submit" name="submit">Submit</button>
            </form>

            </div>
        </div>  
    </div>



<?php

    //TO ADD VALUES TO ADMIN TABLE

    if(isset($_POST['submit'])){

        //GET DATA FROM FORM
        $name = $_POST['name'];

        //SQL QUERY TO INSERT TO DB
        $sql = "INSERT INTO payment_method(name)
                VALUES('$name');";

        //EXECUTING QUERY AND SAVING TO DB
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //TO CHECK IF QUEY IS EXECUTED
        if ($res == TRUE){
            $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.payment.method.php");
        } else {
            $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
            header("location:".SITEURL."admin/manage.payment.method.php");
        }

    }

?>

<?php
    include('partials/footer.php');
?>