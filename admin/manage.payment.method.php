<?php
    include('partials/admin-header.php');

?>

    <!---main section--->
    <div class="main" style="height:100%;">
        <div class="container">
            <h2>MANAGE PAYMENT METHOD</h2>

            <?php
                if (isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <a href="<?php echo SITEURL; ?>admin/add.paymethod.php" class="button">ADD PAYMENT METHOD</a>

            <table class="tbl-full" style="height:auto;">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //TO GET DATA
                    $sql = "SELECT * FROM payment_method;";
                    //CATCHER
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE){
                        // PRESENT ROWS
                        $count = mysqli_num_rows($res);

                        if ($count > 0){
                            //Loop through data
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $name = $rows['name'];

                                ?>

                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update.paymethod.php?id=<?php echo $id; ?>" class="btn-green btn">Update Method</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete.paymethod.php?id=<?php echo $id; ?>" class="btn-red btn">Delete Method</a>
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