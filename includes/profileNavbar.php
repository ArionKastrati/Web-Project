<div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div style="position:relative; left:20%" class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <?php 
                            
                            if(isset($_SESSION["userid"])){
                                if($_SESSION["user_role"] == "Admin"){
                                    echo "<a href='admin/adminDashboard.php' class='nav-item nav-link'>Dashboard</a>"; 
                                } 
                                else if ($_SESSION["user_role"] == "Normal user"){
                                   echo "<a href='contact.php' class='nav-item nav-link'>Contact</a>";                                }
                            }

                            ?>
                        </div>
                        <div style="position:relative; left: 10%" class="navbar-nav ml-auto py-0">
                            <?php 
                            
                            if(isset($_SESSION["userid"])){
                                echo "<a href='includes/logout.inc.php' class='nav-item nav-link'>Log out</a>";
                                echo "<a href='profile.php?edit=false' class='nav-item nav-link'>Profile</a>";   
                            }
                            else{
                                echo " <a href='login.php' class='nav-item nav-link'>Login</a>";
                                echo "<a href='register.php' class='nav-item nav-link'>Sign up</a>";
                            }
                            
                            ?>
                           
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>