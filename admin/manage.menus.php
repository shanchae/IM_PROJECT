<?php
    include('partials/admin-header.php');

?>

    <!---main section--->
    <div class="main" style="height:100%; padding-bottom:15em;">
        <div class="container">
            <h2>MANAGE MENUS</h2>
            <?php
                if (isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <a href="add.menus.php" class="button">ADD MENU</a>

            

            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM menus_types;";
                    //CATCHER
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $description = $rows['description'];
                                $price = $rows['price'];
                                $image = $rows['image'];

                                ?>

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><img src="<?php echo SITEURL; ?>images/menus/<?php echo $image; ?>" alt="" width="100px"></td>
                                    <td class="btn-st">
                                        <div><a href="<?php echo SITEURL; ?>admin/update.menus.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn-green btn">Update</a></div>
                                        <div><a href="<?php echo SITEURL; ?>admin/delete.menus.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn-red btn">Delete</a></div>
                                        
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
