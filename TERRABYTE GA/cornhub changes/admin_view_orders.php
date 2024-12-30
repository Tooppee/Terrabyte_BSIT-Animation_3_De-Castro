<?php
    // Start the session and include the database connection
    session_start();
    include("include/connection.php");

    // Initialize variables
    $order_status = '';

    // Get the order ID from the URL
    if (isset($_GET['id'])) {
        $order_id = $_GET['id'];

        // Handle status update
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_status'])) {
            $new_status = $_POST['order_status'];

            // Update the order status in the database
            $update_sql = "UPDATE orders SET order_status = ? WHERE order_ID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_status, $order_id);
            if ($update_stmt->execute()) {
                // Refresh order status after update
                $order_status = $new_status;
            } else {
                echo "<script>alert('Failed to update order status.');</script>";
            }
        }

        // Query to get the order details from orders_view table
        $sql = "SELECT * FROM orders_view WHERE order_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the order details
        if ($result && $result->num_rows > 0) {
            $order_details = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $order_details = [];
        }

        // Query to fetch the grand total
        $total_sql = "SELECT SUM(prod_qty * prod_price) AS grand_total FROM orders_view WHERE order_ID = ?";
        $total_stmt = $conn->prepare($total_sql);
        $total_stmt->bind_param("i", $order_id);
        $total_stmt->execute();
        $total_result = $total_stmt->get_result();
        $grand_total = 0;
        if ($total_result && $total_result->num_rows > 0) {
            $total_row = $total_result->fetch_assoc();
            $grand_total = $total_row['grand_total'];
        }

        // Query to fetch the order status
        $status_sql = "SELECT order_status FROM orders WHERE order_ID = ?";
        $status_stmt = $conn->prepare($status_sql);
        $status_stmt->bind_param("i", $order_id);
        $status_stmt->execute();
        $status_result = $status_stmt->get_result();
        if ($status_result && $status_result->num_rows > 0) {
            $status_row = $status_result->fetch_assoc();
            $order_status = $status_row['order_status'];
        }
    } else {
        // Handle case when the order ID is not provided in the URL
        header("Location: admin_orders.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
            background-color: #F5F5E9;
        }

        .container-2 {
            background-color: white;
            padding: 30px;
            max-width: 960px;
            margin-left: 25%;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            border: 1px solid black;
            border-radius: 8px;
            position: relative;
            margin-top: 70px;
        }

        .order-header {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .order-header p {
            font-weight: bold;
            margin-bottom: 0;
        }

        .order-row {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .order-row p {
            margin-bottom: 0;
        }

        .order-row div {
            text-align: center;
        }

        /* Added styles for responsiveness */
        @media (max-width: 768px) {
            .container-2 {
                padding: 15px;
            }
            .order-row {
                padding: 5px 0;
            }
        }

        /* Styles for the button */
        .arrow {
            position: absolute;
            font-size: 2em;
            border: none;
        }
        .arrow:hover {
            transform: scale(1.1);
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

    <div class="container-2">
        <a class="arrow" href="admin_orders.php" data-target="main">
            <img src="images/arrow.png" alt="Bootstrap">
        </a>
        <h2 class="text-center">Order Details</h2>
        
        <?php if ($order_details) : ?>
            <div class="order-header row">
                <div class="col d-flex justify-content-center">
                    <p>Order/s</p>
                </div>
                <div class="col text-center">
                    <p>Price</p>
                </div>
                <div class="col text-center">
                    <p>Quantity</p>
                </div>
                <div class="col text-center">
                    <p>Subtotal</p>
                </div>
            </div>
            
            <?php foreach ($order_details as $order) : ?>
                <div class="order-row row">
                    <div class="col">
                        <p><?php echo $order['prod_name']; ?></p>
                    </div>
                    <div class="col text-center">
                        <p>₱ <?php echo number_format($order['prod_price'], 2); ?></p>
                    </div>
                    <div class="col text-center">
                        <p><?php echo $order['prod_qty']; ?>x</p>
                    </div>
                    <div class="col text-center">
                        <p>₱ <?php echo number_format($order['prod_qty'] * $order['prod_price'], 2); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="row mt-5">
                <div class="col text-end mb-3">
                    <h4><b>Grand Total:</b></h4>
                </div>
                <div class="col text-start">
                    <h4>₱ <?php echo number_format($grand_total, 2); ?></h4>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col text-center">
                    <p>No order details found for this order ID.</p>
                </div>
            </div>
        <?php endif; ?>
        
        <!--Update Order Status-->
        <div class="row mb-1 ms-1">
            <h5>Order Status:</h5>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <form action="" method="POST">
                    <select class="form-select status-dropdown" name="order_status" required 
                        <?php echo $order_status == 'Order Cancelled' || $order_status == 'Order Paid' ? 'disabled' : ''; ?>>
                        <option value="">Select Order Status</option>
                        <option value="Order Confirmed" <?php echo $order_status == 'Order Confirmed' ? 'selected' : ''; ?>>Confirm</option>
                        <option value="Order Ready" <?php echo $order_status == 'Order Ready' ? 'selected' : ''; ?>>Ready</option>
                        <option value="Order in Deliver" <?php echo $order_status == 'Order in Deliver' ? 'selected' : ''; ?>>Deliver</option>
                        <option value="Order Paid" <?php echo $order_status == 'Order Paid' ? 'selected' : ''; ?>>Paid</option>
                    </select>
                    <!--If status is Order Cancelled, change the button to a disabled gray button-->
                    <?php if ($order_status == 'Order Cancelled') : ?>
                        <button type="button" class="btn mt-3" style="background-color: gray;" disabled>Cancelled</button>
                    <!--If status is Order Paid, change the button to a disabled gray button-->
                    <?php elseif ($order_status == 'Order Paid') : ?>
                        <button type="button" class="btn mt-3" style="background-color: #75da83;" disabled>Paid</button>
                    <!--If status is not Order Cancelled and Order Paid, change the button to a the default update button-->
                    <?php else : ?>
                        <button type="submit" class="btn mt-3">Update</button>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col text-center">
                <p><strong>Current Status:</strong> <?php echo $order_status ? htmlspecialchars($order_status) : 'Not Available'; ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>