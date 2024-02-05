<?php
    if(isset($_SESSION['userid'])){

    require "db/db-inc.php";

    $userId = $_SESSION['userid'];
    $query = "
            SELECT * from tblbooks tb
            INNER JOIN tblfavorites tf on tb.book_id = tf.book_id
            INNER JOIN tblusers tu on tu.user_id = tf.user_id
            WHERE tu.user_id = ?;
    ";

    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $query)){
        header('location: ../favorites.php');
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    while( $row = mysqli_fetch_assoc($results)){
    echo"
                <div class='col-lg-3 col-md-6 col-sm-12 pb-1'>
                    <div class='card product-item border-0 mb-4'>
                        <div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'>
                            <img style = 'height: 500px' class='img-fluid w-100' src=" . $row['book_photo'] . " alt=''>
                        </div>
                        <div class='card-body border-left border-right text-center p-0 pt-4 pb-3'>
                            <h6 class='text-truncate mb-3'>" . $row['book_title'] . "</h6>
                            <div class='d-flex justify-content-center'>
                            <h6>" . $row['price'] . "€</h6>
                            <p style='position:relative; left:30%; top:-2%' name='book_id'>".$row['quantity']."</p>
                        </div>
                    </div>
                    <div class='card-footer d-flex justify-content-between bg-light border'>
                    <form method='POST' action='includes/addFromFavorites.inc.php'>
                        <input name='book_id' type='hidden' value=".$row['book_id'].">
                        <button type='submit' name='addToCart' class='btn btn-sm text-dark p-0'><i class='fas fa-shopping-cart text-primary mr-1'></i>Add to Cart</button>
                    </form>
                    <form method='POST' action='includes/deleteFromFavorites.inc.php'>
                        <input name='book_id' type='hidden' value=".$row['book_id'].">
                        <button type='submit' style='position:relative; left:52%' name='removefav' class='btn btn-sm text-dark p-0'><i class='fas fa-shopping-cart text-primary mr-1'></i>Remove</button>
                    </form>
            </div>
        </div>
    </div>
";}
}