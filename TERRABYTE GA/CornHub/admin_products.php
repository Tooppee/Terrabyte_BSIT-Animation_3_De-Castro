<?php
session_start();
include("include/connection.php");

$user_ID = isset($_SESSION['user_ID']) ? $_SESSION['user_ID'] : null; // Retrieve user_ID from session

$sql = "SELECT product.*, product_category.category_name 
        FROM product 
        INNER JOIN product_category 
        ON product.category_ID = product_category.category_ID";

$all_product = $conn->query($sql);

if (!$all_product) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Corndog Haven</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        *{
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
        .content {
            background-color: #F4F3E6;
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px; /* Matches the width of the sidebar */
        }
        .container-fluid {
            display: flex;
            width: 100%;
        }

            /*Actions*/
            .action-icon-link {
                text-decoration: none;
                margin: 0 5px;
                display: inline-block;
            }

            .action-icon-link img {
                vertical-align: middle;
            }

            /*Navigation*/
            .nav-link {
                color: #fff;
                transition: 0.3s ease, color 0.3s ease;
            }
            .nav-link:hover {
                color: #FD4D02 !important;
                text-decoration: none;
            }
            .nav-link.active {
                color: #FD4D02 !important;
                background-color: #F4F3E6 !important;
            }

            /*Sidebar*/
            .sidebar {
                width: 250px;
                background-color: #FD4D02;
                color: #F4F3E6;
                position: fixed; /* Makes the sidebar fixed */
                top: 0; /* Ensures it stays at the top */
                left: 0; /* Sticks it to the left side of the viewport */
                height: 100vh; /* Makes it full height */
                overflow-y: auto; /* Adds scrolling if the content overflows */
                z-index: 1000; /* Ensures it stays on top of other elements */
                padding: 15px; /* Optional padding for spacing */
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
        
            /*Cards*/
            .card-body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                height: 100%;
            }

            .card {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .done-card {
                background-color: #75da83;
                color: #F4F3E6;
                border: none;
            }
            .pend-card {
                background-color: #dada75;
                color: #F4F3E6;
                border: none;
            }
            .ready-card {
                background-color: #daa875;
                color: #F4F3E6;
                border: none;
            }

            /*Table*/
            .full-width-table {
                width: 100%;
                border-collapse: collapse;
            }
            .custom-table thead {
                background-color: #f4a261; /* Light Orange */
                color: #fff; /* Text color for contrast */
            }

            .custom-table th, .custom-table td {
                padding: 10px;
                text-align: center;
            }

            /*Buttons*/
            button.btn img {
                vertical-align: middle;
            }
            .add-btn {
                border: none;
                background-color: #FC703C;
                color: white;
                padding: 10px;
                width: 80%;
                cursor: pointer;
                font-size: 15px;
                font-weight: 500;
                position: relative;
                text-align: center;
            }
            .add-btn:hover {
                background-color: #FD4D02;
                border: none;
                color: white;
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
            <li class="nav-item"><a href="admin_products.php" class="nav-link active">Products</a></li>
            <li class="nav-item"><a href="admin_orders.php" class="nav-link">Orders</a></li>
            <li class="nav-item"><a href="admin_reports.php" class="nav-link">Reports</a></li>
        </ul>          
        <hr>
        <div class="logout-container d-flex justify-content-center mt-auto mb-3">
            <li class="nav-item d-flex align-items-center">
                <a href="include/logout.php" onclick='return confirm("Are you sure you want to log out?");' class="logout-btn rounded-pill">Logout</a>
            </li>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <br><br><br>
        <h1>List of Products</h1>
        <p></p>
         
        <!-- Products Section -->
        <div>
            <table class="table full-width-table table-bordered table-hover custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category</th>
                        <!--<th>Stock</th>-->
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    while($row = mysqli_fetch_assoc($all_product)) {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $row["product_ID"]; ?></td>
                        <th>
                            <img src="<?php echo $row["prod_img"]; ?>" class="card-img-top rounded" alt="..." style="width: 100px; height: 100px;">
                        </th>
                        <td><?php echo $row["prod_name"]; ?></td>
                        <td>₱ <?php echo $row["prod_price"]; ?></td>
                        <th><?php echo $row["prod_desc"]; ?></th>
                        <input type="hidden" name="category_ID" value="<?php echo $row["category_ID"]; ?>">
                        <th><?php echo $row["category_name"]; ?></th>
                        <!--<td>
                            <select class="form-select status-dropdown" onchange="updateStatus(this)">
                                <option value="Available" selected>Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                            </td>-->
                        <td>
                            <!--Edit-->
                            <a href="edit-product.html" class="action-icon-link" title="Edit">
                                <img src="images/Edit.jpg" alt="Edit" style="width: 24px; height: 24px;">
                            </a>
                            <a href="edit-product.html" class="action-icon-link" title="Edit">
                                <img src="images/Delete.png" alt="Edit" style="width: 24px; height: 24px;">
                            </a>         
                        </td>
                    </tr>            
                </tbody>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>

    <button type="button" class="add-btn rounded" data-bs-toggle="modal" data-bs-target="#firstmodal" style="margin-left: 300px; margin-bottom: 30px; text-decoration: none; width: 200px;">
        Add Product
    </button>

    <?php require_once('include/add_product.php'); ?>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <!--For Logging Out-->
            <a href="logout.php" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
            
            function editRow(editButton) {
                const row = editButton.closest('tr');
                const cells = row.querySelectorAll('td');

                for (let i = 0; i < cells.length - 1; i++) {
                    const currentText = cells[i].textContent;
                    cells[i].innerHTML = `<input type="text" value="${currentText}" class="form-control">`;
                }

                editButton.classList.add('d-none');
                const saveButton = editButton.nextElementSibling;
                saveButton.classList.remove('d-none');
            }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
