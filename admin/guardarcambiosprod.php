<?php
include_once 'cabecera.php';
?>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-12">
         
        <?php

        $cod = $_POST['cod'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];


        $sql = "UPDATE articulos SET nombre_articulo='$nombre',descripcion_articulo='$descripcion',categoria = '$categoria', precio=$precio WHERE cod_articulo = $cod";
        $conexion = conectar();
        $conexion->query($sql);
            //echo $sql;
        $good = false;
        if($conexion->affected_rows > 0){
            $good = true;
        }

        
        if(getPermiso($_SESSION['usuario']) == 2 || getPermiso($_SESSION['usuario']) == 3 && $good == true){
            if(isset($_FILES['imagen']) && $_FILES['imagen']['size']>0){
                $ruta = "./imagenes";

                $nombretemporal=$_FILES['imagen']['tmp_name'];
                $tipodearchivo = GetImageSize($nombretemporal);
                if($tipodearchivo[2] == 2) {
                    move_uploaded_file($nombretemporal, "$ruta/$cod.jpg");
                }else{
                    move_uploaded_file($nombretemporal,"$ruta/$cod.png");
                }
                
            }
            echo "Cambios realizados correctamente.";
            
        }

        if($good == true){
            echo "redireccionando";
            header('refresh:2; url=gestion_articulos.php');
        }

        


        ?>


    </div>
</div>
</section>
</section>

<?php
include_once 'pie.php';
?>