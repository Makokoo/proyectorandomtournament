<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */
include_once 'funciones.php';
include_once 'header.php';


$cuenta = 0;
$datos_usuario['username'] = "";

if(isset($_SESSION['usuario'])) {
    $datos_usuario = getDatosUsuario($_SESSION['usuario']);

}


?>


<div class="container">
    <div class="col col-lg-12">
    <section class="main-section">
        <div class="row">

                
            <?php
            if(!isset($_POST['resultado'])){
            //Si me pasan una id muestro el bracket y la información del torneo
            if(isset($_GET['id']) || isset($_POST['idtournament'])) {
                $datos_partida = getPartida($_GET['id']);
                
                $plocal = getImagenPersonaje($datos_partida['p_local']);
                $plocal = "characters/".$plocal['imagen']."_local.png";
                $pvisitante = getImagenPersonaje($datos_partida['p_visitante']);
                $pvisitante = "characters/".$pvisitante['imagen']."_visitante.png";
                echo "<table class='table'>";
                echo "<tr><td class='text-center'><img src='$plocal'></td>";
                echo "<td><h2 class='text-center' style='margin-top:250px'>".strtoupper(getNombreId($datos_partida['local']))." VS ".strtoupper(getNombreId($datos_partida['visitante']))."</h2></td>";
                echo "<td class='text-center'><img src='$pvisitante'></td>";
                echo "</tr></table>";
                if(isset($_SESSION['usuario'])){
                    if(getid($_SESSION['usuario']) == $datos_partida['local'] || getid($_SESSION['usuario']) == $datos_partida['visitante']){
                        if(yahayresultado(getid($_SESSION['usuario']),$_GET['id']) == false){
                            echo "<div class='row'><div class='col col-lg-12 text-center'>";

                                $local = getNombreId($datos_partida['local']);
                                $visitante = getNombreId($datos_partida['visitante']);
                                $id_local = $datos_partida['local'];
                                $id_visitante = $datos_partida['visitante'];
                                $idpartida = $_GET['id'];

                                echo "<h3>Introducir resultado</h3>";
                                echo "<form action='viewmatch.php' method='post' enctype='multipart/form-data'>";

                                echo "<label class='radio-inline'><input type='radio' name='optradio' value='1'>$local</label>
                                    <label class='radio-inline'><input type='radio' name='optradio' value='2'>$visitante</label>";

                                echo "<input type='hidden' id='id_partida' name='id_partida' value='$idpartida'>";

                                echo "<input type='file' id='captura' accept='image/jpeg' name='captura' style='margin-left:40%; margin-top: 5px; margin-bottom: 5px;'>";
                            
                                echo "<p><input type='submit' class='btn btn-success' value='Enviar Resultado' id='resultado' name='resultado'></p></form>";
                            echo "</div></div>";
                        }
                    }
                }

            } else {
                //Si no me pasan una id por GET muestro un mensaje.
                echo "<span class='warning'>Debe seleccionar una partida para ver su información</span>";
            }
        }else{


           
            $ganador = $_POST['optradio'];
            $id_partida = $_POST['id_partida'];
            $id_usuario = getid($_SESSION['usuario']);
            


            if(isset($_FILES['captura']) && $_FILES['captura']['size']>0){
                    $target_dir = "./capturas";
                    $target_file = $target_dir . basename($_FILES["captura"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    
                    $cod = getid($_SESSION['usuario']);
                    $nombre = $id_partida."_".$id_usuario;
                    $uploadOk = 1;
                    if($imageFileType != "jpg") {
                        echo "Solo se admiten imagenes en formato .jpg";
                        $uploadOk = 0;
                    }


                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["captura"]["tmp_name"], "$target_dir/$nombre.jpg")) {
                            $msgfinal = "Datos modificados correctamente";
                        } else {
                            echo "Ha habido un error al subir el nuevo avatar.";
                        }
                    }

                }



                $sql = "";
               if(isset($_FILES['captura']) && $_FILES['captura']['size']>0){
                    $sql = "INSERT INTO resultados (id_partida,id_usuario,resultado,captura) VALUES ($id_partida,$id_usuario,$ganador,'$nombre')";
                }else{
                    $sql = "INSERT INTO resultados (id_partida,id_usuario,resultado) VALUES ($id_partida,$id_usuario,$ganador)";
                }
                
            $conexion = conectar();
            $conexion->query($sql);
            if($conexion->affected_rows > 0){
                 echo "<div class='container' style='margin: 50px'>";
                echo "<h2 class='text-center'>Resultado enviado correctamente, los árbitros de RT confirmarán el resultado lo más pronto posible.</h2>";
                echo "</div>";
                header("Refresh:3; url='viewmatch.php?id=$id_partida'");
            }else{
                echo "<div class='container' style='margin: 250px'>";
                echo "<h2 class='text-center'>No se ha podido enviar el resultado.</h2>";
                echo "</div>";
                header("Refresh:3; url='viewmatch.php?id=$id_partida'");
            }

        }

            ?>

        
        </div>
    </section>
</div>
</div>



<?php
include_once 'footer.php';

?>
