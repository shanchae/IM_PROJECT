<?php
    include('partials/admin-header.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE ADMIN</h1>

            <?php
                //Get id of admin to be edit
                $id = $_GET['id'];
                //SQL query to get data
                $sql = "SELECT * FROM admin WHERE id = $id;";

                //To execute the query
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE){
                    $count = mysqli_num_rows($res);

                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);
                        $fName = $row['fName'];
                        $lName = $row['lName'];
                        $uName = $row['uName'];
                    } else {
                        header('location:'.SITEURL.'admin/manage.admin.php');
                    }
                }
            ?>

            <form action="" method="POST" class="form">
               <div>
                    <label for="fName">First Name</label>
                    <input type="text" name="fName" value="<?php echo $fName; ?>">  
               </div>
               <div>
                    <label for="lName">Last Name</label>
                    <input type="text" name="lName" value="<?php echo $lName; ?>">  
               </div>
               <div>
                    <label for="uName">Username</label>
                    <input type="text" name="uName" value="<?php echo $uName; ?>">  
               </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>
        </div>
    </div>

<?php

    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $uName = $_POST['uName'];

        //SQL query to to update admin
        $sql = "UPDATE admin
            SET fName = '$fName',
            lName = '$lName',
            uName = '$uName'
            WHERE id = '$id';";

        //to execute the query

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.admin.php");
        } else {
            $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
            header("location:".SITEURL."admin/manage.admin.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>