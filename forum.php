<?php
include_once ('funciones.php');
include_once('header.php');

$categorias = getCategoriasForo();
echo "<div class=\"container\">";
echo "<h2 class='text-center' style='margin-top: 10px'>FORO OFICIAL</h2>";
if(count($categorias) > 0) {
if(isset($_SESSION['usuario'])){
echo "<hr><div class='row clearfix'>
    <div class='col-md-12 column'>                 
<a href='newthread.php'><button type='submit' class='input-btn' style='float:right; margin-bottom:15px'>Nuevo Tema</button></a>  </div>
</div>";
}

    for ($i = 0; $i < count($categorias); $i++) {
        $hilos = getHilosCategoria($categorias[$i]['id_categoria']);

        echo "<div class=\"row clearfix\">
	<section class=\"panel panel-success\">";
        echo "<header class=\"panel-heading\">
            <h3>" . $categorias[$i]['nombre_categoria'] . "</h3>
                </header>";

        for ($j = 0; $j < count($hilos); $j++) {
            $mensajes = getMensajesHilo($hilos[$j]['id_hilo']);
            $id = $hilos[$j]['id_hilo'];
            echo "<section class=\"row panel-body\">
            <section class=\"col-md-6\">
               <h4> <a href=\"viewthread.php?id=$id\" style=\"color:black\"><i class=\"fa fa-commenting\"> </i> " . $hilos[$j]['titulo'] . "</a></h4>
              
            </section>
            <section class=\"col-md-3\">
              
                <div> Mensajes: ".(count($mensajes)+1)."</div><div style='float:left;'>Autor: ".getNombreId($hilos[$j]['autor'])."</div>
              
            </section></section>";

        }
        echo "</section></div>";
    }
}

?>




<br><br><br>

</div>
<div class="c-logo-part">
        <!--c-logo-part-start-->
        <div class="container">
            <?php
        /*
                <ul>
                <li><a href="#"><img src="img/c-liogo1.png" alt=""></a></li>
                <li><a href="#"><img src="img/c-liogo2.png" alt=""></a></li>
                <li><a href="#"><img src="img/c-liogo3.png" alt=""></a></li>
                <li><a href="#"><img src="img/c-liogo4.png" alt=""></a></li>
                <li><a href="#"><img src="img/c-liogo5.png" alt=""></a></li>
            </ul>
        */
?>
        </div>
    </div>



<?php
include_once('footer.php');