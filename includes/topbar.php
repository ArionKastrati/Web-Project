<?php include_once './db/db-inc.php'; ?>

<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="faq.php">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <?php
            session_start();

            if (isset($_SESSION["userid"])) {
                echo "Logged in as: " . $_SESSION["username"];
            }

            ?>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="index.php" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">e</span>Library</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="./shop.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for books" name="term">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="favorites.php" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">
                    <?php
                    
                    if (isset($_SESSION['userid'])) {
                        $loggedInUserID = $_SESSION['userid'];
                        $sql = "SELECT COUNT(*) AS favoriteBooksCount FROM tblfavorites WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $loggedInUserID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $favoriteBooksCount = $row['favoriteBooksCount'];
                            echo $favoriteBooksCount;
                        } else {
                            echo "No favorite books found.";
                        }
                    } else {
                        echo "0";
                    }

                    ?>
                </span>
            </a>
            <a href="cart.php" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">
                <?php
                    
                    if (isset($_SESSION['userid'])) {
                        $loggedInUserID = $_SESSION['userid'];
                        $sql = "SELECT COUNT(*) AS cartBooks FROM tblcart WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $loggedInUserID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $favoriteBooksCount = $row['cartBooks'];
                            echo $favoriteBooksCount;
                        } else {
                            echo "No favorite books found.";
                        }
                    } else {
                        echo "0";
                    }

                    ?>
                </span>
            </a>
        </div>
    </div>
</div>