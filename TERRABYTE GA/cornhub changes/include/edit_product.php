<?php
include("include/connection.php"); // Ensure connection.php is included
echo "<script>console.log('Connection included');</script>";

if (isset($_GET['edit'])) {
    $product_ID = mysqli_real_escape_string($conn, $_GET['edit']); // Sanitize input
    echo "<script>console.log('Edit ID: " . $product_ID . "');</script>";

    // Fetch the existing product details to populate the form.  Use prepared statements to prevent SQL injection.
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_ID = ?");
    $stmt->bind_param("i", $product_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        // Handle case where product ID is invalid. Redirect or display an error message.
        echo "<script>console.log('Product not found');</script>";
        header("Location: admin_products.php?error=ProductNotFound");
        exit;
    }
    echo "<script>console.log('Product found: " . print_r($product, true) . "');</script>";
}

if (isset($_POST['edit_product'])) {
    // Retrieve data from the form.  Sanitize ALL inputs!
    $product_ID = mysqli_real_escape_string($conn, $_POST['product_ID']);
    $product_name = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['prod_price']);
    $product_desc = mysqli_real_escape_string($conn, $_POST['prod_desc']);
    $product_category = mysqli_real_escape_string($conn, $_POST['category_ID']);
    $product_image = $_FILES['prod_img']['name'];
    $product_image_path = 'images/' . $product_image;
    $product_image_tmp_name = $_FILES['prod_img']['tmp_name'];

    // Debugging: Log the received form data
    echo "<script>console.log('Form submitted');</script>";
    echo "<script>console.log('Product ID: " . $product_ID . "');</script>";
    echo "<script>console.log('Product Name: " . $product_name . "');</script>";
    echo "<script>console.log('Product Price: " . $product_price . "');</script>";
    echo "<script>console.log('Product Description: " . $product_desc . "');</script>";
    echo "<script>console.log('Product Category: " . $product_category . "');</script>";
    echo "<script>console.log('Product Image: " . $product_image . "');</script>";

    if (empty($product_name) || empty($product_price) || empty($product_desc) || empty($product_category)) {
        $message[] = 'Please fill out all fields!';
        echo "<script>console.log('Fields are missing');</script>";
    } else {
        // Use prepared statements for UPDATE query as well
        if (!empty($product_image)) {
            $stmt = $conn->prepare("UPDATE product SET prod_name = ?, prod_price = ?, prod_desc = ?, prod_img = ?, category_ID = ? WHERE product_ID = ?");
            $stmt->bind_param("ssdsii", $product_name, $product_price, $product_desc, $product_image_path, $product_category, $product_ID);
            echo "<script>console.log('Image included, prepared statement for update');</script>";
        } else {
            $stmt = $conn->prepare("UPDATE product SET prod_name = ?, prod_price = ?, prod_desc = ?, category_ID = ? WHERE product_ID = ?");
            $stmt->bind_param("ssdii", $product_name, $product_price, $product_desc, $product_category, $product_ID);
            echo "<script>console.log('No image, prepared statement for update');</script>";
        }

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            if (!empty($product_image)) {
                move_uploaded_file($product_image_tmp_name, $product_image_path);
                echo "<script>console.log('Image uploaded');</script>";
            }
            $message[] = 'Product updated successfully!';
            echo "<script>console.log('Product updated successfully');</script>";
            header('Location: admin_products.php');
            exit;
        } else {
            $message[] = 'Could not update the product. Please try again.';
            echo "<script>console.log('Failed to update product');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { padding: 0; margin: 0; box-sizing: border-box; }
        html, body { min-height: 100vh; margin: 0; padding: 0; font-family: "Roboto", sans-serif; background-color: #F5F5E9; }
        .modal .btn2 { background-color: #FD4D02; color: white; font-size: 20px; font-weight: 500; padding: 1% 32px; border-radius: 10px; }
        .modal-content { border-radius: 50px; padding: 20px; }
        .form-control { height: 45px; }
        .form-label { font-weight: 600; font-size: 20px; }
    </style>
</head>
<body>
    <div class="modal" id="secondmodal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_ID" value="<?= $product['product_ID']; ?>">
                        <?php
                        // Fetch categories
                        $category_query = "SELECT * FROM product_category";
                        $category_result = $conn->query($category_query);
                        echo "<script>console.log('Categories fetched');</script>";
                        ?>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Product Name:</label>
                                <input type="text" class="form-control" name="prod_name" required>
                                <script>console.log('Product name input created');</script>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Price:</label>
                                <input type="number" class="form-control" name="prod_price" required>
                                <script>console.log('Product price input created');</script>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Description:</label>
                                <input type="text" class="form-control" name="prod_desc" required>
                                <script>console.log('Product description input created');</script>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Category:</label>
                                <select name="category_ID" class="form-control" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <?php while ($category = $category_result->fetch_assoc()): ?>
                                        <option value="<?= $category['category_ID']; ?>"><?= $category['category_name']; ?></option>
                                        <script>console.log('Category: ' + '<?= $category['category_name']; ?>');</script>
                                    <?php endwhile; ?>
                                </select>
                                <script>console.log('Category select input created');</script>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Choose Image:</label>
                                <input type="file" class="form-control" name="prod_img">
                                <script>console.log('Image input created');</script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" name="edit_product" class="btn2">Update Product</button>
                                <script>console.log('Submit button created');</script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var myModal = new bootstrap.Modal(document.getElementById('secondmodal'), { keyboard: false });
        myModal.show();
        console.log('Modal shown');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
