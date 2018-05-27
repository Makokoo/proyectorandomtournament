<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 16/04/2018
 * Time: 21:20
 */

function logincorrecto($nick,$pass){

    //Funcion que comprueba si existe el usuario con la contraseña correspondiente

    $conexion = conectar();
    $pass = md5($pass);

    $sql = "SELECT username,password,estado FROM usuarios WHERE username LIKE '$nick' AND password LIKE '$pass'";
    $resultado= $conexion->query($sql);
    $datos = array();

    while ($data=$resultado->fetch_row()) {
        $datos = $data;
    }

    if(count($datos)==3) {
        if ($datos[0] == $nick && $datos[1] == $pass) {
            return true;
        } else {
            return false;
        }
    }else{
        return false;
    }

}

define ('SERVIDOR', "localhost");
define ('USUARIO', "root");
define ('CONTRA', "");
define ('BBDD', "random_tournament");

function conectar(){
    @$conexion = new mysqli(SERVIDOR,USUARIO,CONTRA,BBDD);
    if($conexion -> connect_errno!=0){
        die('Atencion! Problemas de base de datos, contacte con el administrador');
    }

    return $conexion;
}

function registrarusuario($uname, $psw , $mail){
    $conexion = conectar();
    $uname2 = mysqli_real_escape_string($conexion,$uname);
    $psw2 = mysqli_real_escape_string($conexion,$psw);
    $mail2 = mysqli_real_escape_string($conexion,$mail);
    $psw2 = md5($psw2);
    $sql = "INSERT INTO usuarios(username, mail, password) VALUES ('$uname2', '$mail2', '$psw2')";
    $conexion->query($sql);
    if($conexion->affected_rows>0){
        return true;
    }else{
        return false;
    }
}

function modificarusuario($id,$newuname, $newmail, $password){
    $conexion = conectar();
    $password = md5($password);
    $sql = "UPDATE usuarios SET username = '$newuname', mail='$newmail', password='$password' WHERE id_usuario=$id";
    $conexion->query($sql);
    if($conexion->affected_rows>0){
        return true;
    }else{
        return false;
    }
}

function modificarsinpass($id, $newuname, $newmail){
    $conexion = conectar();
    $sql = "UPDATE usuarios SET username = '$newuname', mail='$newmail' WHERE id_usuario=$id";
    $conexion->query($sql);
    if($conexion->affected_rows>0){
        return true;
    }else{
        return false;
    }
}

function getid($uname){
    $conexion = conectar();
    $sql = "SELECT id_usuario from usuarios WHERE username LIKE '$uname'";
    $res = $conexion->query($sql);
    $dato = $res->fetch_assoc();

    return $dato['id_usuario'];
}


function existenick($uname){
    $sql = "SELECT * from usuarios WHERE username LIKE '$uname'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $dato = $res->num_rows;

    if($dato==1){
        return true;
    }else{
        return false;
    }

}

function existemail($mail){
    $sql = "SELECT * from usuarios WHERE mail LIKE '$mail'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $dato = $res->num_rows;

    if($dato==1){
        return true;
    }else{
        return false;
    }
}

function getDatosUsuario($uname){
    $sql = "SELECT * from usuarios WHERE username LIKE '$uname'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = $res->fetch_assoc();


    return $datos;
}

function getNombreId($id){
    $sql = "SELECT username from usuarios WHERE id_usuario = $id";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = $res->fetch_assoc();


    return $datos['username'];
}

