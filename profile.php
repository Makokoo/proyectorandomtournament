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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Random Tournament</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 890px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            background-color: #555;
            text-align: center;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-tower"></span></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Torneos</a></li>
                <li><a href="#">Tienda</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>

            <?php
            if(!isset($_SESSION['usuario'])) {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><button onclick="location.href = 'login.php'" class="btn" style="width:auto;"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesión</button>/li>
                </ul>
                <?php
            }else{
               ?>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                </ul>
            <?php
            }
            ?>
        </div>
    </div>
</nav>


<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p><a href="#">Link</a></p>
            <p><a href="#">Link</a></p>
            <p><a href="#">Link</a></p>
        </div>

        <div class="col-sm-8 text-left">
            <h1>Hola <?=$datos_usuario['username']?></h1>
            <hr>
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

            <hr>

            <h3 class="text-center">Estadísticas</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?=$porcganadas?>%">
                    Victorias(<?=$porcganadas?>%)
                </div>
                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?=$porcempatadas?>%">
                    Empates(<?=$porcempatadas?>%)
                </div>
                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?=$porcperdidas?>%">
                    Derrotas(<?=$porcperdidas?>%)
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

        <div class="col-sm-2 sidenav">
            <div class="well">
                <p>ADS</p>
            </div>
            <div class="well">
                <p>ADS</p>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

</body>
</html>