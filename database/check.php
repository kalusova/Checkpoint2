<?php
session_start();
ini_set('display_errors', 1);
include 'db_connect.php';

$meno_login=$_POST["u_name"];
$heslo_login=$_POST["psw"];
$login_ok = 0;
$admin = 0;
$customer = 0;


$sql = "SELECT password FROM user where login='".$meno_login."'";

if ($result = $mysqli -> query($sql)) {
    $row = mysqli_fetch_assoc($result);
    $heslo_hash=$row["password"];
    if(password_verify($heslo_login,$heslo_hash)){
        //echo'Password is valid!';
        $login_ok=1;

        $query = "SELECT role FROM user where login='".$meno_login."'";

        if($result = $mysqli->query($query)){
            $row = mysqli_fetch_assoc($result);
            $role = $row["role"];
        }
    }else{
        //echo'Invalid password.';
        $login_ok=0;
    }
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
