<?php

if(isset($_POST['buy'])){
        session_start();
        include "../db/db-inc.php";

        $userId = $_SESSION['userid'];
        $bookIds = $_POST['bookid'];
        
        if (!is_array($bookIds)) {
            $bookIds = array($bookIds); // Convert the book ID to an array
        }

        $query = "INSERT INTO tblorders (user_id, book_id) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        }
        
        if (mysqli_stmt_prepare($stmt, $query)) {


            mysqli_stmt_bind_param($stmt, "ii", $userId, $bookId);
        
            foreach ($bookIds as $bookId) {
                mysqli_stmt_execute($stmt);
            }
        
            mysqli_stmt_close($stmt);
        
            $bookIdList = implode(',', $bookIds); // Create a comma-separated string of book IDs
        
            $sql = "DELETE FROM tblcart WHERE user_id = ".$_SESSION['userid']." AND book_id IN ($bookIdList)";
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            header("location: ../cart.php");
            exit();
        } else {
            echo "Statement preparation error: " . mysqli_error($conn);
    }