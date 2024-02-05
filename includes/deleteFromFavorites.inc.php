<?php  
    if(isset($_POST['removefav'])){
        session_start();
        include "../db/db-inc.php";
        $userId = $_SESSION["userid"];
        $bookId = $_POST['book_id'];
        $sql = "DELETE FROM tblfavorites WHERE user_id = '$userId' AND book_id = '$bookId';";
        $result = mysqli_query($conn, $sql);
        header("location: ../favorites.php");
        exit();
    }
    else{
        header("location: ../favorites.php");
        exit();
    }
?>