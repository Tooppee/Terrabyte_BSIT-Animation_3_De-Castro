<?php
session_start();
include("include/connection.php");

$user_ID = $_SESSION['user_ID'];

$sql = "SELECT * FROM customer_info WHERE user_ID = $user_ID";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$allItems = '';
$grand_total = 0;

if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $fullName = $_POST['fullName'];
    $payment = $_POST['pmode'];
    $order_date = date('Y-m-d H:i:s');

    $items = [];
    $user_ID = isset($_SESSION['user_ID']) ? $_SESSION['user_ID'] : null;

    if ($user_ID) {
        // Fetch items from the cart if the user is logged in
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `user_ID` = '$user_ID'");
    } else {
        // Redirect to login if the user is not logged in
        header("Location: login.php");
        exit;
    }

    if ($select_cart && mysqli_num_rows($select_cart) > 0) {
        // Process each item in the cart
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $sub_total = $fetch_cart['prod_price'] * $fetch_cart['prod_qty'];
            $grand_total += $sub_total; // Add subtotal for each product here
            $items[] = $fetch_cart['prod_name'] . ' (' . $fetch_cart['prod_qty'] . ')';
        }
        $allItems = implode(', ', $items);
    } else {
        $allItems = "No items in your cart.";
        $grand_total = 0;
    }

    $insertOrder = "INSERT INTO orders (user_ID, order_date, order_total, pmode, phone, address, fullName, order_status)
                VALUES ('$user_ID', '$order_date', '$grand_total', '$payment', '$phone', '$address', '$fullName', 'Order Placed')";

    if (mysqli_query($conn, $insertOrder)) {
        // Remove items from the cart after order is placed
        $deleteCartItems = mysqli_query($conn, "DELETE FROM `cart` WHERE `user_ID` = '$user_ID'"); 
        unset($_SESSION['cart']);
        echo '<script>window.location.href = "orders.php";</script>';
    }
} else {
    // Fetch cart items if the user is logged in
    if (isset($_SESSION['user_ID'])) {
        $user_ID = $_SESSION['user_ID'];
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `user_ID` = '$user_ID'");
        if ($select_cart && mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $sub_total = $fetch_cart['prod_price'] * $fetch_cart['prod_qty'];
                $grand_total += $sub_total;
                $items[] = $fetch_cart['prod_name'] . ' (' . $fetch_cart['prod_qty'] . ')';
            }
            $allItems = implode(', ', $items);
        } else {
            $allItems = "No items in your cart.";
            $grand_total = 0;
        }
    } else {
        $allItems = "No items in your cart.";
        $grand_total = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php require_once('include/navbar2.php'); ?>

    <div class="container" style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25); border-radius: 10px; margin-top: 30px;">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center p-2" style="margin-top: 10px; color: #FC703C;">Complete your order!</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h5><b>Product(s):</b><br><?php echo $allItems; ?></h5>
                    <h5 style="margin-top: 20px;"><b>Total Amount Payable: </b>₱ <?php echo number_format($grand_total, 2); ?></h5>
                </div>
                <form action="" method="post" id="placeOrder">
                    <div class="form-group">
                        <input type="text" name="fullName" class="form-control" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter Delivery Address"></textarea>
                    </div>
                    <h5 class="text-center" style="margin-top: 40px;"><b>Select Payment Mode</b></h5>
                    <div class="form-group">
                        <select name="pmode" class="form-control" style="margin-top: 20px;">
                            <option value="" selected disabled>Select Payment Mode</option>
                            <option value="cod">Cash On Delivery</option>
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-center" style="margin-top: 40px;">
                        <input type="submit" name="submit" value="Place Order" class="btn btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('include/footer2.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>