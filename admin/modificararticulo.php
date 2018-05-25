<?php

include_once 'cabecera.php';

?>
   
<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-12">
        <?php

            $conexion = conectar();
            if(getPermiso($_SESSION['usuario']) == 2 || getPermiso($_SESSION['usuario']) == 3){
                if(isset($_POST['cod'])) {

                    $cod = $_POST['cod'];
                    $desc = $_POST['descripcion'];
                    $precio = $_POST['precio'];
                    $cat = $_POST['categoria'];
                    $nombre = $_POST['nombre'];


                    $sql = "SELECT * FROM articulos where cod_articulo =" . $_POST['cod'];

                    $ro = $conexion->query($sql);
                    $datos = $ro->fetch_assoc();
                    echo "<h1>Modificando el articulo con codigo '" . $datos['cod_articulo'] . "'</h1>";
                    ?>
                    <table class="table text-center">
                        <form action="guardarcambiosprod.php" method="post" enctype="multipart/form-data">
                            <td>Nombre:</td>
                            <td><input type="text" id="nombre" name="nombre" value="<?= $datos['nombre_articulo'] ?>">
                            </td>
                            <tr></tr>
                            <td>Descripcion:</td>
                            <td><input type="text" id="descripcion" name="descripcion"
                                       value="<?= $datos['descripcion_articulo'] ?>"></td>
                            <tr></tr>
                            <td>Precio:</td>
                            <td><input type="number" id="precio" name="precio" step=".01"
                                       value="<?= $datos['precio'] ?>"></td>
                            <tr></tr>

                            <?php
                            $sql = "SELECT categoria FROM categorias";
                            $r = $conexion->query($sql);
                            $te = array();
                            while($dat = $r->fetch_row()){
                                 $te[] = $dat[0];

                            }

                            ?>

                            <td>Categoria:</td>
                            <td><select id="categoria" name="categoria">
                                    <?php
                                    for($i=0;$i<count($te);$i++){
                                        echo "<option value='$te[$i]'>$te[$i]</option>";
                                    }



                                    ?>
                                </select>
                            </td>
                            <tr></tr>
                            <td>Añadir Imagen:</td>
                            <td><input type="file" name="imagen" id="imagen"></td>
                            <tr></tr>
                            <input type="hidden" name="cod" id="cod" value="<?= $datos['cod_articulo'] ?>">
                            <td><input type="submit" name="modificar" id="modificar" value="Actualizar"></td>
                        </form>

                    </table>


                    <?php
                }else{
                    ?>

            <table class="table text-center">
                <form action="nuevoproducto.php" method="post" enctype="multipart/form-data">
                    <td>Nombre:</td>
                    <td><input type="text" id="nombre" name="nombre" required>
                    </td>
                    <tr></tr>
                    <td>Descripcion:</td>
                    <td><input type="text" id="descripcion" name="descripcion"></td>
                    <tr></tr>
                    <td>Precio:</td>
                    <td><input type="number" id="precio" name="precio" step=".01" required></td>
                    <tr></tr>

                    <?php
                    $sql = "SELECT categoria FROM categorias";
                    $r = $conexion->query($sql);
                    $te = array();
                    while($dat = $r->fetch_row()){
                        $te[] = $dat[0];

                    }

                    ?>

                    <td>Categoria:</td>
                    <td><select id="categoria" name="categoria">
                            <?php
                            for($i=0;$i<count($te);$i++){
                                echo "<option value='$te[$i]'>$te[$i]</option>";
                            }



                            ?>
                        </select>
                    </td>
                    <tr></tr>
                    <td>Imagen via Archivo:</td>
                    <td><input type="file" name="imagen" id="imagen"></td>
                    <tr></tr>
                    <td>Imagen via URL: </td><td><input type="text" id="url" name="url" required></td>
                    <tr></tr>
                    <td><input type="submit" name="modificar" id="modificar" value="Actualizar"></td>
                </form>

            </table>
            <?php

                }
            }else{
                echo "Solo los administradores y empleados pueden acceder a esta página";
            }
            ?>
        </div>

</div>
        
<?php
include_once 'pie.php';