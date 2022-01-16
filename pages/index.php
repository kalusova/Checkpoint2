<?php
session_start();
//echo "Hello customer";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
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

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    </div>
    <form class="form-inline my-2 my-lg-0">
        <?php
        if($_SESSION["LoginOK"] == 0 && $_SESSION["role"] == 'customer'){
        ?>
        <a type="button" href="profile.php" class="btn btn-outline-success my-2 my-sm-0" id="profile" >Profile</a>
        <a type="button" href="login.php" class="btn btn-outline-success my-2 my-sm-0" id="logOut" >Log out</a>
        <?php
        } else {?>
        <?php } ?>
    </form>
</nav>

<div class="uvod text-center" >
    <br>
    <h1>VITAJTE!</h1>
    <br>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>O nás</h3>
            <p>Sme upratovacia firma zameraná na komplexné čistiace a upratovacie práce, tepovanie a dezinfekciu ozónom. Zabezpečujeme upratovanie bytových domov, rodinných domov, bytov, firiem, kancelárií a rôznych iných priestorov. Rozsah prác je stanovený presne podľa požiadaviek klienta tak, aby čo najviac vyhovoval jeho potrebám. Spokojnosť je pre nás prioritou, preto ku každému pristupujeme individuálne a dbáme na precíznosť a detail. Upratovacie práce vykonávame s využitím najmodernejšej upratovacej techniky spolu s čistiacimi prostriedkami tých najlepších značiek na trhu.</p>
        </div>
        <div class="col-sm-4">
            <h3>Naša práca</h3>
            <img src="https://www.abeja.sk/download/B20190410T000000020.jpg" style="width:100%;height:auto;">
            <img src="https://www.amiida.sk/wp-content/uploads/2020/05/upratovacie-slu%C5%BEby-1024x642.jpg" style="width:100%;height:auto;">
        </div>
        <div class="col-sm-4">
            <h3>Chceš si nás objednať?</h3>
            <?php
            if($_SESSION["LoginOK"] == 0 && $_SESSION["role"] == 'customer'){
            ?>
                <a type="button" href = "#" id="objednaj" >Objednaj služby!</a><br>
            <?php } else {?>
                <p>Pre objednanie je potrebné sa prihlásiť alebo zaregistrovať!</p>
                <a href = "login.php">Pre PRIHLÁSENIE klikni sem!</a><br>
                <a href = "../pages/registration.php">Pre REGISTRÁCIU klikni sem!</a>
            <?php } ?>

        </div>
    </div>
</div>

</body>
</html>

