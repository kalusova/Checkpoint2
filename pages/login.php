<?php
session_start();
$_SESSION["LoginOK"]=1;
$_SESSION["role"] = '';
$_SESSION["username"] = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="../style.css">


</head>
<body class="login">

<h2>Please enter your login information:</h2>

<form action="../database/check.php" method="post">

    <div class="container">
        <label ><b>Username</b></label>
        <br>
        <label><input type="text" placeholder="Enter Username" name="u_name" id="u_name" required ></label>
        <br>

        <label ><b>Password</b></label>
        <br>
        <label><input type="password" placeholder="Enter Password" name="psw" id="psw" required></label>
        <br>

        <button type="submit">Login</button>
        <br>

        <span class="register">Don't have an account?</span>
        <a class="register" href="registration.php">Register now!</a>

    </div>
</form>
</body>
</html>