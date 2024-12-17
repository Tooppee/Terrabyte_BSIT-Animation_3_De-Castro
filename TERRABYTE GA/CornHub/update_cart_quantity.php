<?php
session_start();
include("include/connection.php");

$user_ID = isset($_SESSION['user_ID']) ? $_SESSION['user_ID'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_ID) {
    $product_ID = intval($_POST['product_ID']);
    $new_quantity = intval($_POST['new_quantity']);

    if ($new_quantity < 1) {
        echo json_encode(['success' => false, 'message' => 'Quantity must be at least 1.']);
        exit;
    }

    // Update quantity in the database
    $query = "UPDATE `cart` SET `prod_qty` = '$new_quantity' WHERE `product_ID` = '$product_ID' AND `user_ID` = '$user_ID'";
    if (mysqli_query($conn, $query)) {
        // Fetch updated cart data to calculate grand total
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `user_ID` = '$user_ID'");
        $grand_total = 0;

        while ($row = mysqli_fetch_assoc($select_cart)) {
            $grand_total += $row['prod_price'] * $row['prod_qty'];
        }

        // Get the final price for the updated product
        $product_query = mysqli_query($conn, "SELECT `prod_price` FROM `cart` WHERE `product_ID` = '$product_ID' AND `user_ID` = '$user_ID'");
        $product = mysqli_fetch_assoc($product_query);
        $final_price = $product['prod_price'] * $new_quantity;

        echo json_encode([
            'success' => true,
            'new_quantity' => $new_quantity,
            'final_price' => number_format($final_price),
            'grand_total' => number_format($grand_total)
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>