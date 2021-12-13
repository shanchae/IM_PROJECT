<?php
        include('partials-front/header.php');
?>
    <!---main section--->
    <div style="background-color:#F7DAD9; height:100vh; padding-top:1em; padding-bottom:1em;">
        <div class="form-container">
            <form action="" method="POST" class="form-overlay">
                <h2>Payment</h2>
                <div class="input">
                    <div>
                        <label for="booking">Enter Code</label>
                    </div>
                    <div>
                        <input type="text" name="booking">
                    </div>
                <center style="margin-top: 20px;">
                   <button class="button" type="submit" name="submit" >Submit</button> 
     
                </center>
                </div>

            </form>
        </div>
    </div>
<?php
    if(isset($_POST['submit'])){
    
        ///for payment
   

        //header("location:".SITEURL."pay.php");
    }
?>


<?php
   

   include('partials-front/footer.php');
?>

