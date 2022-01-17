<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../database/db_connect.php';
include '../database/DB_Storage.php';

$storage = new DB_Storage($mysqli);
$customers = $storage->getAllCustomers();


?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration Module</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
            integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
            crossorigin="anonymous"></script>

</head>
<body>
<?php
if($_SESSION["LoginOK"] == 0 && $_SESSION["role"] == 'admin'){
?>

<script type="text/javascript">
    function vymazZakaznika(zakaznik_login) {
        //alert("click");
        $.post("../database/customer_delete.php", {login: zakaznik_login},
            function(data){
                alert(data);
                if (data == "OK") { // ak je vsetko OK
                    window.location.href = "administration.php";
                }

            });
    }

    function zmena(ident) {
        let meno_val = $('#meno_'+ident).val();
        let priezvisko_val = $('#priezvisko_'+ident).val();
        let login_val = $('#login_'+ident).val();
        let email_val = $('#email_'+ident).val();

        $.post("../database/customer_save.php", {meno: meno_val, priezvisko: priezvisko_val, login: login_val, email: email_val},
            function(data){
                alert(data);

                //window.alert(meno_val +" "+ priezvisko_val +" "+ login_val +" "+ email_val);
                if (data == "OK") { // ak je vsetko OK
                    window.location.href = "administration.php";
                }

            });
    }
</script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Brand -->
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="administration.php" style="font-weight: bold">Administration <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="invoices.php">Invoices <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>

    <form class="form-inline my-2 my-lg-0">
        <button type="button" class="btn btn-outline-success my-2 my-sm-0" id="logOut">Log out</button>
    </form>
</nav>
<div>
    <table>
        <thead>
        <tr class="nazvy">
            <th scope="col">Login</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>

        <?php foreach ($customers as $customer) { ?>
            <tr>
                <td><input disabled id="login_<?= $customer->getLogin() ?>" type="text" value="<?php echo $customer->getLogin() ?>"></td>
                <td><input autocomplete="off" id="meno_<?= $customer->getLogin() ?>" onchange="zmena('<?= $customer->getLogin() ?>');" maxlength="500"  type="text" value="<?php echo $customer->getName() ?>"></td>
                <td><input autocomplete="off" id="priezvisko_<?= $customer->getLogin() ?>" onchange="zmena('<?= $customer->getLogin() ?>');" maxlength="500"  type="text" value="<?php echo $customer->getSurname() ?>"></td>
                <td><input autocomplete="off" id="email_<?= $customer->getLogin() ?>" onchange="zmena('<?= $customer->getLogin() ?>');" maxlength="500"  type="text" value="<?php echo $customer->getEmail() ?>"></td>
                <td><a onclick="vymazZakaznika('<?= $customer->getLogin() ?>');"> <img
                                src="https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png"
                                alt="Delete" style="width:20px;height:20px;"> </a></td>
            </tr>
            <?php
        } ?>
        </thead>
    </table>
</div>

<!-- The Modal -->
<div id="myModal" class="modal" role="dialog" aria-hidden="true">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Youre about to log ou.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>ARE YOU SURE?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="yes">YES</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close" >NO</button>
        </div>

    </div>
</div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("logOut");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        var cls = document.getElementById("close");
        var yes = document.getElementById("yes");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks on CLOSE, close the modal
        cls.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks on CLOSE, close the modal
        yes.onclick = function() {
            modal.style.display = "none";
            window.location.assign("login.php")
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>

        function validateDate() {
            let regex = new RegExp('^\\d{4}-\\d{2}-\\d{2}$');

            if (!(String(document.getElementById('end').value).match(regex)) && (!(String(document.getElementById('start').value).match(regex))){
                alert("wrong format, enter date in YYYY-MM-DD");
                return false;  // Invalid format
            } else {
                $("#formUpdate").submit();
            }
        }
    </script>

    <?php } else { ?>
        <script>window.location.assign("login.php")</script>
    <?php } ?>
</body>
</html>

