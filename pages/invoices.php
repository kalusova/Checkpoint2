<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../database/db_connect.php';
include '../database/DB_Storage.php';

$storage = new DB_Storage($mysqli);
$invs = $storage->getAllInvoices();


?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Module</title>
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
                    <a class="nav-link" href="administration.php" >Administration <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="invoices.php" style="font-weight: bold">Invoices <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>

        <form class="form-inline my-2 my-lg-0">
            <button type="button" class="btn btn-outline-success my-2 my-sm-0" id="logOut">Log out</button>
        </form>
    </nav>

    <div class="container">
        <h2>Orders</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">IssueDate</th>
                <th scope="col">State</th>
            </tr>

            <?php foreach ($invs as $inv) { ?>
                <tr>
                    <td><?php echo $inv->getIssueDate() ?></td>
                    <td><?php echo $inv->getState()  ?></td>
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


<?php } else { ?>
    <script>window.location.assign("login.php")</script>
<?php } ?>
</body>
</html>

