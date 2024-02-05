<?php 

    if(isset($_POST['favbtn'])){
        require_once "../db/db-inc.php";
        require_once "functions.inc.php";
        session_start();
        $userId = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $bookId = $_POST['book_id'];

        addFavorites($conn, $userId, $username, $bookId);
        
    } else{
        header("location: ../shop.php");
        exit();
    }