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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
    $('#table_id').DataTable();
} );</script>



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
