<div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div style="position: relative; left:7%" class="col-lg-6 text-center text-lg-right">
            <?php 
            session_start();

            if(isset($_SESSION["userid"])){
                echo "Logged in as: ". $_SESSION["username"];
            }
            
            ?>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            
            <div class="col-lg-6 col-6 text-left">
            </div>
        </div>
    </div>