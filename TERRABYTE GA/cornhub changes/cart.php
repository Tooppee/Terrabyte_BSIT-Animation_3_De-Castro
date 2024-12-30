<?php
    session_start();
    include("include/connection.php");

    //Fetching all products from the cart of a certain user ID
    $user_ID = isset($_SESSION['user_ID']) ? $_SESSION['user_ID'] : null;
    if ($user_ID) {
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `user_ID` = '$user_ID'");
    } else {
        // Redirect to login if the user is not logged in
        header("Location: ecommerce.php");
        exit;
    }

    //Function for removing a product
    if (isset($_GET['remove'])) {
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE `product_ID` = '$remove_id' AND `user_ID` = '$user_ID'");
        //Refresh page when a product is removed
        header('location:cart.php');
    }

    //Function for removing all products
    if (isset($_GET['delete_all'])) {
        mysqli_query($conn, "DELETE FROM `cart` WHERE `user_ID` = '$user_ID'");
        //Refresh page when all products were removed
        header('location:cart.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php require_once('include/navbar2.php'); ?>
    <main>
        <div class="row">
            <div class="col-12">
                <h1>My Cart (<?php echo $row_count; ?>)</h1>
            </div>
        </div>
        <!--Calculating the subtotal and grandtotal-->
        <?php 
            $grand_total = 0;
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    $sub_total = $fetch_cart['prod_price'] * $fetch_cart['prod_qty'];
                    $grand_total += $sub_total;
        ?>
        <div class="card mb-3" style="max-width: 1300px;">
            <div class="row g-0">
                <div class="col-4">
                    <img src="<?php echo $fetch_cart['prod_img']; ?>" class="img-fluid rounded" alt="Product Image">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="product_name mb-0"><?php echo $fetch_cart['prod_name']; ?></h5>
                            <p class="unit_price mb-0">Unit Price: ₱ <?php echo number_format($fetch_cart['prod_price']); ?></p>
                            <p class="final_price mb-0" id="final_price-<?php echo $fetch_cart['product_ID']; ?>">
                                Sub Total: ₱ <?php echo number_format($sub_total); ?>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="quantity-container" style="padding-right: 500px;">
                                <a href="#" class="quantity1" onclick="changeQuantity(-1, <?php echo $fetch_cart['product_ID']; ?>)">-</a>
                                <p class="quantity2 mt-3" id="quantity-<?php echo $fetch_cart['product_ID']; ?>">
                                    <?php echo $fetch_cart['prod_qty']; ?>
                                </p>
                                <a href="#" class="quantity3" onclick="changeQuantity(1, <?php echo $fetch_cart['product_ID']; ?>)">+</a>
                            </div>
                            <a href="cart.php?remove=<?php echo $fetch_cart['product_ID']; ?>" onclick='return confirm("Are you sure you want to remove this item from the cart?");' class="btn" style="padding: 3px 30px;">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                }
            } else {
                echo "<p>Your cart is empty!</p>";
            }
        ?>
        <div class="box-container rounded">
            <h5 class="title">Summary</h5>
            <div class="d-flex justify-content-between align-items-center">
                <p class="text">Total Amount:</p>
                <p class="total_amount" id="grand_total">₱ <?php echo number_format($grand_total); ?></p>
            </div>
            <a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to remove all?');" class="btn">Remove All</a>
            <!--Redirect to checkout.php-->
            <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Proceed to Checkout</a>
        </div>
    </main>
    <?php require_once('include/footer2.php'); ?>

    <script>
        //Function to increase or decrease quantity
        function changeQuantity(change, productID) {
            var quantityElement = document.getElementById(`quantity-${productID}`);
            var currentQuantity = parseInt(quantityElement.innerText);
            var newQuantity = currentQuantity + change;

            if (newQuantity < 1) {
                alert("Quantity cannot be less than 1");
                return;
            }

            // AJAX request to update quantity
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_cart_quantity.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            quantityElement.innerText = response.new_quantity;

                            // Safely update the text content without removing HTML structure
                            const finalPriceElement = document.getElementById(`final_price-${productID}`);
                            finalPriceElement.textContent = `Sub Total: ₱ ${response.final_price}`;

                            const grandTotalElement = document.getElementById("grand_total");
                            grandTotalElement.textContent = `₱ ${response.grand_total}`;
                        } else {
                            alert(response.message || "Failed to update quantity.");
                        }
                    } catch (error) {
                        console.error("Error parsing response:", error);
                        alert("An error occurred while updating the cart.");
                    }
                }
            };
            xhr.send(`product_ID=${productID}&new_quantity=${newQuantity}`);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>