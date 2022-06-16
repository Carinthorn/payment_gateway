<?php
session_start();
require_once "config/db.php";

if (isset($_POST["signup"])) {
    // $_POST["signin"] according to button name
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password = $_POST["c_password"];
    $u_role = "user";

    if (empty($firstname)) {
        $_SESSION['error'] = "Enter your firstname";
        header("location: signup.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = "Enter your lastname";
        header("location: signup.php");
    } else if (empty($email)) {
        $_SESSION['error'] = "Enter your email";
        header("location: signup.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid Email format";
        header("location: signup.php");
    } else if (empty($password)) {
        $_SESSION['error'] = "Enter your password";
        header("location: signup.php");
    } else if (strlen($password) > 20 || strlen($password) < 8) {
        $_SESSION['error'] = 'Your password must contain 8-20 characters';
        header("location: signup.php");
    } else if (empty($c_password)) {
        $_SESSION['error'] = "confirm password";
        header("location: signup.php");
    } else if ($password != $c_password) {
        $_SESSION['error'] = "Confirmed password mismatch";
        header("location: signup.php");
    } else {
        try {
            $check_info = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_info->bindParam(":email", $email);
            $check_info->execute();
            $row = $check_info->fetch(PDO::FETCH_ASSOC);
            if ($email == $row['email']) {
                $_SESSION['warning'] = "email is alredy inused";
                header("location: signup.php");
            } else if (!isset($_SESSION['error'])) {
                //match password
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole) VALUES(:firstname, :lastname, :email, :password, :urole)");
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":urole", $u_role);
                $stmt->execute();

                $_SESSION['success'] = "Account is successfully created <a href='login.php'>Login</a>";
                header("location: login.php");
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("location: signup.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
