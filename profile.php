<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */
include_once 'funciones.php';
include_once 'header.php';

$cuenta = 0;
$datos_usuario['username'] = "";

if(isset($_SESSION['usuario'])) {
    $datos_usuario = getDatosUsuario($_SESSION['usuario']);



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
                    <tr><td>Torneos Ganados:</td><td><?=getTorneosganados($datos_usuario['id_usuario'])['COUNT(*)']?></td></tr>
                    <tr><td>Puntuación Total:</td><td><?=$datos_usuario['puntuacion']?></td></tr>
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







<?php
}else{
    echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Debes iniciar sesión para acceder aquí</h2>";
        echo "</div>";
}
include_once 'footer.php';

?>







