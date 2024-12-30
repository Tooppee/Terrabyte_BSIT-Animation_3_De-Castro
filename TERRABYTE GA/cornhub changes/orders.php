<?php
    session_start();
    include("include/connection.php");

    if (!isset($_SESSION['user_ID'])) {
        header("Location: login.php");
        exit;
    }

    $user_ID = $_SESSION['user_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        table {
            max-width: 1500px;
            width: 95%;
            text-align: center;
            display: content;
            justify-self: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }
        @media (max-width: 768px) {
            table {
                max-width: 700px;
                width: 95%;
            }
        }
        @media (max-width: 576px) {
            table {
                max-width: 500px;
                width: 95%;
            }
        }
        table thead {
            background-color: #F5F5E9;
            color: red;
        }
    </style>
</head>
<body>
<table class="table">
    <?php require_once('include/navbar2.php'); ?>
    <div class="container" style="width: 1500px; margin-top: 40px; border-radius: 10px;">
        <h2>Recent Orders:</h2>
        <br>
        <table class="table" style="width: 1300px; text-align: center; align-self: center; margin-bottom: 150px;">
            <thead style="">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Delivery Address</th>
                    <th>Grand Total</th>
                    <th>Payment Method</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Selecting 10 rows from the database in a descending order
                    $sql = "SELECT * FROM `orders` WHERE `user_ID` = $user_ID ORDER BY `order_date` DESC LIMIT 10";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    //Improved logic for button state based on order status
                    while($row = $result->fetch_assoc()) {
                        $order_status = $row['order_status'];
                        $disabled = ($order_status === 'Order Cancelled' || $order_status === 'Order Paid') ? 'disabled' : '';
                        $button_text = ($order_status === 'Order Cancelled') ? 'Cancelled' : (($order_status === 'Order Paid') ? 'Paid' : 'Cancel');

                        echo "
                            <tr>
                                <td>$row[order_ID]</td>
                                <td>$row[order_date]</td>
                                <td>$row[address]</td>
                                <td>₱ $row[order_total]</td>
                                <td>$row[pmode]</td>
                                <td>$order_status</td>
                                <td>
                                    <a href='view_orders.php?order_ID={$row['order_ID']}' class='btn'>View</a>
                                    <a class='btn rounded cancel-btn $disabled' href='include/delete.php?id=$row[order_ID]' 
                                    onclick='cancelOrder(this, event)'>$button_text</a>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php require_once('include/footer2.php'); ?>
    <script>
        // Function to update the order status to "Order Cancelled"
        function cancelOrder(button, event) {
            event.preventDefault(); 

            const orderId = button.getAttribute('href').split('=')[1]; 

            // AJAX request to update the order status in the database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'include/delete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the button appearance and behavior
                    button.textContent = "Cancelled";
                    button.classList.add("disabled"); 
                    button.style.pointerEvents = "none";
                    button.style.opacity = "0.6";

                    // Update the order status in the table
                    const orderRow = button.closest('tr');
                    const statusCell = orderRow.querySelector('td:nth-child(6)');
                    statusCell.textContent = 'Order Cancelled';
                } else {
                    console.error('Error updating order status:', xhr.statusText);
                }
            };
            xhr.send(`id=${orderId}`);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>