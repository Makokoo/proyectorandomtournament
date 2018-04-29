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








        .tournament{width:720px;}

        .round{
            float:left;
        }

        .player{
            font-family:arial;
            width:120px;
            height:40px;
            padding:10px;
            background:#73789F;
            color:white;
        }

        .player.winner{background:green;}

        .match{
            padding:5px 50px 5px 0px;
        }

        /*QUARTER-FINALS*/
        .quarter-finals .match{
            height:100px;
            background:right top no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAABkAQMAAAD+JvEYAAAAA3NCSVQICAjb4U/gAAAABlBMVEUAAAD///+l2Z/dAAAACXBIWXMAAAsSAAALEgHS3X78AAAAFnRFWHRDcmVhdGlvbiBUaW1lADEwLzEwLzEyGAKeIwAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNAay06AAAAAnSURBVCiRY/gPBgcYhjoNBPZQ/v4hQjeAHD0I3IGXRgpXqsbXEKEB2yGL0P7iVKIAAAAASUVORK5CYII=);
        }
        .quarter-finals .player{

        }
        .quarter-finals .player:first-child{
            margin-bottom:5px;
        }

        /*SEMI-FINALS*/
        .semi-finals .match{
            padding-top:30px;
            height:185px;
            background:right top no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAC5AQMAAABQhv7pAAAAA3NCSVQICAjb4U/gAAAABlBMVEUAAAD///+l2Z/dAAAACXBIWXMAAAsSAAALEgHS3X78AAAAFnRFWHRDcmVhdGlvbiBUaW1lADEwLzEwLzEyGAKeIwAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNAay06AAAAArSURBVDiNY/gPBgcYRumBpYHAHsrfP0oPKboBFHmDwB2jNAk0Un77PwxoAJbztvAUr3KAAAAAAElFTkSuQmCC);
        }

        .semi-finals .player:first-child{
            margin-bottom:70px;
        }

        /*FINALS*/
        .finals .match{
            padding-top:85px;
            height:350px;
            background:top right no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAFeAQMAAAD9sN5nAAAAA3NCSVQICAjb4U/gAAAABlBMVEUAAAD///+l2Z/dAAAACXBIWXMAAAsSAAALEgHS3X78AAAAFnRFWHRDcmVhdGlvbiBUaW1lADEwLzEwLzEyGAKeIwAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNAay06AAAAA0SURBVEiJY/gPBgcYRulRepQmngYCeyh//yg9So/Sg45uAGXSQeCOUXqUHrI0Uj33fxjQAEJS8U50LMSKAAAAAElFTkSuQmCC);
        }

        .finals .player:first-child{
            margin-bottom:180px;

        }
        /* CHAMP*/
        .champion{padding-top:200px;}















        .col-1-8 {
            width: 12.5%;
            float: left;
        }
        .round-two-top {
            padding: 45px 0 0;
        }
        .round-two-bottom {
            padding: 80px 0 0;
        }
        .round-three {
            padding: 127px 0 0;
        }
        .col-1-4 {
            width: 25%;
            float: left;
        }
        .col-1-3 {
            width: 33.333%;
            float: left;
        }
        .col-1-2 {
            width: 50%;
            float: left;
        }
        .col-2-3 {
            width: 66.66%;
            float: left;
        }
        .col-100 {
            width: 100%;
            float: left;
        }
        ul.matchup {
            margin: 0;
            width: 100%;
            padding: 10px;
        }
        ul.matchup li {
            padding: 0;
            margin: 3px 5px;
            height: 25px;
            line-height: 25px;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            border: 1px solid #cccccc;
        }
        .seed {
            background: #e7e7e7;
            padding: 5px 10px;
        }

        @media screen and (min-width: 401px) and (max-width: 680px) {
            .col-1-8 {
                width: 25%;
            }
        }

        @media screen and (max-width: 400px) {
            .col-1-8 {
                width: 33%;
            }
            .champ {
                width:100%;
            }
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

            <?php
            //Si me pasan una id muestro el bracket y la información del torneo
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $datos_torneo = getDatosTorneo($id);
                $lista = $datos_torneo['participantes'];
                $participantes = explode(",", $lista);
                $datos_partidas = getPartidasTorneo($id);
                $contador = 0;

                //echo '<pre>';
                //var_dump(getPartidasTorneo($id));
                //echo '</pre>';


        //PRIMERA RONDA
                ?>
                <div class="col-1-8">

                    <?php
                    for($i=0; $i<($datos_torneo['max_participantes']/2); $i++){
                        if($i < count($datos_partidas)) {
                            echo "<ul class='matchup'>
                            <li><span class='seed'>" . $datos_partidas[$i]['local'] . "</span> " . getNombreId($datos_partidas[$i]['local']) . "<span class='score'></span></li>
                            <li><span class='seed'>" . $datos_partidas[$i]['visitante'] . "</span> " . getNombreId($datos_partidas[$i]['visitante']) . "<span class='score'></span></li>
                            </ul>";

                            $contador++;

                        }else{
                            echo "<ul class='matchup'>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            </ul>";
                        }
                    }


                    if($contador < ($datos_torneo['max_participantes']/2)){
                        echo "</div>
                    <div class='col-1-8'>
                        <div class='round-two-top'>
                            <ul class='matchup'>
                                <li><span class='seed'></span> <span class='score'></span></li>
                                <li><span class='seed'></span> <span class='score'></span></li>
                            </ul>
                        </div>
                        <div class='round-two-bottom'>
                            <ul class='matchup round-two-bottom'>
                                <li><span class='seed'></span> <span class='score'></span></li>
                                <li><span class='seed'></span> <span class='score'></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class='col-1-8 champ'>
                        <div class='round-three'>
                            <ul class='matchup'>
                                <li><span class='seed'></span> <span class='score'></span></li>
                                <li><span class='seed'></span> <span class='score'></span></li>
                            </ul>
                        </div>
                    </div>";

                    }
                    ?>















                <?php



            }else{
                //Si no me pasan una id por GET muestro un mensaje.
                echo "<span class='warning'>Debe seleccionar un torneo para ver su información</span>";
            }
            ?>

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