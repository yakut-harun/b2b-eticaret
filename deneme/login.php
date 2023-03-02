<?php
include 'config.php';
//error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    if ($_POST['email'] != "" || $_POST['password'] != "") {
        include "config.php";
        $email = $_POST['email'];
        $password = hash("sha512", $_POST['password']);
//        print($email);
//        print($password);
        $sql = "SELECT * FROM `user` WHERE `email` =? AND `passwordHash` = ? ";
        $query = $pdo->prepare($sql);
        $query->execute(array($email, $password));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if ($row > 0) {
            $query=$pdo->prepare("SELECT * FROM `address` WHERE email = ?");
            $query->execute(array(
                $email,
            ));
            $query2=$pdo->prepare("SELECT * FROM `order` WHERE id = ?");
            $query2->execute(array(
                $_SESSION['id'],
            ));
            echo '<script>
                alert("Login Success.");
                window.location.href="address_reg.php";
                </script>';
        } else {
            echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = 'login.php'</script>
				";
        }
    } else {
        echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'user_register.php'</script>
			";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7
.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../Style/style2.css">
    <title>Login Form</title>
</head>
<body>
<div class="container">
    <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
        <div class="input-group">
            <input type="email" placeholder="Email" maxlength="30" name="email" value="" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="" required>
        </div>
        <div class="input-group">
            <button name="submit" class="btn">Login</button>
        </div>
        <p class="login-register-text"> Don't have an account? <a href="user_register.php"> Register here.</a></p>
    </form>
</div>
</body>
</html>
