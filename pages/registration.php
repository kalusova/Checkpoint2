<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registracia</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css" type="text/css">
 
    <script src=https://code.jquery.com/jquery-3.6.0.min.js integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src=https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
 
</head>
<body class="login">
<script type="text/javascript">
 
    function registrovat() {
        let meno_val = $('#meno').val();
        let priezvisko_val = $('#priezvisko').val();
        let login_val = $('#login').val();
        let passwd_val = $('#passwd').val();
        let email_val = $('#email').val();

        $.post("../database/register_save.php", {meno: meno_val, priezvisko: priezvisko_val, login: login_val, passwd: passwd_val, email: email_val},
            function(data){
                alert(data);
                
                if (data == "OK") { // ak je vsetko OK
                    window.location.href = "login.php";
                }
                
            });
    }
</script>

<div class="center">
    <form id="registrationForm" class="needs-validation" novalidate>

        <h3>Vytvoriť nový účet</h3>
        <p>Prosím zadajte nasledovné informácie.</p>
        <div class="row">
            <div class="col-sm-1">
                <label for="meno">Meno</label>
            </div>
            <div class="col-sm-8">
                <input type="text"  name="meno" id="meno" value="" required>
            </div>
        </div>
 
        <div class="row">
            <div class="col-sm-1">
                <label for="priezvisko">Priezvisko</label>
            </div>
            <div class="col-sm-8">
                <input type="text"  name="priezvisko" id="priezvisko" value="" required>
            </div>
        </div>
 
        <div class="row">
            <div class="col-sm-1">
                <label for="login">Login</label>
            </div>
            <div class="col-sm-8">
                <input type="text"  name="login" id="login"  value=""  required>
            </div>
        </div>
 
        <div class="row">
            <div class="col-sm-1">
                <label for="passwd">Heslo</label>
            </div>
            <div class="col-sm-8">
                <input type="password"  name="passwd" id="passwd" value="" required>
            </div>
        </div>
 
        <div class="row">
            <div class="col-sm-1">
                <label for="email">Email</label>
            </div>
            <div class="col-sm-8">
                <input type="text" name="email" id="email" value="" required>
            </div>
        </div>
        <br>
        <input  type="button" class="btn btn-success" id="register" name="register" value="Vytvoriť" onclick="registrovat();">
        <br>
 
        <div id="message"></div>
    </form>
</div>

</body>
</html>
 