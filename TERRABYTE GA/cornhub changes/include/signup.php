<?php
    session_start();
    require "connection.php";

    //Function for fiiling up data into the database
    if(isset($_POST['signUp'])) {
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password !== $confirmPassword) {
        echo "<script>
                alert('Passwords do not match. Please try again. -,-');
                window.location.href = '../ecommerce.php'; // Redirect back to signup page
              </script>";
        exit();
    }

        $query = "INSERT INTO customer_info(firstName,middleName,lastName,username,email,password) 
                    VALUES ('$firstName','$middleName','$lastName','$username','$email','$password')";

        if (mysqli_query($conn, $query)) {
            header("Location: ../ecommerce.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    //Function for retrieving a certain data from the database and redirect the user to another page if success
    if(isset($_POST['logIn'])){
        $email=$_POST['email'];
        $password=$_POST['password'];

        $sql="SELECT * FROM customer_info WHERE email='$email' and  password='$password'";
        $result=$conn->query($sql);
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_ID'] = $row['user_ID'];
        
        if($row["usertype"]=="user") {	
            header("location:../ecommerce2.php");
        }
        elseif($row["usertype"]=="admin") {
            header("location:../admin.php");
        } else {
            echo "<script>
                    alert('Incorrect Email or Password. Please try again. -,-');
                    window.location.href = '../ecommerce.php'; // Redirect back to login page
                  </script>";
        }
    }
?>