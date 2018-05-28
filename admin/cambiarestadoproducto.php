<?php
include_once 'cabecera.php';
include_once '../shop/funciones.php';
?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-12">
        <?php

         echo verlistaproductos();
        ?>
    </div>

</div>
<?php

            if(isset($_POST['cod'])){
                $codigo = $_POST['cod'];
                $conexion = conectar();
                cambiarestadoproducto($codigo,$conexion);
                header('location:gestion_articulos.php');
            }else {
                echo "No hay codigo";
            }

include_once 'pie.php';
?>