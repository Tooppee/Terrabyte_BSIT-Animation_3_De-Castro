<?php
    include("include/connection.php");

    // Retrieve user_ID from the session
    $user_ID = isset($_SESSION['user_ID']) ? $_SESSION['user_ID'] : null;

    // Check if the user is logged in
    if ($user_ID) {
        // Select only the rows specific to the logged-in user
        $select_rows = $conn->prepare("SELECT * FROM `cart` WHERE `user_ID` = ?");
        $select_rows->bind_param("i", $user_ID);
        $select_rows->execute();
        $result = $select_rows->get_result();
        $row_count = $result->num_rows;
    } else {
        // Default to 0 if no user is logged in
        $row_count = 0;
    }
?>

<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="ecommerce2.php" data-target="main">
                <img src="images/cornhub logo.png" alt="Bootstrap" width="140" height="85">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ecommerce2.php" data-target="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php" data-target="">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" data-target="">Cart
                            <span class="position-absolute top-30 start-95 translate-middle badge rounded-pill bg-danger"><?php echo $row_count; ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php" data-target="">Orders</a>
                    </li>
                    <!--<li class="nav-item d-flex align-items-center">
                        <a class="nav-link2" href="cart.php" data-target="">
                            <i class="bi bi-bag fs-5">
                                <span class="position-absolute top-30 start-90 translate-middle badge rounded-pill bg-danger"><?php echo $row_count; ?></span>
                            </i>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link2" href="orders.php" data-target="">
                            <i class="bi bi-person fs-5"></i>
                        </a>
                    </li>-->
                    <li class="nav-item d-flex align-items-center">
                        <a href="include/logout.php" onclick='return confirm("Are you sure you want to log out?");' class="btn rounded-pill">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>