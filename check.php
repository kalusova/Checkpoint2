<?php
ob_start();
ini_set('display_errors', 1);
include 'db_connect.php';

$meno_login=$_POST["u_name"];
$heslo_login=$_POST["psw"];
$login_ok = 0;

$sql = "SELECT count(*) as pocet FROM users where login='".$meno_login."' and pass='".$heslo_login."'";

if ($result = $mysqli -> query($sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $login_ok=$row["pocet"];
    }

}

$result -> free_result();
$mysqli -> close();

if ($login_ok==1) {
    setcookie("LoginOK", "1", time()+3600);
}
else {
    setcookie("LoginOK", "0", time()+3600);
}

?>

<html lang="utf8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
<?php
if ($login_ok==1) {
    ?>
    <SCRIPT language="JavaScript">
        window.location="dashboard.php";
    </SCRIPT>
<?php
}
else {
?>
    <SCRIPT language="JavaScript">
        window.location="login.html";
    </SCRIPT>
    <?php
}
ob_end_flush();
?>
</body>
</html>
