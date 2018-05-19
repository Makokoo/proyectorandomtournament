<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */
include_once 'funciones.php';


include_once 'header.php';



$datos_usuario['username'] = "";

if(isset($_SESSION['usuario'])) {
    $datos_usuario = getDatosUsuario($_SESSION['usuario']);
}


?>





<section class="main-section team" id="team">
    <!--main-section team-start-->
    <div class="container">

            <?php
            echo "<h2 class='text-center'>CLASIFICACIÓN</h2>";
            getClasificacion($datos_usuario['username']);
            ?>




        </div>

    </section>




<?php
include_once 'footer.php';

?>
