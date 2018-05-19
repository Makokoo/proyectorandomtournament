<?php
include_once ('funciones.php');
include_once ('header.php');


if(isset($_POST['message'])){
    $mensaje = $_POST['message'];
    $autor = getid($_SESSION['usuario']);
    $hilo = $_POST['idhilo'];
    if($mensaje != "") {
        $sql = "INSERT INTO mensajes (id_hilo,autor,mensaje) VALUES ($hilo,$autor,'$mensaje')";
        $conexion = conectar();
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
        $primer = getHilo($_GET['id']);
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
          MENSAJE #1
        </div>
        <section class=\"row panel-body\">
                  <section class=\"col-md-3\">
                      <section class=\"well\">
                            <h3 class='text-center'>" . $nombre_usuario . "</h3>
                            <img src=\"$avatar\">

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
            if (!$datos_usuario['avatar'] == null || !$datos_usuario['avatar'] == "") {
                $avatar = "avatar/" . $datos_usuario['id_usuario'] . ".png";
            }
            echo "<div class=\"row clearfix\">
    <div class=\"col-md-12 column\">
      <div class=\"panel panel-default\">
        <div class=\"panel-heading\">
          MENSAJE #$contador
        </div>
        <section class=\"row panel-body\">
                  <section class=\"col-md-3\">
                      <section class=\"well\">
                            <h3 class='text-center'>" . $nombre_usuario . "</h3>
                            <img src=\"$avatar\">

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
								<textarea class=\"form-control input-text text-area\" name=\"message\" id=\"message\" rows=\"5\" data-rule=\"required\" placeholder=\"Por favor escribenos aquí tu mensaje\">
								</textarea>
								<div class=\"validation\"></div>
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