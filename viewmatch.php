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

}





?>





<div class="container">
    <section class="main-section">
        <div class="row">

                
            <?php
            //Si me pasan una id muestro el bracket y la información del torneo
            if(isset($_GET['id']) || isset($_POST['idtournament'])) {
                $datos_partida = getPartida($_GET['id']);
                //var_dump($datos_partida['local']);
                //echo "<h1 class='text-center'>".strtoupper(getNombreId($datos_partida['local']))." VS ".strtoupper(getNombreId($datos_partida['visitante']))."</h1>";

                $plocal = getImagenPersonaje($datos_partida['p_local']);
                $plocal = "characters/".$plocal['imagen']."_local.png";
                $pvisitante = getImagenPersonaje($datos_partida['p_visitante']);
                $pvisitante = "characters/".$pvisitante['imagen']."_visitante.png";
                echo "<table class='table'>";
                //echo "<td>LOCAL</td><td>INFORMACION</td><td>VISITANTE</td>";
                echo "<tr><td class='text-center'><img src='$plocal'></td>";
                echo "<td><h2 class='text-center' style='margin-top:250px'>".strtoupper(getNombreId($datos_partida['local']))." VS ".strtoupper(getNombreId($datos_partida['visitante']))."</h2></td>";
                echo "<td class='text-center'><img src='$pvisitante'></td>";
                echo "</tr></table>";

            } else {
                //Si no me pasan una id por GET muestro un mensaje.
                echo "<span class='warning'>Debe seleccionar una partida para ver su información</span>";
            }

            ?>

        
        </div>
    </section>
</div>



<?php
include_once 'footer.php';

?>
