<?php
    session_start(); // Start the session

    // Destroy all session data
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect the user to the login or home page
    header("Location: ../ecommerce.php");
    exit();
?>