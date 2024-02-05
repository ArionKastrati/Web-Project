<?php
if(isset($_POST["addToCart"])){
    session_start();
    include "../db/db-inc.php";

    $userId = $_SESSION["userid"];
    $bookId = $_POST["book_id"];
    
    $sql = "INSERT INTO tblcart (user_id, book_id) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $userId, $bookId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        // Decrement the quantity of the book in tblbooks
        $updateSql = "UPDATE tblbooks SET quantity = quantity - 1 WHERE book_id = ?";
        $updateStmt = mysqli_stmt_init($conn);
        
        if (mysqli_stmt_prepare($updateStmt, $updateSql)) {
            mysqli_stmt_bind_param($updateStmt, "i", $bookId);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);
        } else {
            echo "Update statement preparation error: " . mysqli_error($conn);
        }
    
        mysqli_close($conn);
    
        header("location: ../favorites.php");
        exit();
    } else {
        echo "Statement preparation error: " . mysqli_error($conn);
    }
    
    }
else{
    header("location: ../favorites.php");
    exit();
}