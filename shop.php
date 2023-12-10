<?php include './db/db-inc.php'; ?>
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

    <!-- Customized Bootstrap Stylesheets -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <scrip src="../includes/light-dark-theme.inc.js"></script>

    <style>
        /* Custom styles for radio buttons */
        .btn-radio {
            padding: 10px 20px;
            border-radius: 4px;
        }

        .btn-radio input[type="submit"] {
            position: absolute;
            clip: rect(0, 0, 0, 0);
        }

        .btn-radio label {
            display: block;
            cursor: pointer;
        }

        .btn-radio input[type="submit"]:checked+label {
            background-color: #007bff;
            color: #fff;
        }
    </style>


    <script type="text/javascript">
        $(document).ready(function () {
            $('input[name=price]').change(function () {
                $('form').submit();
            });
        });
    </script>
</head>

<body>
    <form>
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
                    <h1 class="font-weight-semi-bold text-uppercase mb-3">Books</h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="index.php">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Books</p>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Shop Start -->
            <div class="container-fluid pt-5">
                <div class="row px-xl-5">
                    <!-- Shop Sidebar Start -->
                    <div class="col-lg-2 col-md-12">
                        <!-- Price Start -->
                        <div class="border-bottom mb-4 pb-4">
                            <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>

                            <form id="priceForm" method="POST" action="">
                                <div class="btn-group-vertical" data-toggle="buttons">
                                    <label class="btn btn-primary btn-radio">
                                        <input type="submit" name="price" value="all"> All
                                    </label>
                                    <label class="btn btn-primary btn-radio">
                                        <input type="submit" name="price" value="0-10"> $0-10
                                    </label>
                                    <label class="btn btn-primary btn-radio">
                                        <input type="submit" name="price" value="11-20"> $11-20
                                    </label>
                                    <label class="btn btn-primary btn-radio">
                                        <input type="submit" name="price" value="21-30"> $21-30
                                    </label>
                                    <label class="btn btn-primary btn-radio">
                                        <input type="submit" name="price" value="31-40"> $31-40
                                    </label>
                                    <label class="btn btn-primary btn-radio">
                                        <input type="submit" name="price" value="41+"> $41+
                                    </label>
                                </div>
                            </form>
                        </div>
                        <!-- Price End -->
                    </div>
                    <!-- Shop Sidebar End -->


                    <!-- Shop Product Start -->
                    <div class="col-lg-10 col-md-12">

                        <!-- Start showing the books -->
                        <div class="row px-xl-5 pb-3">
                            <?php
                            include './db/db-inc.php'; // Include the database connection file
                            
                            // Set the condition variable
                            $condition = "";

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price'])) {
                                include './includes/get-books.php';
                                $results = mysqli_query($conn, $sql);
                                $resultsCheck = mysqli_num_rows($results);

                                // Set the condition for pagination links
                                $condition = "&price=" . $_POST['price'];

                            } else if (isset($_GET["term"])) {
                                $term = $_GET["term"];

                                // Prepare a select statement
                                $sql = "SELECT * FROM tblbooks b INNER JOIN tblauthors a ON b.author_id=a.author_id 
                                 WHERE book_title LIKE '%" . $term . "%' OR author_name LIKE '%" . $term . "%'";

                                $results = mysqli_query($conn, $sql);
                                $resultsCheck = mysqli_num_rows($results);

                                // Set the condition for pagination links
                                $condition = "&term=" . $_GET['term'];

                            } else {
                                $sql = "SELECT * FROM tblbooks;";
                                $results = mysqli_query($conn, $sql);
                                $resultsCheck = mysqli_num_rows($results);
                            }

                            // Pagination code
                            $perPage = 8; // Number of books per page
                            $totalBooks = $resultsCheck;
                            $totalPages = ceil($totalBooks / $perPage);
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                            $start = ($currentPage - 1) * $perPage;

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price'])) {
                                $sql .= " LIMIT $start, $perPage";
                            } else if (isset($_GET["term"])) {
                                $sql .= " LIMIT $start, $perPage";
                            } else {
                                $sql = "SELECT * FROM tblbooks" . " LIMIT $start, $perPage;";
                            }

                            $results = mysqli_query($conn, $sql);

                            include './includes/libri.php';
                            ?>

                            <!-- Pagination code start -->
                            <div class="col-12 pb-1">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mb-3">
                                        <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                                            <a class="page-link"
                                                href="?page=<?php echo $currentPage - 1 . $condition; ?>"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                            <li class="page-item <?php echo ($currentPage == $page) ? 'active' : ''; ?>">
                                                <a class="page-link"
                                                    href="?page=<?php echo $page . $condition; ?><?php echo isset($_GET['term']) ? '&term=' . $_GET['term'] : ''; ?>">
                                                    <?php echo $page; ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                        <li
                                            class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                                            <a class="page-link"
                                                href="?page=<?php echo $currentPage + 1 . $condition; ?>"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Pagination code end -->
                        </div>
                    </div>
                    <!-- End showing the books -->


                </div>
                <!-- Shop Product End -->
            </div>
            </div>
            <!-- Shop End -->


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