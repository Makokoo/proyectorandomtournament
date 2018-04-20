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
    $sql = "SELECT username,password FROM usuarios WHERE username LIKE '$nick' AND password LIKE '$pass'";
    $resultado= $conexion->query($sql);
    echo $sql;
    $datos = array();

    while ($data=$resultado->fetch_row()) {
        $datos = $data;
    }

    if(count($datos)==2) {
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
    $sql = "INSERT INTO usuarios(username, mail, password) VALUES ('$uname', '$mail', '$psw')";
    $conexion->query($sql);
    if($conexion->affected_rows>0){
        return true;
    }else{
        return false;
    }
}

function modificarusuario($id,$newuname, $newmail, $password){
    $conexion = conectar();
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

function getClasificacion($uname){
    $contador = 0;
    $sql = "SELECT username, puntuacion from usuarios ORDER BY puntuacion DESC";
    $conexion = conectar();
    $res = $conexion->query($sql);

    echo "<table class='table table-bordered'>";

    while(datos = $res->fetch_assoc()){
        $contador++;
        
        if($uname == $datos['username']){

            echo "<tr><th>".$contador."</th><th>".$datos['username']."</th><th>".$datos['puntuacion']."</th></tr>";

        }else{

            echo "<tr><td>".$contador."</td><td>".$datos['username']."</td><td>".$datos['puntuacion']."</td></tr>";
        }
    }

    echo "</table>";

}