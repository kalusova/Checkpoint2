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
<?php
if($_SESSION["LoginOK"] == 0){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Brand -->
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">Overview <span class="sr-only"></span></a>
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
            <li class="nav-item active">
                <a class="nav-link" href="newOrder.php">New Order <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0" formaction="index.html">Log out</button>
    </form>
</nav>

<form id = "formSave" action="admin.php" method="post">
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
            <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="validateDate()">Save order</button>
            <br>

        </form>
    </div>
</form>

<script>
    function validateDate() {
        let regex = new RegExp('^\\d{4}-\\d{2}-\\d{2}$');
        if(!(String(document.getElementById('date').value).match(regex))){
            alert("wrong format, enter date in YYYY-MM-DD");
            return false;  // Invalid format
        }
        else {
            $("#formSave").submit();
        }
    }
</script>
<?php } else { ?>
    <script>window.location.assign("login.php")</script>
<?php } ?>
</body>
</html>