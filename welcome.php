<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 16/04/2018
 * Time: 21:26
 */






?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">

    <title>Homepage</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="shortcut icon" href="favicon.ico" type="img/x-icon">

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">


    <!-- =======================================================
    Theme Name: Knight
    Theme URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
    ======================================================= -->

</head>

<body>
<header class="header" id="header">
    <!--header-start-->
    <div class="container">
        <figure class="logo animated fadeInDown delay-07s">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </figure>
        <?php
        if(isset($_GET['user'])) {

            echo "<h1 class='animated fadeInDown delay-07s'>Bienvenido " . $_GET['user'] . "</h1>";
            echo "<ul class='we-create animated fadeInUp delay-07s'>";
            echo "<li>Entrando en el sitio...</li>
        </ul>";
            header("Refresh:3; url='home.php'");
        }

?>

    </div>
</header>
<!--header-end-->




</body>

</html>
