<?php
    include('partials/admin-header.php');
?>

    <div class="main" style="height:100vh;">

        <div class="container">
            <h1>UPDATE PAYMENT METHOD</h1>

            <?php
                //Get id of admin to be edit
                $id = $_GET['id'];
                //SQL query to get data
                $sql = "SELECT * FROM payment_method WHERE id = $id;";

                //To execute the query
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE){
                    $count = mysqli_num_rows($res);

                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);
                        $name = $row['name'];
                    } else {
                        header('location:'.SITEURL.'admin/manage.payment.method.php');
                    }
                }
            ?>

            <form action="" method="POST" class="form">
               <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?php echo $name; ?>">  
               </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
               <button class="button" type="submit" name="submit">Submit</button>
           </form>
        </div>
    </div>

<?php

    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $name = $_POST['name'];

        //SQL query to to update admin
        $sql = "UPDATE payment_method
            SET name = 'name'
            WHERE id = '$id';";

        //to execute the query

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            $_SESSION['update'] = "<h2 class='success'>UPDATE SUCCESSFUL</h2>";
            header("location:".SITEURL."admin/manage.payment.method.php");
        } else {
            $_SESSION['update'] = "<h2 class='failed'>UPDATE FAILED</h2>";
            header("location:".SITEURL."admin/manage.payment.method.php");
        }
    }
    
?>

<?php
    include('partials/footer.php');
?>