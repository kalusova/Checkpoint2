<?php
 
//echo "ŠTARTUJEM!";
 
require_once "db_connect.php";
require_once "DB_Storage.php";
 
// hodnoty zaslane cez POST
$meno_val = $_POST["meno"];
$priezvisko_val = $_POST["priezvisko"];
$login_val = $_POST["login"];
$passwd_val = $_POST["passwd"];
$email_val = $_POST["email"];
 
// TO-DO: pridať kontrolu na strane servera na formáty
 

// vytvorím inštanciu
$storage = new DB_Storage($mysqli);
 
$storage->newCustomer($meno_val, $priezvisko_val, $login_val, $passwd_val, $email_val);

?>