<?php
include_once 'cabecera.php';
if(isset($_SESSION['usuario'])) {
    if (getPermiso($_SESSION['usuario']) > 0) {
?>



<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-8">
      <?php
if(!isset($_POST['crear'])){
 ?>
        <table class='table table-bordered'>
        <?php
        if(isset($_GET['idjuego'])) {
            $juego = $_GET['idjuego'];
            echo "<form action='newchar.php' method='post' enctype='multipart/form-data'>";
            echo "<tr><td>Nombre</td><td><input type='text' id='name' name='name' required></td></tr>";
            echo "<input type='hidden' id='juego' name='juego' value='$juego'>";
            echo "<tr><td>Imagen Local</td><td><input type='file' id='local' required  accept='image/png' name='local'></td></tr>";
            echo "<tr><td>Imagen Visitante:</td><td><input type='file' id='visitante' required accept='image/png' name='visitante'></td></tr>";
            echo "<tr><td><input type='submit' class='btn btn-success' value='Crear' id='crear' name='crear'></form></td></tr>";
        }
        ?>
        </table> 
<?php
}else{
            $nombre = $_POST['name'];
            $juego = $_POST['juego'];
            $min1 = strtolower(trim($nombre));
            $min2 = strtolower(trim($nombre));
            $primera = false;
            $segunda = false;
            $sql = "INSERT INTO personajes (id_juego,nombre,imagen) VALUES ($juego,'$nombre','$min1')";
            $conexion = conectar();
            $conexion->begin_transaction();
            $conexion->query($sql);
            if($conexion->affected_rows > 0){

                if(isset($_FILES['local']) && $_FILES['local']['size']>0){
                    $target_dir = "../characters";

                    $target_file = $target_dir . basename($_FILES["local"]["name"]);
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
                        $min1 .= "_local";
                        if (move_uploaded_file($_FILES["local"]["tmp_name"], "$target_dir/$min1.png")) {
                            //echo "Imagen local subida correctamente";
                            $primera = true;
                        } else {
                            $conexion->rollback();
                            echo "Ha habido un error al subir el nuevo avatar.";
                        }
                    }

                }


                if(isset($_FILES['visitante']) && $_FILES['visitante']['size']>0){
                    $target_dir = "../characters";

                    $target_file = $target_dir . basename($_FILES["visitante"]["name"]);
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
                        $min2 .= "_visitante";
                        if (move_uploaded_file($_FILES["visitante"]["tmp_name"], "$target_dir/$min2.png")) {
                            //echo "Imagen visitante subida correctamente";
                            $segunda = true;
                            $conexion->commit();
                        } else {
                            $conexion->rollback();
                            echo "Ha habido un error al subir la imagen de visitante.";
                        }
                    }

                }

                if($primera == true && $segunda == true){
                    echo "Personaje creado correctamente";
                }


            }else{
                echo "Error al crear el personaje";
                $conexion->rollback();
            }
}
 ?>
    </div>
</div>


<?php
include_once 'pie.php';
    }

}


?>