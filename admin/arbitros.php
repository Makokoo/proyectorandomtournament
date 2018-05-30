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
        	$sql = "SELECT * FROM resultados ORDER BY id_partida";
        	$r = $conexion->query($sql);
        	$datos_resultados = [];
        	while($data = $r->fetch_assoc()){
        		$datos_resultados[] = $data;
        	}
        	
        	if(count($datos_resultados)>1){
        	for($i=0; $i<count($datos_resultados);$i++){
        		if($i+1 < count($datos_resultados)){
        		echo "<div class='col col-lg-4'>";
        		$contador = $i;
        		$partida = getDatosPartida($datos_resultados[$i]['id_partida']);
        		$id_partida = $datos_resultados[$i]['id_partida'];

        		$resultado = $datos_resultados[$i]['resultado'];
        		$resultado2 = $datos_resultados[$i+1]['resultado'];

				$res1 = 0;
        		if($datos_resultados[$i]['resultado'] == 1){ 
					$res1 = $partida['local'];
				}else if($datos_resultados[$i]['resultado'] == 2){ 
					$res1 = $partida['visitante'];
				}


        		echo "<table class='table table-bordered'>";
        		echo "<th>Partida ".$datos_resultados[$i]['id_partida']." - Torneo ".$partida['id_torneo'];
        		if($resultado != $resultado2 && $partida['resultado'] == 'espera'){
					echo "<th class='text-center'><a href='revisarincidencia.php?id=$id_partida'><button class='btn btn-warning'>Revisar</button></a></th>";
				}else if($partida['resultado'] == 'espera'){
					echo "<th class='text-center'><a href='resolverincidencia.php?id=$id_partida&ganador=$res1'><button class='btn btn-success'>Aceptar</button></a></th>";
				}else{
					echo "<th class='text-center'><button disabled class='btn btn-info'>Finalizada</button></th>";
				}
				
				$res2 = 0;
				


        		echo "</th><tr><td>".getNombreId($datos_resultados[$i]['id_usuario'])."</td><td>Ganador: ".getNombreId($res1)."</td></tr>";
        		

        		$i++;
        		$resultado2 = $datos_resultados[$i]['resultado'];
        		if($datos_resultados[$i]['resultado'] == 1){ 
        			$res2 = $partida['local'];
        		}else if($datos_resultados[$i]['resultado'] == 2){
        		 $res2 = $partida['visitante'];
        		}
				echo "<tr><td>".getNombreId($datos_resultados[$i]['id_usuario'])."</td><td>Ganador: ".getNombreId($res2)."</td></tr>";
				
        		echo "</table></div>";
        	}

        	}
        }
		?>
    	</div>
    </div>
        
<?php
include_once 'pie.php';