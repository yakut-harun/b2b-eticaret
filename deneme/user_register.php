<?php
include "config.php";
error_reporting(0);
if(isset($_POST['submit'])) {
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $u_name = $_POST['u_name'];
    $tel_phone = $_POST['tel_phone'];
    $email = $_POST['email'];
    $password = hash("sha512", $_POST['password']);
    $cpassword = hash("sha512", $_POST['cpassword']);

    if ($password == $cpassword){
        $query = "SELECT * FROM user WHERE email = '$email' AND mobile = '$tel_phone'";
        $STH = $pdo->prepare($query);
        $STH->execute();
        $result = $STH->fetchAll(\PDO::FETCH_ASSOC);
        //$STH->setFetchMode(PDO::FETCH_ASSOC);
        if(!count($result) > 0) {
            include "config.php";
            $createdAt = date('Y-m-d H:i:s');
            $sql = "INSERT INTO user (firstName, middleName, lastName, username, mobile, email, passwordHash, registeredAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([$f_name, $m_name, $l_name, $u_name, $tel_phone, $email, $password, $createdAt]);
            if ($pdo) {
                //echo "<script>alert('User Added.')</script>";
                echo '<script>
                alert("User Added.");
                window.location.href="user_register.php";
                </script>';
                $f_name = "";
                $m_name = "";
                $l_name = "";
                $u_name = "";
                $tel_phone = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Something went wrong.')</script>";
            }
        }
        else {
            echo "<script>alert('Email or telephone number already exists.')</script>";
        }
    }
    else {
        echo "<script>alert('Passwords not matched!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../Style/style2.css">
    <title>Register Form</title>
</head>
<body>
<div class="container">
    <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Kayıt Ol</p>
        <div class="input-group">
            <input type="text" placeholder="FirstName" name="f_name" value="<?php echo $f_name; ?>" required>
        </div>
        <div class="input-group">
            <input type="text" placeholder="MiddleName" name="m_name" value="<?php echo $m_name; ?>" required>
        </div>
        <div class="input-group">
            <input type="text" placeholder="LastName" name="l_name" value="<?php echo $l_name; ?>" required>
        </div>
        <div class="input-group">
            <input type="text" placeholder="UserName" maxlength="15" name="u_name" value="<?php echo $u_name; ?>" required>
        </div>
        <div class="input-group">
            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="tel_phone" placeholder="PhoneNumber" maxlength="10" value="<?php echo $tel_phone; ?>" required/>
        </div>
        <div class="input-group">
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
        </div>
        <div class="input-group">
            <button name="submit" class="btn">Register.</button>
        </div>
    </form>
</div>
</body>
</html>