function getClasificacion($uname){
    $contador = 0;
    $sql = "SELECT id_usuario,username, puntuacion from usuarios ORDER BY puntuacion DESC";
    $conexion = conectar();
    $res = $conexion->query($sql);



echo "<table id='table_id' class='display'>";
echo "<thead>";
echo "<tr><th>Puesto</th><th>Usuario</th><th>Partidas Jugadas</th><th>Victorias</th><th>Empates</th><th>Derrotas</th><th>Puntos</th></tr>";
echo "</thead>";
echo "<tbody>";



    //echo "<table class='table table-bordered text-center'>";
    //echo "<tr><td><b>Puesto</b></td><td><b>Usuario</b></td><td><b>Partidas Jugadas</b></td><td><b>Victorias</b></td><td><b>Empates</b></td><td><b>Derrotas</b></td><td><b>Puntos</b></td></tr>";
    while($datos = $res->fetch_assoc()){
        $contador++;
        $da = getDatosUsuario($datos['username']);
        if($uname == $datos['username']){

            echo "<tr><td><b>".$contador."</b></td><td><b>".$datos['username']."</b></td><td><b>".contPartidasjugadas($da['id_usuario'])."</b></td>
                <td><b>".contPartidasganadas($da['id_usuario'])."</b></td><td><b>".contPartidasempatadas($da['id_usuario'])."</b></td><td><b>".contPartidasperdidas($da['id_usuario'])."</b></td><td><b>".$datos['puntuacion']."</b></td></tr>";

        }else{

            echo "<tr><td>".$contador."</td><td>".$datos['username']."</td><td>".contPartidasjugadas($da['id_usuario'])."</td>
                <td>".contPartidasganadas($da['id_usuario'])."</td><td>".contPartidasempatadas($da['id_usuario'])."</td><td>".contPartidasperdidas($da['id_usuario'])."</td><td>".$datos['puntuacion']."</td></tr>";
        }
    }

    echo "</tbody></table>";

}

function contPartidasjugadas($id){
    $sql = "SELECT COUNT(*) from partidas WHERE (visitante=$id OR local=$id) AND estado != 'espera'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = $res->fetch_assoc();
    return $datos['COUNT(*)'];
}

function contPartidasganadas($id){
    $sql = "SELECT COUNT(*) from partidas WHERE (local = $id AND resultado = 1) OR (visitante = $id AND resultado = 2)";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $local = $res->fetch_assoc();

    return $local['COUNT(*)'];
}

function contPartidasperdidas($id){
    $sql = "SELECT COUNT(*) from partidas WHERE (local = $id AND resultado = 2) OR (visitante = $id AND resultado = 1)";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $local = $res->fetch_assoc();

    return $local['COUNT(*)'];
}

function contPartidasempatadas($id){
    $sql = "SELECT COUNT(*) from partidas WHERE (local=$id AND resultado='X') OR (visitante=$id AND resultado='X')";
    //$sql2 = "SELECT COUNT(*) from partidas WHERE visitante=$id AND resultado=1";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $local = $res->fetch_assoc();

    //$r = $conexion->query($sql2);
   // $visit = $r->fetch_assoc();

    return $local['COUNT(*)'];
}

function getDatosJuego($id){
    $sql = "SELECT * from juegos WHERE id_juego=$id";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = $res->fetch_assoc();


    return $datos;
}

function getTorneosActivos(){
    $sql = "SELECT * FROM torneos WHERE estado LIKE 'abierto' OR estado LIKE 'iniciado'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    echo "<ul class=\"list-group\">";
    while($data = $res->fetch_assoc()){

        $id = $data['id_torneo'];
        $juego = getDatosJuego($data['id_juego']);
        echo"<a href='tdetails.php?id=$id'>
            <li class='list-group-item d-flex justify-content-between align-items-center'><b>".$juego['nombre']."</b> - ".$data['nombre_torneo']."
                <span class='badge badge-pill badge-success'>".getparticipantes($id)."/".$data['max_participantes']."</span>
            </li>
        </a>";
    }
    echo "</ul>";
}

