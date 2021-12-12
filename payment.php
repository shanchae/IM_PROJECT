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
                <h2>Payment</h2>
                <div class="input">
                    <div>
                        <label for="booking">Enter Code</label>
                    </div>
                    <div>
                        <input type="text" name="booking">
                    </div>
                </div>

            </form>
        </div>
    </div>



<?php
   

   include('partials-front/footer.php');
?>

