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
                <form action="createtournament.php" method="post" enctype="multipart/form-data">
                    <td>Nombre:</td>
                    <td><input type="text" id="nombre" name="nombre" required>
                    </td>
                    <tr></tr>
                    
                    <?php
                    $conexion = conectar();
                    $sql = "SELECT id_juego,nombre FROM juegos";
                    $r = $conexion->query($sql);
                    $te = array();
                    $ids = array();
                    while($dat = $r->fetch_row()){
                        $te[] = $dat[0]."-".$dat[1];
                        $ids[] = $dat[0];
                    }

                    ?>

                    <td>Juego:</td>
                    <td><select id="juego" name="juego">
                            <?php
                            for($i=0;$i<count($te);$i++){
                                echo "<option value='$ids[$i]'>$te[$i]</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <tr></tr>
                    <td><input type='submit' value='Crear' id='crear' name='crear'></td>
                </form>

            </table>

            <?php
        }else{

            $nombre = $_POST['nombre'];
            $juego = $_POST['juego'];

            $sql = "INSERT INTO torneos (id_juego,estado,max_participantes,nombre_torneo) VALUES($juego,'abierto',8,'$nombre')";
            $conexion = conectar();

            $conexion->query($sql);
            if($conexion->affected_rows > 0){
                echo "Torneo creado correctamente";
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