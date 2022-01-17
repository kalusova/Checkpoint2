<?php
require_once "db_connect.php";
require_once "DB_Storage.php";

$login_val = $_POST["login"];

$storage = new DB_Storage($mysqli);
$storage->deleteCustomer($login_val);

?>