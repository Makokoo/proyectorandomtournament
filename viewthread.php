<?php
include_once ('funciones.php');
include_once ('header.php');

echo"<script type=\"text/javascript\">
function ask(id){
 
    var r = confirm('¿Seguro que quieres borrar el mensaje?');
    if(r){
        location.href ='deletemessage.php?id='+id;
    }
    
}
function deletepost(id){
    var r = confirm('¿Seguro que quieres borrar el hilo?');
    if(r){
        location.href ='deletemessage.php?idpost='+id;
    }
}

</script>";

if(isset($_POST['message'])){
    $mensaje = $_POST['message'];
    $autor = getid($_SESSION['usuario']);
    $hilo = $_POST['idhilo'];
    if($mensaje != "") {
        $conexion = conectar();
        $mensaje = mysqli_real_escape_string($conexion, $mensaje);
         $sql = "INSERT INTO mensajes (id_hilo,autor,mensaje) VALUES ($hilo,$autor,'$mensaje')";
        $conexion->query($sql);
        if ($conexion->affected_rows > 0) {
            echo "<div class=\"container\" style='margin: 250px'>";
            echo "<h2 class='text-center'>Mensaje enviado correctamente</h2>";
            echo "</div>";
            header("Refresh:3; url='viewthread.php?id=$hilo'");
        }else{
            echo "<div class=\"container\" style='margin: 250px'>";
            echo "<h2 class='text-center'>Mensaje no válido</h2>";
            echo "</div>";
            header("Refresh:3; url='viewthread.php?id=$hilo'");
        }
    }else{
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center' style='color:darkred'>El mensaje no puede estar vacio</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$hilo'");
    }

}else {


    if (isset($_GET['id']) || isset($_POST['idhilo'])) {
        echo "<div class=\"container\">";
        $mensajes = getMensajesHilo($_GET['id']);
        if (!isset($_POST['idhilo'])) {
            $idhilo = $_GET['id'];
        } else {
            $idhilo = $_POST['idhilo'];
        }
        $primer = getHilo($idhilo);
        $nombre_usuario = getNombreId($primer['autor']);
        $datos_usuario = getDatosUsuario($nombre_usuario);
        $avatar = "img/default-avatar.png";
        if (!$datos_usuario['avatar'] == null || !$datos_usuario['avatar'] == "") {
            $avatar = "avatar/" . $datos_usuario['id_usuario'] . ".png";
        }

        echo "<h3 class='text-center' style='margin: 15px'> Estas viendo el hilo: <b>" . $primer['titulo'] . "</b></h3>";
        echo "<div class=\"row clearfix\">
    <div class=\"col-md-12 column\">
      <div class=\"panel panel-default\">
        <div class=\"panel-heading\">
          MENSAJE #1";
          if(isset($_SESSION['usuario'])){
            if($primer['autor'] == getid($_SESSION['usuario']) || getPermiso($_SESSION['usuario']) > 0){
                echo "<a class='editar' href='editmessage.php?idhilo=$idhilo'  style='color:black; float: right;'><span class='fa fa-pencil'></span></a>";
                echo "&nbsp;";
                echo "<a class='eliminar' id='eliminar' onclick='deletepost($idhilo)'  style='margin-left:5px;color:black; float: right;'><span class='fa fa-trash'></span></a>";
            }
          }
        echo "</div>
        <section class=\"row panel-body\">
                  <section class=\"col-md-3\">
                      <section class=\"well\">
                            <h3 class='text-center'><b>" . $nombre_usuario . "</b></h3>
                            <img style='border-radius: 50%;' src=\"$avatar\">

                      </section>
                  </section>
                  <section class=\"col-md-9\">
                      <section class=\"well\">
                            <h3 class='text-left'>" . $primer['mensaje'] . "</h3>

                      </section>
                  </section>

        </section>

      </div>
    </div>
  </div>";




        $contador = 2;
        for ($i = 0; $i < count($mensajes); $i++) {

            $nombre_usuario = getNombreId($mensajes[$i]['autor']);
            $datos_usuario = getDatosUsuario($nombre_usuario);
            $avatar = "img/default-avatar.png";
            $idmensaje = $mensajes[$i]['id_mensaje'];
            if (!$datos_usuario['avatar'] == null || !$datos_usuario['avatar'] == "") {
                $avatar = "avatar/" . $datos_usuario['id_usuario'] . ".png";
            }
            echo "<div class=\"row clearfix\">
    <div class=\"col-md-12 column\">
      <div class=\"panel panel-default\">
        <div class=\"panel-heading\">
          MENSAJE #$contador";
          if(isset($_SESSION['usuario'])){
            if($mensajes[$i]['autor'] == getid($_SESSION['usuario']) || getPermiso($_SESSION['usuario']) > 0){
                echo "<a class='editar' href='editmessage.php?id=$idmensaje'  style='color:black; float: right;'><span class='fa fa-pencil'></span></a>";
                echo "&nbsp;";
                echo "<a class='eliminar' id='eliminar' onclick='ask($idmensaje)'  style='margin-left:5px;color:black; float: right;'><span class='fa fa-trash'></span></a>";
            }
          }

        echo"</div>
        <section class=\"row panel-body\">
                  <section class=\"col-md-3\">
                      <section class=\"well\">
                            <h3 class='text-center'><b>" . $nombre_usuario . "</b></h3>
                            <img style='border-radius: 50%;' src=\"$avatar\">

                      </section>
                  </section>
                  <section class=\"col-md-9\">
                      <section class=\"well\">
                            <h3 class='text-left'>" . $mensajes[$i]['mensaje'] . "</h3>

                      </section>
                  </section>

        </section>

      </div>
    </div>
  </div>";
            $contador++;
        }

if(isset($_SESSION['usuario'])) {
    echo "<hr><div class=\"row clearfix\">
    <div class=\"col-md-12 column\">
      
        <div class=\"panel-heading\">
          NUEVA RESPUESTA
        </div>
        
                 
<form action=\"viewthread.php\" method=\"post\" role=\"form\" class=\"contactForm\">
							<div class=\"form-group\">
								<textarea class=\"form-control input-text text-area\" name=\"message\" id=\"message\" ></textarea>
							
							</div>
                            <input type='hidden' name='idhilo' id='idhilo' value='$idhilo' >
							<div class=\"text-center\"><button type=\"submit\" class=\"input-btn\">Enviar Respuesta</button></div>
						</form>

        

      </div>
    
  </div><hr>";


    echo "</div>";

}else{
    echo "<hr><div class=\"row clearfix\">
    <div class=\"col-md-12 column\">
      
        <div class=\"panel-heading\">
          DEBES INICIAR SESIÓN PARA PARTICIPAR EN LOS FOROS
        </div>

      </div>
    
  </div><hr>";


    echo "</div>";
}

    } else {
        echo "Debes seleccionar hilo para poder ver su contenido";
    }
}




include_once ('footer.php');