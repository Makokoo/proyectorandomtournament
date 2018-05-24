<?php
include_once 'cabecera.php';
echo"<script type='text/javascript'>
function ask(id){
 
    var r = confirm('¿Seguro que quieres inciar este torneo?');
    if(r){
        location.href ='start_tournament.php?id='+id;
    }
    
}


</script>";
?>


<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-8">
        <?php

        	$conexion = conectar();
        	$sql = "SELECT * FROM torneos";
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
        		echo "<th class='text-center'>ID</th><th class='text-center'>Juego</th><th class='text-center'>Nombre Torneo</th><th class='text-center'>Usuarios Inscritos</th><th class='text-center'>Estado</th><th class='text-center'>Iniciar</th>";
        		for ($i=0; $i < count($datos_torneo); $i++) {
        			$id = $datos_torneo[$i]['id_torneo'];
        			$nombre = $datos_torneo[$i]['nombre_torneo'];
        			$participantes = getparticipantes($id);
        			$estado = $datos_torneo[$i]['estado'];
        			$juego = $datos_torneo[$i]['id_juego'];
        			$datos_juego = getDatosJuego($juego);
        			$nombre_juego = $datos_juego['nombre'];
        			echo "<tr><td>$id</td><td>$nombre_juego</td><td>$nombre</td><td>$participantes</td><td>$estado</td>";
        			if($participantes == 8 && comprobarSiPartidasCreadas($id) == 0){
        				echo "<td><button class='btn btn-success' onclick='ask($id)'>Iniciar Torneo</button><form method='post' action='start_tournament.php'>

            </form>";
        			}else{
        				echo "<td></td>";
        			}

        			echo "</tr>";
        		}
        		echo "</table>";
        	}

        ?>
    </div>

</div>





<?php
include_once 'pie.php';