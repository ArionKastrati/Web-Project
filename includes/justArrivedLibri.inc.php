<?php 
if(isset($_POST['favbtn'])){
        require_once "../db/db-inc.php";
        require_once "functions.inc.php";
        session_start();
        $userId = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $bookId = $_POST['book_id'];

        justArrivedAddFavorites($conn, $userId, $username, $bookId);
        
    } else{
        header("location: ../index.php");
        exit();
}