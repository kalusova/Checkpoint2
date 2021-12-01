<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';
include 'DB_Storage.php';

$storage = new DB_Storage($mysqli);
$orders = $storage->getAll();

if (isset($_POST["firstName"]) and !(isset($_GET['edit']))) {
    $meno = $_POST["firstName"];
    $priezvisko = $_POST["lastName"];
    $datum = $_POST["date"];
    //$login_ok = 0;
    $storage->createOrder($meno, $priezvisko, $datum, "Open");
    header("Refresh:0");
} elseif (isset($_GET['delete'])) {
    $idNum = intval($_GET['delete']);
    $storage->deleteRow($idNum);
    header('Location: dashboard.php');
} elseif (isset($_GET['editState'])) {
    $id = intval($_GET['editState']);
    $state = "Sent";
    $storage->editState($id, $state);
    header('Location: dashboard.php');
} elseif (isset($_POST['save'])) {
    echo "SOM TU";
    $id = intval($_GET['edit']);
    $meno = $_POST["firstName"];
    $priezvisko = $_POST["lastName"];
    $datum = $_POST["start"];
    $stav = 'Open';
    $storage->editOrder($id, $meno, $priezvisko, $datum, $stav);
    header('Location: dashboard.php');
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
            integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
            crossorigin="anonymous"></script>

</head>
<body>

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
                <a class="nav-link" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Orders
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Waiting</a>
                    <a class="dropdown-item" href="#">Closed</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">All orders</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="form.html">New Order <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0" formaction="index.html">Log out</button>
    </form>
</nav>

    <div class="container">
        <h2>List of orders</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Acceptance Date</th>
                <th scope="col">Sending Date</th>
                <th scope="col">State</th>
                <th scope="col">Actions</th>
            </tr>

            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?php echo $order->getId() ?></td>
                    <td><?php echo $order->getName() ?></td>
                    <td><?php echo $order->getSurname() ?></td>
                    <td><?php echo $order->getStart() ?></td>
                    <td><?php echo $order->getEnd() ?></td>
                    <td><?php echo $order->getState() ?></td>
                    <td>
                        <a href="?delete=<?= $order->getId() ?>"> <img
                                    src="https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png"
                                    alt="Delete" style="width:20px;height:20px;"> </a>
                        <a href="?edit=<?= $order->getId() ?>"> <img
                                    src="https://cdn.pixabay.com/photo/2017/06/21/07/51/icon-2426370_1280.png"
                                    alt="Edit" style="width:20px;height:20px;"> </a>
                        <a href="?editState=<?= $order->getId() ?>"> <img
                                    src="https://cdn1.iconfinder.com/data/icons/jetflat-multimedia-vol-4/90/0042_089_check_well_ready_okey-512.png"
                                    alt="EditState" style="width:20px;height:20px;"> </a>
                    </td>
                </tr>
                <?php
            } ?>
            </thead>
        </table>
    </div>

<?php
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    foreach ($orders as $order) {
        if ($order->getId() == $id) {
            break;
        }
    }
    ?>
    <form id="formUpdate" method="post">
        <div class="container">
            <h3>Update order</h3>
            <p>Please Update following information</p>
            <form class="needs-validation" novalidate>
                <label for="firstName">First name</label><br>
                <input type="text" class="w3-input w3-border" style="width:20%" name="firstName"
                       id="firstName" value="<?= $order->getName() ?>" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div><br>
                <label for="lastName">Last name</label><br>
                <input type="text" class="w3-input w3-border" style="width:20%" name="lastName"
                       id="lastName" value="<?= $order->getSurname() ?>" required>
                <div class="invalid-feedback">
                    Valid last name is required.
                </div><br>
                <label for="start">Acceptance Date</label><br>
                <input type="text" class="w3-input w3-border" style="width:20%" name="start" id="start"
                       value="<?= $order->getStart() ?>" required>
                <div class="invalid-feedback">
                    Please enter starting date.
                </div><br>
                <input type="submit" name="save" value="Odoslať">
                <br><br>

            </form>
        </div>
    </form>
    <?php
} ?>


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


</body>
</html>
