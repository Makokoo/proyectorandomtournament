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



    <!-- =======================================================
    Theme Name: Knight
    Theme URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
    ======================================================= -->

</head>

<body>


<nav class="main-nav-outer" id="test">
    <!--main-nav-start-->
    <div class="container">
        <ul class="main-nav">
            <li><a href="home.php">INICIO</a></li>
            <li><a href="tournaments.php">TORNEOS</a></li>
            <li><a href="quienessomos.php">TIENDA</a></li>
            <li class="small-logo"><a href="home.php"><img src="img/small-logo.png" alt=""></a></li>
            <li><a href="tienda/shop.php">QUIENES SOMOS</a></li>

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






<!--business-talking-end-->
<div class="container">
    <section class="main-section">

        <div class="row">

            <?php
            //Si me pasan una id muestro el bracket y la información del torneo
            if(isset($_GET['id']) || isset($_POST['idtournament'])){
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                }else if(isset($_POST['idtournament'])){
                    $id = $_POST['idtournament'];
                }
                $datos_torneo = getDatosTorneo($id);
                $lista = $datos_torneo['participantes'];
                $participantes = explode(",", $lista);
                $datos_partidas = getPartidasTorneo($id);
                $contador = 0;



                if(isset($_POST['idtournament'])){
                    if(!yainscrito($datos_torneo['id_torneo'],$_SESSION['usuario'])) {
                        $conexion = conectar();
                        $conexion->begin_transaction();
                        if ($lista == "" || $lista == null) {
                            $nuevo = getid($_SESSION['usuario']);
                        } else {
                            $nuevo = $lista . "," . getid($_SESSION['usuario']);
                        }
                        $sql = "UPDATE torneos SET participantes = '$nuevo' WHERE id_torneo =" . $datos_torneo['id_torneo'];

                        $conexion->query($sql);
                        if (!$conexion->affected_rows > 0) {
                            $conexion->rollback();

                        } else {
                            $conexion->commit();

                        }
                    }
                }



                $primera_ronda = getPrimeraRonda($id);
                $segunda_ronda = getSegundaRonda($id);
                $final_ronda = getFinal($id);
                //echo "<h1 class='text-center'> DATOS TORNEO ".strtoupper($datos_torneo['nombre_torneo'])."</h1>";
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

                if(hayganador($datos_torneo['id_torneo'])) {
                    echo "<h2 class='text-center' style='padding-top: 125px'>GANADOR: " . getNombreId($datos_torneo['ganador']) . "</h2>";
                    echo "</div><p></p><br>";
                }else {

                    if (!torneolleno($datos_torneo['id_torneo']) && !hayganador($datos_torneo['id_torneo'])) {
                        if(isset($_SESSION['usuario'])) {
                            if (yainscrito($datos_torneo['id_torneo'], getid($_SESSION['usuario']))) {
                                echo "<h1 class='text-center' style='color:red;padding-top: 125px'>Ya estás inscrito en este torneo!</h1>";
                                echo "</div><p></p><br>";
                            } else {
                                if (isset($_SESSION['usuario'])) {

                                    //echo "<h1 class='text-center' style='padding-top: 125px'>INSCRíBETE</h1>";
                                    echo "<form class='text-center' method='post' action='tdetails.php'>";
                                    echo "<input type='hidden' name='idtournament' id='idtournament' value='$id'>";
                                    //echo "<input type='submit' name='inscripcion' id='inscripcion' value='Inscribete Aquí'></form>";
                                    echo"<button class='link animated fadeInUp delay-1s' style='margin-top: 10%;' type='submit'>INSCRIPCIÓN</button></form>";
                                    //echo "<button<a class=\"link animated fadeInUp delay-1s servicelink\" href=\"login.php\">EMPEZAR</a></form>";

                                } else {

                                    echo "<h4 class='text-center' style='padding-top: 125px'>INICIA SESIÓN PARA INSCRIBIRTE</h4>";

                                }
                                echo "</div><p></p><br>";
                            }

                        }else{
                            echo "<h4 class='text-center' style='padding-top: 125px'>INICIA SESIÓN PARA INSCRIBIRTE</h4>";
                            echo "</div><p></p><br>";
                        }

                    } else {
                        echo "<h1 class='text-center' style='padding-top: 125px'>INSCRIPCIONES</h1> <h1 class='text-center' style='color:red'>CERRADAS</h1>";
                        echo "</div><p></p><br>";
                    }
                }




                echo "</br></br></br><h3 class='text-center'>RESULTADOS</h3><table class='table table-bordered text-center'>";
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
