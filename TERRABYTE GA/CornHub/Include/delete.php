<?php
    session_start();
    include_once("connection.php");

    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        // Update the order_status to 'Canceled Order'
        $sql = "UPDATE orders SET order_status = 'Order Cancelled' WHERE order_ID = $id";
        if (!$conn->query($sql)) {
            die("Error updating order status: " . $conn->error);
        }

        echo "success"; 
    } else {
        echo "error"; 
    }

    exit;
?>