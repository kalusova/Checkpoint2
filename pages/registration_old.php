<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../database/db_connect.php';
include "../database/DB_Storage.php";

$db = new DB_Storage($mysqli);

if (isset($_POST['register'])) {

    $meno = $_POST['meno'];
    $priezvisko = $_POST['priezvisko'];
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];
    $email = $_POST['email'];

    $db->checkRegis($meno, $priezvisko, $login, $passwd, $email);
}

?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registracia</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css" type="text/css">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</head>
<body>
<script type="text/javascript">

    window.addEventListener(window,"load", function() {
        var loginForm = document.getElementById("LoginForm");
        window.addEventListener(loginForm, "submit", function() {
            login(loginForm);
        });
    });

    function login(){
        let meno = $('#meno');
        let priezvisko = $('priezvisko');
        let login = $('login');
        let passwd = $('passwd');
        let email = $('email');

        let at  = email.indexOf('@');

        if(!/^[a-zA-Z0-9]+$/.test(login)){ // check username allowed capital and small letters
            alert('Pouzivatelske meno musi obsahovat iba male / velke pismena a cislice od 0-9!!');
        }
        else if(!/^[a-zA-Z]+$/.test(meno)){
            alert('Meno prosim bez diakritiky!!');
        }
        else if(!/^[a-zA-Z]+$/.test(priezvisko)){
            alert('Priezvisko prosim bez diakritiky!!');
        }
        else if(email == ''){ //check email not empty
            alert('Prosim zdaj emailovu adresu!!');
        }
        else if(at < 1 && at >= email.length){ //check valid email format
            alert('Prosim zadaj korektnu emailovu adresu !!');
        }
        else if(passwd == ''){ //check password not empty
            alert('prosim zadaj heslo !!');
        }
        else if(passwd.length < 6){ //check password value length six
            alert('heslo musi mat minimalne 6 znakov !!');
        }
        else{
            $.ajax({
                url: 'register.php',
                type: 'post',
                data:
                    {   newName:    meno,
                        newSurname: priezvisko,
                        newLogin:   login,
                        newPasswd:  passwd,
                        newEmail:   email
                    },
                success: function(response){
                    $('#message').html(response);
                }
            });

            $('#registrationForm')[0].reset();
        }
    }
</script>

    <div class="center" >
        <form id="registrationForm" onsubmit="return false">
        <h3>Vytvoriť nový účet</h3>
        <p>Prosím zadajte nasledovné informácie.</p>
        <form class="needs-validation" novalidate>
            <div class="row">
                <div class="col-sm-1">
                    <label for="meno">Meno</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="w3-input w3-border" style="width:30%" name="meno" id="meno" placeholder="" value="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1">
                    <label for="priezvisko">Priezvisko</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="w3-input w3-border" style="width:30%" name="priezvisko" id="priezvisko" placeholder="" value="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1">
                    <label for="login">Login</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="w3-input w3-border" style="width:30%" name="login" id="login" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1">
                    <label for="passwd">Heslo</label>
                </div>
                <div class="col-sm-8">
                    <input type="password" class="w3-input w3-border" style="width:30%" name="passwd" id="passwd" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1">
                    <label for="email">Email</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="w3-input w3-border" style="width:30%" name="email" id="email" placeholder="" required>
                </div>
            </div>
            <br>
            <input  type="submit" class="btn btn-success" id="register" name="register" value="Vytvoriť">
            <br>

            <div id="message"></div>


        </form>
    </div>

</body>
</html>