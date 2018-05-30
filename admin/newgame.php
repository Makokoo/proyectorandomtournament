<?php
include_once 'cabecera.php';
if(isset($_SESSION['usuario'])){
if(getPermiso($_SESSION['usuario']) > 0){
?>



<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-8">

<?php
    if(!isset($_POST['crear'])){
        ?>

        <table class="table text-center">
                <form action="newgame.php" method="post" enctype="multipart/form-data">
                    <td>Nombre:</td>
                    <td><input type="text" id="nombre" name="nombre" required>
                    </td>
                    <tr></tr>
                    <td><input type='submit' value='Crear' id='crear' name='crear'></td>
                </form>

            </table>

            <?php
        }else{

            $nombre = $_POST['nombre'];
            
            $sql = "INSERT INTO juegos (nombre) VALUES('$nombre')";
            $conexion = conectar();

            $conexion->query($sql);
            if($conexion->affected_rows > 0){
                echo "Juego creado correctamente";
            }else{
                echo "Error, no se ha podido crear el torneo";
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