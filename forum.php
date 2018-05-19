<?php
include_once ('funciones.php');
include_once('header.php');

$categorias = getCategoriasForo();
echo "<div class=\"container\">";
echo "<h2 class='text-center' style='margin-top: 10px'>FORO OFICIAL</h2>";
if(count($categorias) > 0) {



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





</div>



<?php
include_once('footer.php');