<?php

include_once 'cabecera.php';
?>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">
      <div class="col col-lg-12">


<?php
if(!isset($_POST['resultado'])){
if(isset($_GET['id'])){

	$id = $_GET['id'];
	$datos_partida = getDatosPartida($id);
	$resultados = getResultados($id);
	
	$imagen1 = $resultados[0]['captura'];
	$imagen2 = $resultados[1]['captura'];
	if($imagen1 != 0){
	echo "<div class='col col-lg-6' class='text-center'>";
	echo "<p style='text-align: center;vertical-align: middle;line-height: 90px; '>Captura aportada por ".getNombreId($resultados[0]['id_usuario'])."</p>";
	echo "<img src='../capturas/$imagen1.jpg' style='max-height:250px; max-width:350px;display:block;
    margin:auto;'>";

	echo "</div>";
	}

	if($imagen2 != 0){
	echo "<div class='col col-lg-6'>";
	echo "<p style='text-align: center;vertical-align: middle;line-height: 90px; '>Captura aportada por ".getNombreId($resultados[1]['id_usuario'])."</p>";
	echo "<img src='../capturas/$imagen2.jpg' style='max-height:250px; max-width:450px;display:block;
    margin:auto;'>";
	echo "</div>";
}
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
 						echo "<div class='col col-lg-12 text-center'><h3>Introducir resultado</h3>";
                                echo "<form action='revisarincidencia.php' method='post' enctype='multipart/form-data'>";

                                echo "<label class='radio-inline'><input type='radio' name='optradio' value='1'>".getNombreId($datos_partida['local'])."</label>
                                    <label class='radio-inline'><input type='radio' name='optradio' value='2'>".getNombreId($datos_partida['visitante'])."</label>";
                                echo "<input type='hidden' id='id_partida' name='id_partida' value='$id'>";                        
                                echo "<p><input type='submit' class='btn btn-success' value='Enviar Resultado' id='resultado' name='resultado'></p></form></div>";
}
}else{
	$ganador = $_POST['optradio'];
	$partida = $_POST['id_partida'];
	$sql = "UPDATE partidas SET resultado = $ganador, estado = 'finalizado' WHERE id_partida = $partida";
	$conexion = conectar();
	$conexion->begin_transaction();
	$conexion->query($sql);
	if($conexion->affected_rows > 0){
		$datos = getDatosPartida($partida);
		if($ganador == 1){ $id_usuario = $datos['local'];}else if($ganador == 2){ $id_usuario = $datos['visitante'];}

			$sql2 = "UPDATE usuarios SET puntuacion = puntuacion+3 WHERE id_usuario = $id_usuario";
			$conexion->query($sql2);
			if($conexion->affected_rows > 0){
				if($datos['ronda'] == 3){
					$id_torneo = $datos['id_torneo'];
					$sql3 = "UPDATE torneos SET ganador = $id_usuario WHERE id_torneo = $id_torneo";
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