function getTorneosFinalizados(){
    $sql = "SELECT * FROM torneos WHERE estado LIKE 'finalizado'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    echo "<ul class=\"list-group\">";
    while($data = $res->fetch_assoc()){

        $id = $data['id_torneo'];
        $juego = getDatosJuego($data['id_juego']);
        echo"<a href='tdetails.php?id=$id'>
    <li class='list-group-item d-flex justify-content-between align-items-center'><b>".$juego['nombre']."</b> - ".$data['nombre_torneo']."
        <span class='badge badge-pill badge-success'>".$data['total_participantes']."/".$data['max_participantes']."</span>
    </li>
    </a>";
    }
    echo "</ul>";
}

function getDatosTorneo($id){
    $sql = "SELECT * FROM torneos WHERE id_torneo = $id";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = $res->fetch_assoc();

    return $datos;
}

function hayganador($id){
    $sql = "SELECT ganador FROM torneos WHERE id_torneo = $id";

    $conexion = conectar();
    $r = $conexion->query($sql);
    $datos = $r->fetch_assoc();
    if($datos['ganador'] == null){
        return false;
    }else{
        return true;
    }
}

function getPartidasTorneo($id_torneo)
{
    $sql = "SELECT * FROM partidas WHERE id_torneo = $id_torneo";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = [];

    while ($data = $res->fetch_assoc()) {
        $datos[] = $data;
    }
    return $datos;
}

function getPrimeraRonda($id_torneo){
    $sql = "SELECT * FROM partidas WHERE id_torneo = $id_torneo AND ronda=1";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = [];

    while ($data = $res->fetch_assoc()) {
        $datos[] = $data;
    }
    return $datos;
}

function getSegundaRonda($id_torneo){
    $sql = "SELECT * FROM partidas WHERE id_torneo = $id_torneo AND ronda=2";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = [];

    while ($data = $res->fetch_assoc()) {
        $datos[] = $data;
    }
    return $datos;
}

function getFinal($id_torneo){
    $sql = "SELECT * FROM partidas WHERE id_torneo = $id_torneo AND ronda=3";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = [];

    while ($data = $res->fetch_assoc()) {
        $datos[] = $data;
    }
    return $datos;
}

function torneolleno($id_torneo){
    $sql = "SELECT participantes FROM torneos WHERE id_torneo = $id_torneo";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $datos = $r->fetch_assoc();
    $x = explode(",",$datos['participantes']);

    if(count($x)<8){
        return false;
    }else{
        return true;
    }
}

function yainscrito($id_torneo,$id_usuario){
    $si = false;
    $sql = "SELECT COUNT(*) FROM participantes WHERE id_torneo = $id_torneo AND id_usuario = $id_usuario";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $datos = $r->fetch_assoc();
    if($datos['COUNT(*)'] == 1){
        return true;
    }else{
        return false;
    }
}

function getPartida($id_partida){
    $sql = "SELECT * FROM partidas WHERE id_partida = $id_partida";
    $conexion = conectar();
    $res = $conexion->query($sql);


    return $res->fetch_assoc();
}

function getImagenPersonaje($id){
    $sql = "SELECT imagen FROM personajes WHERE id_personaje = $id";
    $conexion = conectar();
    $res = $conexion->query($sql);

    return $res->fetch_assoc();
}

function getCategoriasForo(){
    $conexion = conectar();
    $sqlcategorias = "SELECT * FROM categoria_foro";
    $r = $conexion->query($sqlcategorias);
    $datos = [];
    while( $d = $r->fetch_assoc()){
        $datos[] = $d;
    }

    return $datos;

}

function getHilosCategoria($id){
    $conexion = conectar();
    $sqlcategorias = "SELECT * FROM hilo WHERE id_categoria = $id";
    $r = $conexion->query($sqlcategorias);
    $datos = [];
    while( $d = $r->fetch_assoc()){
        $datos[] = $d;
    }
    return $datos;

}

function getMensajesHilo($id_hilo){
    $conexion = conectar();
    $sqlcategorias = "SELECT * FROM mensajes WHERE id_hilo = $id_hilo";
    $r = $conexion->query($sqlcategorias);
    $datos = [];
    while( $d = $r->fetch_assoc() ){
        $datos[] = $d;
    }
    return $datos;

}


