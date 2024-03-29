
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>eLibrary</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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

</head>

<body>
    <!-- Topbar Start -->
    <?php
    include 'includes/topbar.php';
    ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php
    include 'includes/navbar.php';
    ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Book Title</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php
                        $userId = $_SESSION['userid'];
                        include "db/db-inc.php";
                        $sql = "SELECT c.cart_id, b.book_id, b.book_title, b.price FROM tblcart c
                                INNER JOIN tblbooks b ON c.book_id = b.book_id
                                AND user_id = ".$_SESSION['userid'].";";

                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if ($resultCheck > 0) {
                        while($row = mysqli_fetch_assoc($result)){ 
                            echo "
                            <tr>                            
                                <td class='align-middle'>".$row['book_title']."</td>
                                <td class='align-middle'>".$row['price']."€"."</td>
                                <td class='align-middle'>
                                    <form method='POST' action = 'includes/deleteFromCart.inc.php'>
                                    <input type='hidden' name='cartid' value=".$row['cart_id'].">
                                    <button name='delete' type='submit' class='btn btn-sm btn-primary'>
                                        <i class='fa fa-times'></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">
                                <?php

                                    $sql = "SELECT sum(b.price) AS totalPrice FROM tblbooks b
                                            INNER JOIN tblcart c ON c.book_id = b.book_id
                                            AND user_id = ".$_SESSION['userid'].";";
                                    
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);

                                    if ($resultCheck >= 0) {
                                        while($row = mysqli_fetch_assoc($result)){ 
                                            echo $row['totalPrice']."€";
                                        }
                                    }
                                    
                                ?>
                            </h5>
                        </div>
                        <?php 
                        $sql = "SELECT * FROM tblcart WHERE user_id = ".$_SESSION['userid'].";";
                                    
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);

                                    
                                    echo"
                        <form action='includes/buyFromCart.inc.php' method='POST'>";
                        if ($resultCheck >= 0) {
                            while($row = mysqli_fetch_assoc($result)){ 
                                echo "<input type='hidden' name='bookid' value=".$row['book_id'].">";
                            }
                        }
                        echo"
                        <button name='buy' class='btn btn-block btn-primary my-3 py-3'>Buy</button>
                        </form>          
                        ";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


    <!-- Footer Start -->

    <?php
    include 'includes/footer.php';
    ?>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>