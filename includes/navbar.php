<div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 205px">
                        <a href="novel.php" class="nav-item nav-link">Novel</a>
                        <a href="action.php" class="nav-item nav-link">Action</a>
                        <a href="thriller.php" class="nav-item nav-link">Thriller</a>
                        <a href="fantasy.php" class="nav-item nav-link">Fantasy</a>
                        <a href="mister.php" class="nav-item nav-link">Mister</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Books</a>
                            <?php 
                            
                            if(isset($_SESSION["userid"])){
                            echo "<div class='nav-item dropdown'>
                                <a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown'>Pages</a>
                                <div class='dropdown-menu rounded-0 m-0'>
                                    <a href='cart.php' class='dropdown-item'>Shopping Cart</a>
                                    <a href='favorites.php' class='dropdown-item'>Favorites</a>
                                </div>
                            </div>
                            <a href='contact.php' class='nav-item nav-link'>Contact</a>";
                            }
                            else{
                                echo "<p class='nav-link dropdown-toggle' style='position:relative; left:10px; color:rgb(166, 165, 165)'> Pages </p>"; 
                                echo "<p style='position:relative; top:20px; left:20px; color:rgb(166, 165, 165)'> Contact </p>"; 
                                echo "<p style='position:relative; top:20px; left:40px; color:rgb(166, 165, 165)'> Dashboard </p>"; 
                            }
                            if(isset($_SESSION["userid"])){
                                if($_SESSION["user_role"] == "Admin"){
                                echo "<a href='admin/adminDashboard.php' class='nav-item nav-link'>Dashboard</a>";
                                }
                                else if ($_SESSION["user_role"] == "Normal user"){
                                echo "<p style='position:relative; top:20px; left:10px; color:rgb(166, 165, 165)'> Dashboard </p>"; 
                                }
                            }
                            
                            ?>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
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