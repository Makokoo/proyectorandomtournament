<?php
include_once 'cabecera.php';
?>


<!--main content start-->
<section id="main-content">
	<section class="wrapper">


		<div class="row">
			<div class="col col-lg-8">
				<?php
				if(isset($_SESSION['usuario'])){
					if(getPermiso($_SESSION['usuario']) == 2){
						if(isset($_POST['id']) || isset($_GET['id'])){
							$id_torneo = $_GET['id'];
							$datos_torneo = getDatosTorneo($id_torneo);
							$id_personajes = getPersonajesJuego($datos_torneo['id_juego']);
							$id_participantes = getDatosParticipantes($id_torneo);

							if(count($id_personajes) > 0){
								$mitad = count($id_participantes)/2;
								$conexion = conectar();
								$conexion->begin_transaction();
								
								for ($i=0; $i < $mitad ; $i++) {
									$datos_torneo = getDatosTorneo($id_torneo);
									$random_participante = 0;
									$random_participante2 = 0; 
									while($random_participante == $random_participante2){
										$random_participante = rand(1,count($id_participantes));
										$random_participante2 = rand(1,count($id_participantes));

									}
									$random_personaje = rand(1,count($id_personajes));
									$random_personaje2 = rand(1,count($id_personajes));
									if($id_participantes[$random_participante-1] != null && $id_participantes[$random_participante2-1] != null){
										//echo "<p>".var_dump($id_participantes)."</p>";
										$local = $id_participantes[$random_participante-1];
										$visitante = $id_participantes[$random_participante2-1];
										
										//elimino la posición del array que contiene dicho numero para que no se pueda repetir.
										unset($id_participantes[$random_participante-1]);
										unset($id_participantes[$random_participante2-1]);
										$id_participantes = array_values($id_participantes);

										$sql1 = "INSERT INTO partidas (id_torneo,local,visitante,estado,ronda,p_local,p_visitante) VALUES ($id_torneo,$local,$visitante,'espera',1,$random_personaje,$random_personaje2)";
										
										$conexion->query($sql1);
										if($conexion->affected_rows > 0){
											if($datos_torneo['estado'] != 'iniciado'){
												$sql2 = "UPDATE torneos SET estado = 'iniciado' WHERE id_torneo = $id_torneo";
												$conexion->query($sql2);
												if($conexion->affected_rows > 0){
													echo "<script>alert('Torneo creado correctamente'); window.location.href = 'tournaments_admin.php';</script>";
													$conexion->commit();
												}else{
													$conexion->rollback();
												}
											}
										}else{
											 
											$conexion->rollback();
										}

									}

								}

								

								
							}else{
								echo "<h3 class='danger'>Error, no hay personajes creados para este juego</h3>";
							}
						}
					}
				}

				?>
			</div>

		</div>



		<?php
		include_once 'pie.php';