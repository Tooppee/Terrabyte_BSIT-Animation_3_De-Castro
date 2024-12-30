<?php
// Include your database connection file
include("include/connection.php");

// Initialize counts for each order status
$total_orders = $cancelled_orders = $pending_orders = $ready_orders = $delivering_orders = $completed_orders = 0;

// Fetch the total number of orders from the database
$sql = "SELECT COUNT(*) AS total_orders FROM orders";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $total_orders = $row['total_orders'];
}

// Fetch the count of canceled orders
$sql_cancelled = "SELECT COUNT(*) AS cancelled_orders FROM orders WHERE order_status = 'Order Cancelled'";
$result_cancelled = $conn->query($sql_cancelled);
if ($result_cancelled) {
    $row_cancelled = $result_cancelled->fetch_assoc();
    $cancelled_orders = $row_cancelled['cancelled_orders'];
}

// Fetch the count of pending/confirmed orders
$sql_pending = "SELECT COUNT(*) AS pending_orders FROM orders WHERE order_status = 'Order Confirmed'";
$result_pending = $conn->query($sql_pending);
if ($result_pending) {
    $row_pending = $result_pending->fetch_assoc();
    $pending_orders = $row_pending['pending_orders'];
}

// Fetch the count of ready to deliver/pick up orders
$sql_ready = "SELECT COUNT(*) AS ready_orders FROM orders WHERE order_status = 'Order Ready'";
$result_ready = $conn->query($sql_ready);
if ($result_ready) {
    $row_ready = $result_ready->fetch_assoc();
    $ready_orders = $row_ready['ready_orders'];
}

// Fetch the count of orders in delivery
$sql_delivering = "SELECT COUNT(*) AS delivering_orders FROM orders WHERE order_status = 'Order in Deliver'";
$result_delivering = $conn->query($sql_delivering);
if ($result_delivering) {
    $row_delivering = $result_delivering->fetch_assoc();
    $delivering_orders = $row_delivering['delivering_orders'];
}

// Fetch the count of completed/paid orders
$sql_completed = "SELECT COUNT(*) AS completed_orders FROM orders WHERE order_status = 'Order Paid'";
$result_completed = $conn->query($sql_completed);
if ($result_completed) {
    $row_completed = $result_completed->fetch_assoc();
    $completed_orders = $row_completed['completed_orders'];
}

// Fetch all the orders in descending order
$sql_all_orders = "SELECT * FROM orders ORDER BY order_ID DESC";
$all_product = $conn->query($sql_all_orders);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Corndog Haven</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        html, body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
            background-color: #F5F5E9;
        }
        .content {
            background-color: #F4F3E6;
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px;
        }
        .container-fluid {
            display: flex;
            width: 100%;
        }

            /*Navigation*/
            .nav-link {
                color: #fff;
                transition: background-color 0.3s ease, color 0.3s ease;
            }
            .nav-link:hover {
                color: #FD4D02;
                text-decoration: none;
            }
            .nav-link.active {
                color: #FD4D02 !important;
                background-color: #F4F3E6 !important;
                width: 240px;
            }

            /*Sidebar*/
            .sidebar {
                width: 250px;
                background-color: #FD4D02;
                color: #F4F3E6;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                overflow-y: auto;
                overflow-x: hidden;
                z-index: 1000;
                padding: 15px;
            }
            .sidebar a {
                color: #F4F3E6;
                text-decoration: none;
            }
            .sidebar a:hover {
                background-color: #F4F3E6;
                transition: 0.5s;
            }

            /* For Logging Out */
            .logout-container {
                margin-top: auto;
                margin-bottom: 20px;
            }

            .logout-icon-container a {
                display: flex;
                justify-content: center;
            }
            
            .logout-btn {
                display: block;
                padding: 0;
                margin: 0 auto;
                transition: transform 0.2s ease;
            }

            .logout-btn:hover {
                transform: scale(1.1);
            }
            .logout-btn:hover {
                background-color: transparent !important;
                color: inherit !important;
                border: none !important;
                box-shadow: none !important;
            }
        
            /*Cards*/
            .card-body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                height: 100%;
            }

            .card {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .done-card {
                background-color: #75da83;
                color: #ffffff;
                border: none;
            }
            .pend-card {
                background-color: #dada75;
                color: #ffffff;
                border: none;
            }
            .ready-card {
                background-color: #daa875;
                color: #ffffff;
                border: none;
            }
            .cancel-card {
                background-color: gray;
                color: #ffffff;
                border: none;
            }
            .del-card {
                background-color: #add8e6;
                color: #ffffff;
                border: none;
            }

            /*Buttons*/
            .btn {
                background-color: #FC703C;
                border: none;
                color: white;
            }
            .btn:hover {
                background-color: #FD4D02;
                border: none;
                color: white;
            }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <img src="images/cornhub logo.png" alt="Bootstrap" width="140" height="85" style="align-self: center;">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <h4 class="text-center"><b>Admin Panel</h4>
            <li class="nav-item"><a href="admin.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="admin_products.php" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="admin_orders.php" class="nav-link active">Orders</a></li>
            <li class="nav-item"><a href="admin_reports.php" class="nav-link">Reports</a></li>
        </ul>          
        <hr>
        <div class="logout-container d-flex justify-content-center mt-auto mb-3">
            <li class="nav-item d-flex align-items-center">
                <a href="include/logout.php" onclick='return confirm("Are you sure you want to log out?");' class="logout-btn rounded-pill">Logout</a>
            </li>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <br><br><br>
        <h1>Status of Orders</h1>
        <p></p>
    
        <!--Status of Products-->
        <div class="container-fluid">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <h1 class="card-text"><?php echo $total_orders; ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card pend-card" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Pending/Confirmed</h5>
                            <h1 class="card-text"><?php echo $pending_orders; ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card ready-card" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Ready to Deliver/Pick Up</h5>
                            <h1 class="card-text"><?php echo $ready_orders; ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card del-card" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">In Deliver</h5>
                            <h1 class="card-text"><?php echo $delivering_orders; ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card done-card" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Completed/Paid</h5>
                            <h1 class="card-text"><?php echo $completed_orders; ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card cancel-card" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Cancelled</h5>
                            <h1 class="card-text"><?php echo $cancelled_orders; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
            
        <!-- Products Section -->
        <div>
            <table class="table full-width-table table-bordered table-hover custom-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Delivery Address</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all rows from the query result
                    if ($all_product && $all_product->num_rows > 0) {
                        while ($row = $all_product->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["order_ID"]; ?></td>
                                <td><?php echo $row["order_date"]; ?></td>
                                <td><?php echo $row["fullName"]; ?></td>
                                <td><?php echo $row["phone"]; ?></td>
                                <td><?php echo $row["address"]; ?></td>
                                <td><?php echo $row["pmode"]; ?></td>
                                <td><?php echo $row["order_status"]; ?></td>
                                <td><a href="admin_view_orders.php?id=<?php echo $row["order_ID"]; ?>" class="btn">View</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td colspan="8" class="text-center">No orders found</td></tr>
                        <?php
                    }
                    ?>
                </tbody>
        </table>
    </div>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <!--For Logging Out-->
            <a href="logout.php" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
    </script>
</body>
</html>
