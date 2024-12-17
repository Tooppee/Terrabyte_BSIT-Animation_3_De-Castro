<?php
    session_start();
    include("include/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php require_once('include/navbar.php'); ?>

    <section class="main">
        <div class="container">
            <div class="row mb-4">
                <div class="col2">
                    <h4>Featured Product</h4>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-6">
                    <img src="images/corndog.png" class="img-fluid" alt="Image 1">
                </div>
                <div class="col-6 d-flex flex-column">
                    <p>Corndogs so good, even Titas will ask for second.</p>
                    <a class="btn1 rounded-pill" href="products2.php" data-target="" style="text-decoration: none;">Order Now</a>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col2 pt-4 d-flex justify-content-center">
                    <h3>Download Now!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col3-6 d-flex justify-content-center">
                    <p>Available on other platforms.</p>
                </div>
            </div>
            <div class="row">
                <div class="col4-5 d-flex justify-content-center">
                    <a href="https://www.apple.com/app-store/" target="_blank" class="image">
                        <img src="images/app_store.png" class="img-fluid1" alt="Image 2">
                    </a>
                    <a href="https://play.google.com/store/games?device=windows" target="_blank" class="">
                        <img src="images/google_play.png" class="img-fluid2" alt="Image 3">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php require_once('include/login_signup.php'); ?>
    <?php require_once('include/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>