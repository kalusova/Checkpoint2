<?php
session_start();
 
// na toto pozor, vynucuje to vypisovanie chyb z PHP, len neviem preco u mna na serveri to nefunguje....
// je to potlacene, ale inde to moze vypisovat warningy, takze vo final verzii oba riadky zakomentovať
ini_set('display_errors', 1);
error_reporting(E_ALL);

/* TU TO NIE JE TREBA, moze sa vymazat
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
*/
?>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registracia</title>
    <!-- CSS -->
 
    <!-- MUSEL som zakomentovat blblo zobrazenie znakov.... -->
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
 
        //kontrola hodnot cez alert
        //alert(meno_val + " " + priezvisko_val + " " + login_val + " " + passwd_val + " " + email_val);
 

        $.post("../database/register_save.php", {meno: meno_val, priezvisko: priezvisko_val, login: login_val, passwd: passwd_val, email: email_val},
            function(data){
                alert(data);
                
                if (data == "OK") { // ak je vsetko OK
                    window.location.href = "login.php";
                }
                
            });
    }
 
    // nie je treba, zmenil som button vo formulari z typu SUBMIT na typ BUTTON a pridal event ONCLICK priamo tam :)
    // taktiež dva vnorené FORM taky som zlucil do jedneho, FORM je vzdy len jeden a nemozes mat vnoreny druhy :)
    /* TOTO mozes VYMAZAT
    window.addEventListener(window,"load", function() {
        var loginForm = document.getElementById("LoginForm");
        window.addEventListener(loginForm, "submit", function() {
            login(loginForm);
        });
    });
    */
 
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
 