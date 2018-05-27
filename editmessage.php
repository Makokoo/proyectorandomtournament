<?php
include_once ('funciones.php');
include_once ('header.php');

if(isset($_SESSION['usuario'])){

if(!isset($_POST['idhilo']) && !isset($_POST['id'])) {

    if (isset($_GET['idhilo'])) {
        $id = $_GET['idhilo'];
        $hilo = getHilo($id);
        $mensaje = $hilo['mensaje'];

        echo "<div class=\"container\">";



            echo "<div class=\"row clearfix\">
                    <div class=\"col-md-12 column\">
      
                        <div class=\"panel-heading\">
                            EDITAR MENSAJE
                        </div>
        
                 
                        <form action=\"editmessage.php\" method=\"post\" role=\"form\" class=\"contactForm\">
							<div class=\"form-group\">
								<textarea class=\"form-control input-text text-area\" name=\"postedit\" id=\"postedit\"  >$mensaje</textarea>
							
							</div>
                            <input type='hidden' name='idhilo' id='idhilo' value='$id' >
							<div class=\"text-center\"><button type=\"submit\" class=\"input-btn\">Modificar</button></div>
						</form>

        

                    </div>
    
                </div><hr>";


            echo "</div>";

    }else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $hilo = getHilo($id);
        $mensaje = getmensajeporid($id);

        echo "<div class=\"container\">";



        echo "<div class=\"row clearfix\">
                    <div class=\"col-md-12 column\">
      
                        <div class=\"panel-heading\">
                            EDITAR MENSAJE
                        </div>
        
                 
                        <form action=\"editmessage.php\" method=\"post\" role=\"form\" class=\"contactForm\">
							<div class=\"form-group\">
								<textarea class=\"form-control input-text text-area\" name=\"message\" id=\"message\">".$mensaje['mensaje']."</textarea>
							
							</div>
                            <input type='hidden' name='id' id='id' value='$id' >
							<div class=\"text-center\"><button type=\"submit\" class=\"input-btn\">Modificar</button></div>
						</form>

        

                    </div>
    
                </div><hr>";


        echo "</div>";
    }
}else if(isset($_POST['idhilo'])){
    $nuevomensaje = $_POST['postedit'];
    $idhilo = $_POST['idhilo'];
    $sql = "UPDATE hilo SET mensaje='$nuevomensaje' WHERE id_hilo=$idhilo";
    $conexion = conectar();
    $conexion -> query($sql);
    if($conexion->affected_rows > 0){
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Mensaje modificado correctamente</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$idhilo'");
    }else{
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Error, no se ha podido modificar el mensaje</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$idhilo'");
    }
}else if(isset($_POST['id'])){
    $nuevomensaje = $_POST['message'];
    $id = $_POST['id'];
    $sql = "UPDATE mensajes SET mensaje='$nuevomensaje' WHERE id_mensaje=$id";
    $conexion = conectar();
    $conexion -> query($sql);
    $sql2 = "SELECT * from mensajes WHERE id_mensaje = $id";
    $r = $conexion -> query($sql2);
    $d = $r->fetch_assoc();
    $hilo = $d['id_hilo'];
    if($conexion->affected_rows > 0){
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Mensaje modificado correctamente</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$hilo");
    }else{
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Error, no se ha podido modificar el mensaje</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$hilo");
    }
}

}else{
    echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Debes iniciar sesión para acceder aquí</h2>";
        echo "</div>";
}


include_once ('footer.php');