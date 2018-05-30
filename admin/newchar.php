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
        <table class='table table-bordered'>
        <?php
        if(isset($_GET['idjuego'])){
        $juego = $_GET['idjuego'];
        echo "<form action='viewmatch.php' method='post' enctype='multipart/form-data'>";
        echo "<tr><td>Nombre</td><td><input type='text' id='name' name='name'></td></tr>";
        echo "<tr><td>Nombre</td><td><input type='text' id='name' name='name'></td></tr>";
        echo "<tr><td>Imagen Local</td><td><input type='file' id='local' accept='image/png' name='local'></td></tr>";
        echo "<tr><td>Imagen Visitante:</td><td><input type='file' id='visitante' accept='image/png' name='visitante'></td></tr>";                 
        echo "<tr><td><input type='submit' class='btn btn-success' value='Enviar Resultado' id='resultado' name='resultado'></form></td></tr>";
        
        ?>
        </table> 
        }
    </div>
</div>


<?php
include_once 'pie.php';
    }
}

?>