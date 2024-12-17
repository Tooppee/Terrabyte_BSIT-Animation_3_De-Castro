<?php
if (isset($_POST['add_product'])) {
    // Retrieve data from the form
    $product_name = $_POST['prod_name'];
    $product_price = $_POST['prod_price'];
    $product_desc = $_POST['prod_desc'];
    $product_category = $_POST['category_ID'];
    $product_image = $_FILES['prod_img']['name'];
    $product_image_tmp_name = $_FILES['prod_img']['tmp_name'];
    $product_image_folder = 'images/' . $product_image;

    // Validate inputs
    if (empty($product_name) || empty($product_price) || empty($product_desc) || empty($product_category) || empty($product_image)) {
        $message[] = 'Please fill out all fields!';
    } else {
        // Insert product details into the database
        $insert_query = "INSERT INTO product (prod_name, prod_price, prod_desc, prod_img, category_ID) VALUES ('$product_name', '$product_price', '$product_desc', '$product_image', '$product_category')";
        $upload = mysqli_query($conn, $insert_query);

        if ($upload) {
            // Move uploaded file to the folder
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'New product added successfully!';
        } else {
            $message[] = 'Could not add the product. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product to Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
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
        .modal .btn2 {
            background-color: #FD4D02;
            border: 1px solid black;
            border-radius: 10px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            color: white;
            font-size: 20px;
            font-weight: 500;
            line-height: 23px;
            padding: 1% 32px;
        }
        .modal-content {
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
        }
        .modal .form-control {
            height: 45px;
            border: 1px solid black;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            margin-left: 10px;
        }
        .modal .form-label {
            font-weight: 600;
            font-size: 20px;
            line-height: 23px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="modal" id="firstmodal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product Item</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                        // Fetch categories from the database
                        $category_query = "SELECT * FROM product_category";
                        $category_result = mysqli_query($conn, $category_query);
                        ?>
                        <div class="row">
                            <div class="col me-3 mb-3">
                                <label for="name">Product Name:</label>
                                <input type="text" class="form-control" name="prod_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-3 mb-3">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" name="prod_price" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-3 mb-3">
                                <label for="qty">Description:</label>
                                <input type="text" class="form-control" name="prod_desc" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-3 mb-4">
                                <label for="category">Category:</label>
                                <select name="category_ID" class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                                        <option value="<?= $category['category_ID']; ?>"><?= $category['category_name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-3 mb-3">
                                <label for="file">Choose Image:</label>
                                <input type="file" class="form-control-file" name="prod_img" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center mb-3">
                                <button type="submit" name="add_product" class="btn2 rounded">Add Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var myModal = new bootstrap.Modal(document.getElementById('firstmodal'), {
            keyboard: false
        });
        myModal.show();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>