<?php 

    if(isset($_POST["edit"])){
        header("location: ../profile.php?edit=true");
        exit();
    }
    else{
        header("location: ../profile.php?edit=false");
        exit();
    }