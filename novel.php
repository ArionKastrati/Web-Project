<?php include_once './db/db-inc.php'; ?>

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
    <div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">Novel</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="index.php">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Books</p>
                </div>
            </div>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php

            $sql1 = "
                            select *
                            from tblbooks 
                            WHERE genre=1;
                    ";
            $results = mysqli_query($conn, $sql1);
            $resultsCheck = mysqli_num_rows($results);
            include 'includes/libri.php';
            ?>

            <!-- Featured Start -->
            <?php include 'includes/featured.php'?>
            <!-- Featured End -->


            <!-- Products Start -->
            <div class="container-fluid pt-5">
                <div class="text-center mb-4">
                    <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
                </div>
                <div class="row px-xl-5 pb-3">
                    <?php

                    $sql = "
                            select *
                            from tblbooks
                            WHERE arrival_date >= (SELECT addDate(curdate(), INTERVAL -7 day)) AND genre=1;
                    ";
                    $results = mysqli_query($conn, $sql);
                    $resultsCheck = mysqli_num_rows($results);
                    include 'includes/libri.php';
                    ?>

                    <!-- Footer Start -->
                    <?php
                    include 'includes/footer.php';
                    ?>
                    <!-- Footer End -->


                    <!-- Back to Top -->
                    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


                    <!-- JavaScript Libraries -->
                    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                    <script
                        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
                    <script src="lib/easing/easing.min.js"></script>
                    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

                    <!-- Contact Javascript File -->
                    <script src="mail/jqBootstrapValidation.min.js"></script>
                    <script src="mail/contact.js"></script>

                    <!-- Template Javascript -->
                    <script src="js/main.js"></script>
</body>

</html>