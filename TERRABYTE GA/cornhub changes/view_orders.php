<?php
    session_start();
    include("include/connection.php");

    // Initialize the variables
    $order_details = [];
    $grand_total = 0;

    if (isset($_GET['order_ID']) && is_numeric($_GET['order_ID'])) {
        $order_ID = intval($_GET['order_ID']);
    
        $sql = "SELECT * FROM orders_view WHERE order_ID = $order_ID";
    
        $result = $conn->query($sql);
    
        if (!$result) {
            die("Invalid query: " . $conn->error);
        }
    
        // Check if any rows are returned
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order_details[] = $row;
                $sub_total = $row['prod_qty'] * $row['prod_price'];
                $grand_total += $sub_total;
            }
        } else {
            echo "No orders found for this order ID.";
            $order_details = null;
        }
    } else {
        die('Invalid order ID.');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="checkout.css">
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
            margin: 0 auto;
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

        @media (max-width: 768px) {
            .container-2 {
                padding: 15px;
            }
            .order-row {
                padding: 5px 0;
            }
        }

        .arrow {
            position: absolute;
            font-size: 2em;
            border: none;
        }
        .arrow:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <?php require_once('include/navbar2.php'); ?>
    <div class="container-2">
        <a class="arrow" href="orders.php" data-target="main">
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
            
            <?php foreach ($order_details as $order) : //Display the orders of a certain order ID and user ID ?>
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
                <div class="col text-end mb-5">
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
    </div>
    <?php require_once('include/footer2.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
