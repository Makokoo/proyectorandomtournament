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

                $primera_ronda = getPrimeraRonda($id);
                $segunda_ronda = getSegundaRonda($id);
                $final_ronda = getFinal($id);
                echo "<h1 class='text-center'> DATOS TORNEO ".strtoupper($datos_torneo['nombre_torneo'])."</h1>";
                echo "<div class='col-100'>";
                echo "<div class=\"col-1-8\">";

                for ($i = 0 ; $i<count($primera_ronda) ; $i++){
                    $id_partida = $datos_partidas[$i]['id_partida'];
                    echo "<ul class='matchup'>
                            <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>" . $datos_partidas[$i]['local'] . "</span> " . getNombreId($datos_partidas[$i]['local']) . "<span class='score'></span></li></a>
                            <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>" . $datos_partidas[$i]['visitante'] . "</span> " . getNombreId($datos_partidas[$i]['visitante']) . "<span class='score'></span></li></a>
                            </ul>";
                    $contador++;
                }

                while($contador<4){
                    echo "<ul class='matchup'>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            </ul>";
                    $contador++;
                }

                echo "</div>";

                echo "<div class=\"col-1-8\">";
                $contador = 0;
                for ($i = 0 ; $i<count($segunda_ronda) ; $i++){
                    $id_partida = $segunda_ronda[$i]['id_partida'];
                    if($contador == 0) {
                        echo "<div class='round-two-top'><ul class='matchup'>
                            <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>" . $segunda_ronda[$i]['local'] . "</span> " . getNombreId($segunda_ronda[$i]['local']) . "<span class='score'></span></li></a>
                            <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>" . $segunda_ronda[$i]['visitante'] . "</span> " . getNombreId($segunda_ronda[$i]['visitante']) . "<span class='score'></span></li></a>
                            </ul></div>";

                    }else if( $contador == 1){
                        echo "<div class='round-two-bottom'><ul class='matchup'>
                            <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>" . $segunda_ronda[$i]['local'] . "</span> " . getNombreId($segunda_ronda[$i]['local']) . "<span class='score'></span></li></a>
                            <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>" . $segunda_ronda[$i]['visitante'] . "</span> " . getNombreId($segunda_ronda[$i]['visitante']) . "<span class='score'></span></li></a>
                            </ul></div>";
                    }
                    $contador++;
                }

                while($contador<2){
                    if($contador == 0){
                        echo "<div class='round-two-top'><ul class='matchup'>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            </ul></div>";
                        $contador++;
                    }else if($contador == 1){
                        echo "<div class='round-two-bottom'><ul class='matchup'>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            <li><span class='seed'></span> <span class='score'></span></li>
                            </ul></div>";
                        $contador++;
                    }

                }


                echo "</div>";

                if(count($final_ronda)== 0 ) {

                    echo "<div class='col-1-8 champ'>
                        <div class='round-three'>
                            <ul class='matchup'>
                                <li><span class='seed'></span> <span class='score'></span></li>
                                <li><span class='seed'></span> <span class='score'></span></li>
                            </ul>
                        </div>
                    </div>";
                }else{
                    $id_partida = $final_ronda[0]['id_partida'];
                    echo "<div class='col-1-8 champ'>
                        <div class='round-three'>
                            <ul class='matchup'>
                                <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>".$final_ronda[0]['local']."</span> ".getNombreId($final_ronda[0]['local'])." <span class='score'></span></li></a>
                                <a href='viewmatch.php?id=$id_partida'><li><span class='seed'>".$final_ronda[0]['visitante']."</span> ".getNombreId($final_ronda[0]['visitante'])." <span class='score'></span></li></a>
                            </ul>
                        </div>
                    </div>";
                }
                echo "<h1 class='text-center' style='padding-top: 125px'>GANADOR: ".getNombreId($datos_torneo['ganador'])."</h1>";
                echo "</div><p></p><br>";


                echo "<h2 class='text-center'>RESULTADOS</h2><table class='table table-bordered text-center'>";
                echo "<th class='text-center'>RONDA</th><th class='text-center'>LOCAL</th><th class='text-center'>VISITANTE</th>";
                for ($i = 0 ; $i<count($datos_partidas) ; $i++) {
                    echo "<tr>";

                    if($datos_partidas[$i]['ronda'] == 1){
                        echo "<td>CUARTOS</td>";
                    }else if($datos_partidas[$i]['ronda'] == 2){
                        echo "<td>SEMIFINAL</td>";
                    }else if($datos_partidas[$i]['ronda'] == 3){
                        echo "<td>FINAL</td>";
                    }

                    if($datos_partidas[$i]['resultado'] == $datos_partidas[$i]['local']){
                        echo "<td class='success'>".getNombreId($datos_partidas[$i]['local'])."</td>";
                    }else{
                        echo "<td class='danger'>".getNombreId($datos_partidas[$i]['local'])."</td>";
                    }

                    if($datos_partidas[$i]['resultado'] == $datos_partidas[$i]['visitante']){
                        echo "<td class='success'>".getNombreId($datos_partidas[$i]['visitante'])."</td>";
                    }else{
                        echo "<td class='danger'>".getNombreId($datos_partidas[$i]['visitante'])."</td>";
                    }

                    echo "</tr>";

                }


                echo"</table>";




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