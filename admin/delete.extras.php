<?php 

    include('../configs/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image'])){

        ///get id to delete
        $id = $_GET['id'];
        $image = $_GET['image'];

        //to remove image file
        if ($image != ""){
            $path = "../images/extras/".$image;
            $remove = unlink($path);

            if($remove == FALSE){
                $_SESSION['remove'] = "<h2 class='failed'>FAILED TO REMOVE IMAGE</h2>";
                //redirect to manage page
                header('location:'.SITEURL.'admin/manage.extras.php');

                die();
            }
        }

        //creating sql command to delete
        $sql = "DELETE FROM extras_types WHERE id=$id;";

        //to execute the query
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE){
            //creating session 
            $_SESSION['delete'] = "<h2 class='success'>DELETED SUCCESSFULLY</h2>";
            //redirect to manage page
            header('location:'.SITEURL.'admin/manage.extras.php');
        } else {
            $_SESSION['delete'] = "<h2 class='failed'>DELETE FAILED</h2>";
            header('location:'.SITEURL.'admin/manage.extras.php');
        }

    } else {
        header('location:'.SITEURL.'admin/manage.extras.php');
    }
?>