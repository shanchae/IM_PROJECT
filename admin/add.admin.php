<?php
    include('partials/admin-header.php');
?>

    <!---main section--->
    <div class="main">
        <div class="add-body" style="height:57.6vh">
            <div class="container">
                <h1>ADD ADMIN</h1>

                <form action="" method="POST" class="form">
                    <div>
                            <label for="first-name">First Name</label>
                            <input type="text" name="first-name">  
                    </div>
                    <div>
                            <label for="last-name">Last Name</label>
                            <input type="text" name="last-name">  
                    </div>
                    <div>
                            <label for="username">Username</label>
                            <input type="text" name="username">  
                    </div>
                    <div>
                            <label for="password">Password</label>
                            <input type="password" name="password">  
                    </div>
                    <button class="button" type="submit" name="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>

<?php
    include('partials/footer.php');
?>

<?php

    //TO ADD VALUES TO ADMIN TABLE

    if(isset($_POST['submit'])){

        //GET DATA FROM FORM
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $username = $_POST['username'];
        $pwd = md5($_POST['password']);

        //SQL QUERY TO INSERT TO DB
        $sql = "INSERT INTO admin(fName, lName, uName, password)
                VALUES('$firstName', '$lastName', '$username', '$pwd');";

        //EXECUTING QUERY AND SAVING TO DB
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //TO CHECK IF QUEY IS EXECUTED
        if ($res == TRUE){
            $_SESSION['add'] = "<h2 class='success'>OPERATION SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.admin.php");
        } else {
            $_SESSION['add'] = "<h2 class='failed'>OPERATION FAILED</h2>";
            header("location:".SITEURL."admin/manage.admin.php");
        }

    }

?>