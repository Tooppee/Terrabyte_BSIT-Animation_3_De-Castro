<?php
session_start();
include("include/connection.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in using user_id
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "You need to log in to add items to your cart."
    ]);
    exit;
}

// Ensure the cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if product_id is sent
if (isset($_POST['product_ID'])) {
    $product_ID = $_POST['product_ID'];

    // Fetch product details from the database
    $sql = "SELECT * FROM product WHERE product_ID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $product_ID);
    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Execution error: " . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        if (isset($_SESSION['cart'][$product_ID])) {
            $_SESSION['cart'][$product_iD]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_ID] = [
                'name' => $product['prod_name'],
                'price' => $product['prod_price'],
                'image' => $product['prod_img'],
                'quantity' => 1
            ];
        }
        echo json_encode(["status" => "success", "message" => "Product added to cart!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Product not found."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No product ID provided."]);
}
?>