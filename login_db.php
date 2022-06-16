<?php
session_start();
require_once 'config/db.php';


if (isset($_POST["login"])) {
    // $_POST["signin"] according to button name
    $email = $_POST["email"];
    $password2 = $_POST["password"];
    


    if (empty($email)) {
        $_SESSION['error'] = 'Enter your email';
        header("location: login.php");
    } else if (empty($password2)) {
        $_SESSION['error'] = "Enter your password";
        header("location: login.php");
    } else {
        try {
            $check_d = $conn->prepare('SELECT * FROM users WHERE email = :email');
            $check_d->bindParam(":email", $email);
            $check_d->execute();
            $row = $check_d->fetch(PDO::FETCH_ASSOC);

            if ($check_d->rowCount() > 0) {
                if ($email == $row['email']) {
                    if (password_verify($password2, $row['password'])) {
                        if ($row['urole'] == 'admin') {
                            $_SESSION['admin_login'] = $row['id'];
                            $_SESSION['status'] = 2;
                            //2 = admin status
                            header("location: admin.php");
                            // redirect to admin dashboard
                        } else {
                            $_SESSION['user_login'] = $row['id'];
                            $_SESSION['status'] = 1;
                            //1 = user status
                            header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = "Wrong password";
                        header("location: login.php");
                    }
                } else {
                    $_SESSION['error'] = "Email not found";
                    header("location: login.php");
                }
            } else {
                $_SESSION['error'] = "No data found";
                header("location: login.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
