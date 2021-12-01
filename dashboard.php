<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';
include 'DB_Storage.php';

$storage = new DB_Storage($mysqli);
$orders = $storage->getAll();

if(isset($_POST["firstName"])){
    $meno=$_POST["firstName"];
    $priezvisko=$_POST["lastName"];
    $datum = $_POST["date"];
    $login_ok = 0;
    $storage->createOrder($meno, $priezvisko, $datum, "Open");
    header("Refresh:0");
}
elseif (isset($_POST["id"])){
    $id = $_POST["id"];
    $storage->deleteRow($id);
    header("Refresh:0");
}
elseif (isset($_POST["id_state"])){
    $id = $_POST["id_state"];
    $state = $_POST["state"];
    $storage->editState($id, $state);
    header("Refresh:0");
}
elseif (isset($_POST["id_end"])){
    $id = $_POST["id_end"];
    $end = $_POST["end"];
    $storage->editEnd($id, $end);
    header("Refresh:0");
}

ob_end_flush();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Brand -->
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Orders
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Waiting</a>
                    <a class="dropdown-item" href="#">Closed</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">All orders</a>
                </div>
            </li>
        </ul>
    </div>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0" formaction="login.html">Log out</button>
    </form>
</nav>
<form action="dashboard.php" method="post">
    <div class="container" >
        <h2>List of orders</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Acceptance Date</th>
                <th scope="col">Closing Date</th>
                <th scope="col">State</th>
            </tr>


            <?php foreach ($orders as $order) {?>
                <tr>
                    <td><?php echo $order->getId()?></td>
                    <td><?php echo $order->getName()?></td>
                    <td><?php echo $order->getSurname()?></td>
                    <td><?php echo $order->getStart()?></td>
                    <td><?php echo $order->getEnd()?></td>
                    <td><?php echo $order->getState()?></td>
                </tr>
                <?php
            } ?>
            </thead>
        </table>
    </div>
</form>

<form action="dashboard.php" method="post">
    <div class="container" >
        <h3>New order</h3>
        <p>Please Enter following information</p>
        <form class="needs-validation" novalidate>
            <label for="firstName">First name</label>
            <input type="text" class="w3-input w3-border" style="width:20%" name="firstName" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
                Valid first name is required.
            </div>
            <label for="lastName">Last name</label>
            <input type="text" class="w3-input w3-border" style="width:20%" name="lastName" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
                Valid last name is required.
            </div>
            <label for="date">Date</label>
            <input type="text" class="w3-input w3-border" style="width:20%" name="date" id="date" placeholder="YYYY-MM-DD" required>
            <div class="invalid-feedback">
                Please enter starting date.
            </div>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Save order</button>
            <br>

        </form>
    </div>
</form>

<form action="dashboard.php" method="post">
    <div class="container" >
        <h3>Edit State</h3>
        <p>Please Enter ID of order that you want to EDIT</p>
        <label for="id">Order ID</label>
        <input type="text" class="w3-input w3-border" style="width:20%" name="id_state" id="id_state" placeholder="Enter Order ID" value="" required>
        <label for="id">State</label>
        <input type="text" class="w3-input w3-border" style="width:20%" name="state" id="state" placeholder="Enter state" value="" required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Edit</button>
        <br>
    </div>
</form>

<form id="form_edit" action="dashboard.php" method="post" >
    <div class="container" >
        <h3>Edit Closing Date</h3>
        <p>Please Enter ID of order that you want to EDIT</p>
        <label for="id">Order ID</label>
        <input type="text" class="w3-input w3-border" style="width:20%" name="id_end" id="id_end" placeholder="Enter Order ID" value="" required>
        <label for="id">Closing Date</label>
        <input type="text" class="w3-input w3-border" style="width:20%" name="end" id="end" placeholder="YYYY-MM-DD" value="" required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="validateDate()" >Edit</button>
        <br>
    </div>
</form>

<form action="dashboard.php" method="post">
    <div class="container" >
        <h3>Delete order</h3>
        <p>Please Enter ID of order that you want to DELETE</p>
        <label for="id">Order ID</label>
        <input type="text" class="w3-input w3-border" style="width:20%" name="id" id="id" placeholder="Enter Order ID" value="" required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Delete</button>
        <br>
    </div>
</form>

<script>
    function validateDate() {
        let regex = new RegExp('^\\d{4}-\\d{2}-\\d{2}$');
        if(!(String(document.getElementById('end').value).match(regex))){
            alert("wrong format, enter date in YYYY-MM-DD");
            return false;  // Invalid format
        }
        else {
            $("#form_edit").submit();
        }
    }
</script>

</body>
</html>
