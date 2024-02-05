<?php
//include '../db/db-inc.php'; // Include the database connection file

 {
    $price = $_POST['price'];

    switch ($price) {
        case "all":
            $sql = "SELECT * FROM tblbooks";
            break;
        case "0-10":
            $sql = "SELECT * FROM tblbooks WHERE price <= 10";
            break;
        case "11-20":
            $sql = "SELECT * FROM tblbooks WHERE price >= 11 AND price <= 20";
            break;
        case "21-30":
            $sql = "SELECT * FROM tblbooks WHERE price >= 21 AND price <= 30";
            break;
        case "31-40":
            $sql = "SELECT * FROM tblbooks WHERE price >= 31 AND price <= 40";
            break;
        case "41+":
            $sql = "SELECT * FROM tblbooks WHERE price >= 41";
            break;
        default:
            $sql = "SELECT * FROM tblbooks";
            break;
    }

  

}
?>