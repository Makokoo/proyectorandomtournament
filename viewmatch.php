<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */
include_once 'funciones.php';
session_start();
$cuenta = 0;
$datos_usuario['username'] = "";

if(isset($_SESSION['usuario'])) {
    $datos_usuario = getDatosUsuario($_SESSION['usuario']);

}





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
    <style>

        .msgerror{
            color: #990000;
        }


    </style>
    
</head>

<body>


<nav class="main-nav-outer" id="test">
    <!--main-nav-start-->
    <div class="container">
        <ul class="main-nav">
            <li><a href="index.php">INICIO</a></li>
            <li><a href="tournaments.php">TORNEOS</a></li>
            <li><a href="quienessomos.php">TIENDA</a></li>
            <li class="small-logo"><a href="index.php"><img src="img/small-logo.png" alt=""></a></li>
            <li><a href="quienessomos.php">QUIENES SOMOS</a></li>


            <?php
            if(!isset($_SESSION['usuario'])) {
                ?>

                <li><a href='login.php'>Iniciar Sesión</a></li>

                <?php
            }else{
                ?>

                <li><a href="profile.php">Mi Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>

                <?php
            }
            ?>
        </ul>

        <a class="res-nav_click" href="#"><i class="fa fa-bars"></i></a>
    </div>
</nav>



<div class="container">
    <section class="main-section contact" id="contact">
        <div class="row">

                
            <?php
            //Si me pasan una id muestro el bracket y la información del torneo
            if(isset($_GET['id']) || isset($_POST['idtournament'])) {
                $datos_partida = getPartida($_GET['id']);
                //var_dump($datos_partida['local']);
                echo "<h1 class='text-center'>".strtoupper(getNombreId($datos_partida['local']))." VS ".strtoupper(getNombreId($datos_partida['visitante']))."</h1>";

                $plocal = getImagenPersonaje($datos_partida['p_local']);
                $plocal = $plocal['imagen'];
                $pvisitante = getImagenPersonaje($datos_partida['p_visitante']);
                $pvisitante = $pvisitante['imagen'];
                echo "<table class='table table-bordered'>";
                echo "<td>LOCAL</td><td>INFORMACION</td><td>VISITANTE</td>";
                echo "<tr></tr><td><img style='width: 50%; float:right' src='$plocal'></td>";
                echo "<td></td>";
                echo "<td><img style='width: 65%' src='$pvisitante'></td>";
                echo "</table>";

            } else {
                //Si no me pasan una id por GET muestro un mensaje.
                echo "<span class='warning'>Debe seleccionar una partida para ver su información</span>";
            }

            ?>

        
        </div>
    </section>
</div>



<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a href="#"><img src="img/footer-logo.png" alt=""></a></div>
        <span class="copyright">&copy; RandomTournament. All Rights Reserved</span>
        <div class="credits">
            RandomTournament by Sergio Molina
        </div>
    </div>
</footer>



</body>

</html>
