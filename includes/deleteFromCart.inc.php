<?php  
    if(isset($_POST['delete'])){
        session_start();
        include "../db/db-inc.php";
        $sql = "DELETE FROM tblcart WHERE user_id = ".$_SESSION['userid']." AND cart_id = ".$_POST['cartid'].";";
        $result = mysqli_query($conn, $sql);
        header("location: ../cart.php");
        exit();
    }
    else{
        header("location: ../cart.php");
        exit();
    }
?>