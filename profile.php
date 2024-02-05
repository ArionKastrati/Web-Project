<?php 
    header("location profile.php?edit=false");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>eLibrary</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link rel="stylesheet" href="./css/login.css">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Costumized design of the page -->
    <link href="./css/profile.css" rel="stylesheet">

</head>
<body>
    <!-- Top bar start -->
        <?php include "includes/profileTopbar.php"; ?>
    <!-- Top bar end -->

    <!-- Nav Bar start -->
    <?php include "includes/profileNavbar.php"; ?>
    <!-- Nav bar end -->

    <?php 
            
            if(isset($_SESSION["userid"])){
                if($_GET['edit'] == 'false'){
                    echo " <form method='POST' action='includes/profile.inc.php' class = 'profile-card'>";
                }
                else if (
                    include 'includes/editCases.inc.php'
                ){
                   include 'includes/trueform.inc.php';
                }
                if($_GET['edit'] == 'false'){
                echo"
                    <img class='img' src=" .$_SESSION['profilePic']." alt=''>
                    <div class='infos'>
                    <div class='infos-data'>";
                }
                else if(include 'includes/editCases.inc.php'){
                    echo"
                    <div> 
                        <img style='postion:relative; left:40%; top:-2%; z-index:1;' class='img' src=" .$_SESSION['profilePic']." alt=''>
                        <button class='btn' type='submit' name='profilePic' style='display:inline-block; width:11vw; margin-left:40%; z-index:2'> Edit profile pic </button>
                    </div>
                    <div class='infos'>
                    <div class='infos-data'>";
                }
                    if($_GET['edit'] == 'false'){
                    echo"  <h3 class='category'>Username: </h3>
                            <h3 class='data'>".$_SESSION['username']."</h3>";
                    }        
                    else if(include 'includes/editCases.inc.php'){
                                echo "<input name='username' style='width:60%; margin-top:0vh; position:relative; left:20%'  class='form-control' placeholder='Username' type='text' value=".$_SESSION['username'].">";
                            }
                         
                            echo "
                        </div>
                        <div class='infos-data'>";
                            if($_GET['edit'] == 'false'){
                                echo "<h3 class='category'>Fullname: </h3>
                                    <h3 class='data'>".$_SESSION['fullname']."</h3>";
                            }
                            
                            else if(include 'includes/editCases.inc.php'){
                                    echo "<input name='fullname' style='width:60%; margin-top:0.8vh; position:relative; left:20%' class='form-control' placeholder='Fullname' type='text' value=".$_SESSION['fullname'].">";
                                }
                        echo"
                        </div>
                        <div class='infos-data'>";
                            if($_GET['edit'] == 'false'){
                                echo "  <h3 class='category'>Email: </h3>
                                <h3 class='data'>".$_SESSION['email']."</h3>";
                            }
                            else if(include 'includes/editCases.inc.php'){
                                    echo "<input name='email' style='width:60%; margin-top:0.8vh; position:relative; left:20%'  class='form-control' placeholder='Email' type='text' value=".$_SESSION['email'].">";
                                }
                                
                        echo"
                        </div>
                        <div class='infos-data'>";
                         if($_GET['edit'] == 'false'){
                            echo"<h3 class='category'>Password: </h3>
                            <h3 class='data'>********</h3>";
                        }
                            else if(include 'includes/editCases.inc.php'){
                                echo "<input name='password' style='width:60%; margin-top:0.8vh; position:relative; left:20%'  class='form-control' placeholder='Password' type='password' value=".$_SESSION['password'].">";
                            }
                            
                        echo"
                        </div>";
                        if($_GET['edit'] == 'false'){
                           
                            }
                        else if(include 'includes/editCases.inc.php'){
                            echo "<div class='infos-data'>
                                 <input name='pwdRepeat' style='width:60%; margin-top:0.8vh; position:relative; left:20%'  class='form-control' placeholder='Repeat password' type='password' value=".$_SESSION['password'].">";
                            }
                    }
                    include 'includes/wrongEdit.inc.php';
                    if($_GET['edit'] === 'false'){
                     echo"<div class='button'>
                        <button name = 'edit' type='submit' class='btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 edit'>Edit</button>
                        </div>";
                    }
                    else if (include 'includes/editCases.inc.php')
                        echo"<div class='button'>
                        <button style='width:60%; position:relative; left:20%' name='save' type='submit' class='btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 save'>Save</button>
                        </div>";
                    ?>
            </div>
    </form>
</body>
</html>