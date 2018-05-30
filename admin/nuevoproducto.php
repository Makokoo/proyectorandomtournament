<?php
include_once 'cabecera.php';
if(isset($_SESSION['usuario'])){
if(getPermiso($_SESSION['usuario']) > 0){
?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-12">
        
            <?php

            $conexion = conectar();


            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $sql = "";
            $conexion->begin_transaction();
            if(isset($_POST['url'])) {
                $url = $_POST['url'];
                $sql = "INSERT INTO articulos (nombre_articulo,descripcion_articulo,precio,categoria,imagen) VALUES('$nombre','$descripcion',$precio,'$categoria','$url')";
            }else {
                $sql = "INSERT INTO articulos (nombre_articulo,descripcion_articulo,precio,categoria) VALUES('$nombre','$descripcion',$precio,'$categoria')";
            }

            $conexion->query($sql);
            $last_id = mysqli_insert_id($conexion);
                
            if($conexion->affected_rows > 0){
                $conexion->commit();
                
                echo "<h3>Articulo añadido correctamente.</h3>";
            }else{
                $conexion->rollback();
            }




            if(isset($_FILES['imagen']) && $_FILES['imagen']['size']>0){
                    $target_dir = "../imagenes";
                    
                    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    $uploadOk = 1;
                    if($imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "jpg") {
                        
                        $uploadOk = 1;
                    }else{
                        echo "Solo se admiten imagenes en formato .png/.jpeg/.jpg";
                        $uploadOk = 0;
                    }


                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $conexion->rollback();
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "$target_dir/$last_id.png")) {
                            echo "Imagen subida correctamente";
                        } else {
                            $conexion->rollback();
                            echo "Ha habido un error al subir el nuevo avatar.";
                        }
                    }

                }

                header('refresh:2;url=gestion_articulos.php');



 ?>
    </div>

</div>


            

<?php
        

        include_once 'pie.php';
      }else{
        echo "Permiso de administrador necesario.";
      }
  }else{
    echo " Debes iniciar sesión <a href='../login.php'>aquí</a>";
  }