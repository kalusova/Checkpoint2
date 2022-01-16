<?php
session_start();
ini_set('display_errors', 1);
include 'db_connect.php';

$meno_login=$_POST["u_name"];
$heslo_login=$_POST["psw"];
$login_ok = 0;
$admin = 0;
$customer = 0;


$sql = "SELECT count(*) as pocet FROM user where login='".$meno_login."' and password='".$heslo_login."'";

if ($result = $mysqli -> query($sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $login_ok=$row["pocet"];
    }
}

$query = "SELECT * FROM user u where login='".$meno_login."' and password='".$heslo_login."'";
if($result = $mysqli->query($query)){
    $row = $result->fetch_row() ;
    $role = $row[2];
}

$result -> free_result();
$mysqli -> close();

if ($login_ok==1) {
    $_SESSION["LoginOK"] =  "0" ;
    $_SESSION["username"] = $meno_login;
}
else {
    $_SESSION["LoginOK"] =  "1" ;
}

echo $role;
if ($role == 'admin') {
    $admin = 1;
    $_SESSION["role"] = $role;
} elseif ($role == 'customer'){
    $customer = 1;
    $_SESSION["role"] = $role;
}

?>

<html lang="utf8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
<?php
if ($login_ok == 1 && $admin == 1) {
    ?>
    <SCRIPT language="JavaScript">
        window.location="../pages/admin.php";
    </SCRIPT>
<?php
} elseif ($login_ok == 1 && $customer == 1){
?>
    <SCRIPT language="JavaScript">
        window.location="../pages/index.php";
    </SCRIPT>
<?php
} else {
?>
    <SCRIPT language="JavaScript">
        window.location="../pages/login.php";
    </SCRIPT>
    <?php
}
?>
</body>
</html>
