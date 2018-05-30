<?php

include_once 'cabecera.php';
?>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-12">


<?php

if(isset($_GET['ganador']) && isset($_GET['id'])){

	$id = $_GET['id'];
	$ganador = $_GET['ganador'];

	$datos_partida = getDatosPartida($id);
	
	if($datos_partida['local'] == $ganador){
		$winner = 1;
	}else if($datos_partida['visitante'] == $ganador){
		$winner = 2;
	}

	if($winner == 1){ $id_usuario = $datos_partida['local'];}else if($winner == 2){ $id_usuario = $datos_partida['visitante'];}

	$sql = "UPDATE partidas SET resultado = $winner, estado = 'finalizado' WHERE id_partida = $id";
	$conexion = conectar();
	$conexion->begin_transaction();
	$conexion->query($sql);
	if($conexion->affected_rows > 0){
		$sql2 = "UPDATE usuarios SET puntuacion = puntuacion+3 WHERE id_usuario = $id_usuario";
		$conexion->query($sql2);
		if($conexion->affected_rows > 0){
			if($datos_partida['ronda'] == 3){
					$id_torneo = $datos_partida['id_torneo'];
					$sql3 = "UPDATE torneos SET ganador = $id_usuario, estado = 'finalizado' WHERE id_torneo = $id_torneo";
					$conexion->query($sql3);
					if($conexion->affected_rows > 0){
						echo "Resultado registrado correctamente";
						$conexion->commit();
					}else{
						echo "Error al registrar el resultado";
						$conexion->rollback();
					}
				}else{
					echo "Resultado registrado correctamente";
					$conexion->commit();
				}
		}else{
			echo "Error al registrar el resultado";
			$conexion->rollback();
		}
		
	}else{
		echo "Error al registrar el resultado";
		$conexion->rollback();
	}

}

?>
</div>
    </div>
        
<?php
include_once 'pie.php';