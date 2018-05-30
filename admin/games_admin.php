<?php
include_once 'cabecera.php';
?>


<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-8">
        <?php

        	$conexion = conectar();
        	$sql = "SELECT * FROM juegos";
        	$r = $conexion->query($sql);
        	$datos_torneo = [];
        	while($d = $r->fetch_assoc()){
        		$datos_torneo[] = $d;
        	}
        	//var_dump($datos_torneo);
        	/*
        		id_torneo,id_juego,estado,max_participantes,fec_inicio,fec_final,ganador,nombre_torneo,
        	*/
               if(count($datos_torneo) > 0){
                  echo "<table class='table table-bordered text-center'>";
                  echo "<th class='text-center'>ID</th><th class='text-center'>Nombre</th>";
                    for ($i=0; $i < count($datos_torneo); $i++) {
                        $id = $datos_torneo[$i]['id_juego'];
                        $nombre_juego = $datos_torneo[$i]['nombre'];

                        echo "<tr><td>$id</td><td>$nombre_juego</td><td><a href='newchar.php?idjuego=$id'><button class='btn btn-info'>Nuevo Personaje</button></a></td>";

                        echo "</tr>";

                    }
                    echo "<tr><a href='newgame.php'><button class='btn btn-info'>Nuevo Juego</button></a></tr>";
                
                echo "</table>";
            }


        ?>
    </div>

</div>





<?php
include_once 'pie.php';