function getHilo($id_hilo){
    $sql=  "SELECT * FROM hilo WHERE id_hilo = $id_hilo";
    $conexion = conectar();
    $r = $conexion->query($sql);
    return $d= $r->fetch_assoc();
}

function getmensajeporid($id){
    $sql=  "SELECT * FROM mensajes WHERE id_mensaje = $id";
    $conexion = conectar();
    $r = $conexion->query($sql);
    return $d= $r->fetch_assoc();
}

function getidhilo($titulo,$autor){
    $sql=  "SELECT * FROM hilo WHERE titulo = '$titulo' AND autor = $autor";
    $conexion = conectar();
    $r = $conexion->query($sql);
    return $d= $r->fetch_assoc();
}

function getTorneosganados($id){
    $sql=  "SELECT COUNT(*) FROM torneos WHERE ganador = $id";
    $conexion = conectar();
    $r = $conexion->query($sql);
    return $d= $r->fetch_assoc();
}

function getparticipantes($id){
    $sql=  "SELECT COUNT(*) FROM participantes WHERE id_torneo = $id";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $d= $r->fetch_assoc();
    return $d['COUNT(*)'];
}

function getPermiso($uname){
    $sql = "SELECT permiso FROM usuarios WHERE username LIKE '$uname'";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $d= $r->fetch_assoc();
    return $d['permiso'];
}

function getCantidadUsuarios(){
    $sql = "SELECT COUNT(*) FROM usuarios";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $d= $r->fetch_assoc();
    return $d['COUNT(*)'];
}

function getDatosParticipantes($id_torneo){
     $conexion = conectar();
    $sqlcategorias = "SELECT id_usuario FROM participantes WHERE id_torneo = $id_torneo";
    $r = $conexion->query($sqlcategorias);
    $datos = [];
    while( $d = $r->fetch_assoc() ){
        $datos[] = $d['id_usuario'];
    }
    return $datos;

}

function getPersonajesJuego($id_juego){
    $conexion = conectar();
    $sqlcategorias = "SELECT id_personaje FROM personajes WHERE id_juego = $id_juego";
    $r = $conexion->query($sqlcategorias);
    $datos = [];
    while( $d = $r->fetch_assoc() ){
        $datos[] = $d;
    }
    return $datos;
}

function comprobarSiPartidasCreadas($id_torneo){
    $sql = "SELECT COUNT(*) FROM partidas WHERE id_torneo = $id_torneo";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $d= $r->fetch_assoc();
    return $d['COUNT(*)'];
}

function comprobarPrimeraRondaJugada($id_torneo){
    $sql = "SELECT COUNT(*) FROM partidas WHERE id_torneo = $id_torneo AND ronda = 1 AND resultado != 'espera'";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $d= $r->fetch_assoc();
    return $d['COUNT(*)'];
}

function comprobarSegundaRondaJugada($id_torneo){
    $sql = "SELECT COUNT(*) FROM partidas WHERE id_torneo = $id_torneo AND ronda = 2 AND resultado != 'espera'";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $d= $r->fetch_assoc();
    return $d['COUNT(*)'];
}

function getGanadores($id_torneo,$ronda){
    $sql = "SELECT local,visitante,resultado FROM partidas WHERE id_torneo = $id_torneo AND ronda = $ronda";
    $conexion = conectar();
    $r = $conexion->query($sql);
    $datos = [];
    while( $d = $r->fetch_assoc() ){
        $datos[] = $d;
    }
    $ganadores = [];
    for ($i = 0; $i < count($datos); $i++){
        $local = $datos[$i]['local'];
        $visitante = $datos[$i]['visitante'];
        $resultado = $datos[$i]['resultado'];
        if($resultado == 1){
            $ganadores[] = $local;
        }else{
            $ganadores[] = $visitante;
        }
    }
    return $ganadores;
}