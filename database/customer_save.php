<?php
require_once "db_connect.php";
require_once "DB_Storage.php";

$meno_val = $_POST["meno"];
$priezvisko_val = $_POST["priezvisko"];
$login_val = $_POST["login"];
$email_val = $_POST["email"];


if(!preg_match("/^[a-zA-Z0-9]+$/",$login_val)){ // check username allowed capital and small letters
    echo '<script>alert("Pouzivatelske meno musi obsahovat iba male / velke pismena a cislice od 0-9!!")</script>';
}
else if(!preg_match("/^[a-zA-Z]+$/",$meno_val)){
    echo '<script>alert("Meno prosim bez diakritiky!!")</script>';
}
else if(!preg_match("/^[a-zA-Z]+$/",$priezvisko_val)){
    echo '<script>alert("Priezvisko prosim bez diakritiky!!")</script>';
}
else if($email_val == ''){ //check email not empty
    echo '<script>alert("Prosim zadaj email")</script>';
}
else if(!filter_var($email_val, FILTER_VALIDATE_EMAIL)){
    echo '<script>alert("Prosim zadaj korektnu emailovu adresu !!")</script>';
}
else{
    $storage = new DB_Storage($mysqli);
    $storage->editCustomer($meno_val, $priezvisko_val, $login_val, $email_val);
}
?>
