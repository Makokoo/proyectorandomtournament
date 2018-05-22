<?php
include_once 'header.php';
include_once 'funciones.php';

$nombrehilo = "";
$mensaje = "";
if(isset($_POST['name'])){
	$nombrehilo = $_POST['name'];
	$mensaje = $_POST['message'];
}

?>





<div class="container">
	<br>
<h3 class='text-center'>Nuevo tema</h3>
				<div class="col-lg-12 col-sm-5 wow fadeInUp delay-05s">
					<div class="form">
						<form action="newthread.php" method="post" role="form" class="contactForm">
							<div class="form-group">
								<select name="categoria" id='categoria' class='form-control select'>
									<option value="" disabled selected>Selecciona categoria</option>
								<?php
									$categorias = getCategoriasForo();
									for ($i=0; $i < count($categorias) ; $i++) { 
										$nombre = $categorias[$i]['nombre_categoria'];
										$idcat = $categorias[$i]['id_categoria'];
										echo "<option value='$idcat'>$nombre</option>";
									}
								?>

								</select>
								<br>
								<input type="text" name="name" class="form-control input-text" id="name" value='<?=$nombrehilo?>' required placeholder="Nombre del hilo" />
								<div class="validation"></div>
							</div>
							<div class="form-group">
							
								<textarea class="form-control input-text text-area" name="message" id="message" rows="5" data-rule="required" placeholder="Por favor escribenos aquí tu mensaje"><?=$mensaje?></textarea>
								<div class="validation"></div>
							</div>

							<div class="text-center"><button type="submit" id='crearhilo' class="input-btn">Crear Hilo</button></div>
						</form>
					</div>
				</div>

</div>
<br>
<br>
<br>




<?php
if(isset($_POST['name'])){


	
	if(!isset($_POST['categoria'])){
		
            echo "<h3 class='text-center' style='color:darkred'>Debes escoger una categoria para el nuevo hilo</h2><br>";
            
	}else{
		$id_categoria = $_POST['categoria'];
		$autor = getid($_SESSION['usuario']);
		$titulo = $_POST['name'];
		$mensaje_hilo = $_POST['message'];
		$conexion = conectar();
		$sql = "INSERT INTO hilo(id_categoria,autor,titulo,mensaje) VALUES ($id_categoria, $autor, '$titulo', '$mensaje_hilo')";
		$conexion -> query($sql);
		if( $conexion->affected_rows > 0){
			echo '<style>#crearhilo { display:none;}</style>';
			echo "<h3 class='text-center' style='color:darkgreen'>Hilo creado correctamente</h2><br><br>";
			$hilo = getidhilo($titulo,$autor);
			$hilo = $hilo['id_hilo'];
			header("Refresh:2; url='viewthread.php?id=$hilo'");
		}
	}
}

include_once 'footer.php';