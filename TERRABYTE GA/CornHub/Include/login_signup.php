<?php
    include("include/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Racing+Sans+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="modal" id="firstmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="include/signup.php" method="post">
                        <div class="container">
                        <div class="row d-flex justify-content-center mb-1 mt-1">
                            <div class="col-11 ms-auto">
                                <h5 class="text-1">Welcome!</h5>
                            </div>
                            <div class="col-1 ms-auto">
                                <img src="images/cancel icon.png" class="img-fluid3" alt="Image 4" data-bs-dismiss="modal" aria-label="Close">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="text-2">Sign Up or Log In to continue</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ms-auto mb-3">
                                <a class="nav-link3-active link-underline link-underline-opacity-0" aria-current="page" href="#">Log In</a>
                            </div>
                            <div class="col-6 ms-auto">
                                <a class="nav-link3 link-underline link-underline-opacity-0" data-bs-toggle="modal" data-bs-target="#secondmodal" >Sign Up</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-2">
                                <div class="progress mb-3" role="progressbar" aria-label="Example 0px high" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input required type="email" name="email" class="form-control mb-3" id="email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col me-3">
                                <label for="password" class="form-label">Password</label>
                                <input required type="password" name="password" class="form-control mb-4" id="password" placeholder="Enter your password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center mb-3">
                                <button type="submit" name="logIn" class="btn2 rounded">Log In</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="text-2 text-center">By signing up, you agree to our Terms & Condition and Privacy Policy.</p>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="include/signup.php" method="post">
        <div class="modal" id="secondmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row d-flex justify-content-center mb-1 mt-1">
                                <div class="col-11 ms-auto">
                                    <h5 class="text-1">Welcome!</h5>
                                </div>
                                <div class="col-1 ms-auto">
                                    <img src="images/cancel icon.png" class="img-fluid3" alt="Image 4" data-bs-dismiss="modal" aria-label="Close">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-2">Sign Up or Log In to continue</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ms-auto mb-3">
                                    <a class="nav-link3 link-underline link-underline-opacity-0" data-bs-toggle="modal" data-bs-target="#firstmodal" data-bs-toggle="modal">Log In</a>
                                </div>
                                <div class="col-6 ms-auto">
                                    <a class="nav-link3-active link-underline link-underline-opacity-0" aria-current="page" href="#">Sign Up</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col me-2">
                                    <div class="progress mb-3" role="progressbar" aria-label="Example 0px high" aria-valuenow="0" aria-valuemin="51" aria-valuemax="100" style="height: 10px">
                                        <div class="progress-bar" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input required type="text" name="firstName" class="form-control mb-3" id="firstName" placeholder="Enter your first name">
                                </div>
                                <div class="col-6">
                                    <label for="middleName" class="form-label">Middle Name</label>
                                    <input required type="text" name="middleName" class="form-control mb-3" id="middleName" placeholder="Enter your middle name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input required type="text" name="lastName" class="form-control mb-4" id="lastName" placeholder="Enter your last name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-center mb-3">
                                    <button type="button" id="nextButton" class="btn3 rounded">Next</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-2 text-center">By signing up, you agree to our Terms & Condition and Privacy Policy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="thirdmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row d-flex justify-content-center mb-1 mt-1">
                                <div class="col-11 ms-auto">
                                    <h5 class="text-1">Welcome!</h5>
                                </div>
                                <div class="col-1 ms-auto">
                                    <img src="images/cancel icon.png" class="img-fluid3" alt="Image 4" data-bs-dismiss="modal" aria-label="Close">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-2">Sign Up or Log In to continue</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 ms-auto mb-3">
                                    <a class="nav-link3 link-underline link-underline-opacity-0" href="#">Log In</a>
                                </div>
                                <div class="col-6 ms-auto">
                                    <a class="nav-link3-active link-underline link-underline-opacity-0" aria-current="page" href="#">Sign Up</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col me-2">
                                    <div class="progress mb-3" role="progressbar" aria-label="Example 0px high" aria-valuenow="0" aria-valuemin="51" aria-valuemax="100" style="height: 10px">
                                        <div class="progress-bar" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input required type="text" name="username" class="form-control mb-3" id="username" placeholder="Enter your username">
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label">E-mail Address</label>
                                    <input required type="email" name="email" class="form-control mb-3" id="email" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input required type="password" name="password" class="form-control mb-4" id="password" placeholder="Enter your password">
                                </div>
                                <div class="col-6">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input required type="password" name="confirmPassword" class="form-control mb-4" id="password" placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-center mb-3">
                                    <button type="submit" class="btn4 rounded" name="signUp">Sign Up</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-2 text-center">By signing up, you agree to our Terms & Condition and Privacy Policy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.getElementById("nextButton").addEventListener("click", function(event) {
            var firstName = document.getElementById("firstName").value;
            var middleName = document.getElementById("middleName").value;
            var lastName = document.getElementById("lastName").value;

            if (firstName && middleName && lastName) {
                var myModal = new bootstrap.Modal(document.getElementById('thirdmodal'), {
                    keyboard: false
                });
                myModal.show();
            } else {
                alert("Please fill out all fields before proceeding. -,-");
                event.preventDefault();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>