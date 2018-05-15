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

$partidas_jugadas = contPartidasjugadas($datos_usuario['id_usuario']);
$partidas_ganadas = contPartidasganadas($datos_usuario['id_usuario']);
$partidas_empatadas = contPartidasempatadas($datos_usuario['id_usuario']);
$partidas_perdidas = contPartidasperdidas($datos_usuario['id_usuario']);

$porcganadas = 0;
$porcperdidas = 0;
$porcempatadas = 0;




if($partidas_jugadas > 0) {
    if ($partidas_ganadas == 0) {
        $porcganadas = 0;
    } else {
        $porcganadas = (100 * $partidas_ganadas) / $partidas_jugadas;
    }

    if($partidas_empatadas == 0){
        $porcempatadas = 0;
    }else {
        $porcempatadas = (100 * $partidas_empatadas) / $partidas_jugadas;
    }

    if($partidas_perdidas == 0){
        $porcperdidas = 0;
    }else{
        $porcperdidas = (100 * $partidas_perdidas) / $partidas_jugadas;
    }
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
<!--main-nav-end-->



<!--business-talking-end-->
<div class="container">
    <section class="main-section contact" id="contact">

        <div class="row">
            <div class="col-lg-6 col-sm-7 wow fadeInLeft">
                <h3 class="text-center">Estadísticas</h3>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?=$porcganadas?>%">
                        Victorias(<?=round($porcganadas,2)?>%)
                    </div>
                    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?=$porcempatadas?>%">
                        Empates(<?=round($porcempatadas,2)?>%)
                    </div>
                    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?=$porcperdidas?>%">
                        Derrotas(<?=round($porcperdidas,2)?>%)
                    </div>
                </div>
                <table class="table text-center">
                    <td>Partidas Jugadas:</td> <td><?=contPartidasjugadas($datos_usuario['id_usuario'])?></td></tr>
                    <tr><td>Victorias</td><td><?=contPartidasganadas($datos_usuario['id_usuario'])?></td></tr>
                    <tr><td>Empates</td><td><?=contPartidasempatadas($datos_usuario['id_usuario'])?></td></tr>

                    <tr><td>Derrotas</td><td><?=contPartidasperdidas($datos_usuario['id_usuario'])?></td></tr>
                    <tr><td>Torneos Ganados:</td><td><?=$datos_usuario['mail']?></td></tr>
                    <tr><td>Puntuación Total:</td><td><?=$datos_usuario['puntuacion']?></td></tr>
                    <tr><td>Puesto clasificación:</td><td><?=$datos_usuario['mail']?></td></tr>
                </table>
            </div>
            <div class="col-lg-6 col-sm-5 wow fadeInUp delay-05s">

                <h3 class="text-center">Datos usuario
                    <a href="modprofile.php">
                        <button type="button" class="btn">
                            <span class="glyphicon glyphicon-pencil"></span> Modificar
                        </button>
                    </a>
                </h3>

                <table class="table text-center">
                    <td>Nombre de usuario:</td> <td><input readonly value="<?=$datos_usuario['username']?>"></td></tr>
                    <tr><td>E-Mail:</td><td><input readonly value="<?=$datos_usuario['mail']?>"></td></tr>
                </table>
            </div>
        </div>
    </section>
</div>








<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a href="#"><img src="img/footer-logo.png" alt=""></a></div>
        <span class="copyright">&copy; RandomTournament. All Rights Reserved</span>
        <div class="credits">
            <!--
      All the links in the footer should remain intact.
      You can delete the links only if you purchased the pro version.
      Licensing information: https://bootstrapmade.com/license/
      Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Knight
    -->
            RandomTournament by Sergio Molina
        </div>
    </div>
</footer>




</body>

</html>










