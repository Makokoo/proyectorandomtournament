<?php
include_once 'funciones.php';
include_once 'header.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql2 = "SELECT id_hilo FROM mensajes WHERE id_mensaje = $id";
    $conexion = conectar();
    $r = $conexion->query($sql2);
    $d = $r->fetch_assoc();
    $idhilo = $d['id_hilo'];
    $sql = "DELETE FROM mensajes WHERE id_mensaje = $id ";
    $conexion = conectar();
    $conexion->query($sql);
    if($conexion->affected_rows > 0){
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Mensaje eliminado correctamente</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$idhilo'");
    }else{
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Error, no se ha podido eliminar el mensaje</h2>";
        echo "</div>";
        header("Refresh:3; url='viewthread.php?id=$idhilo'");
    }

}else if(isset($_GET['idpost'])){
    $id = $_GET['idpost'];
    $sql = "DELETE FROM hilo WHERE id_hilo = $id ";
    $conexion = conectar();
    $conexion->query($sql);
    if($conexion->affected_rows > 0){
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Hilo eliminado correctamente</h2>";
        echo "</div>";
        header("Refresh:3; url='forum.php?'");
    }else{
        echo "<div class=\"container\" style='margin: 250px'>";
        echo "<h2 class='text-center'>Error, no se ha podido eliminar el hilo</h2>";
        echo "</div>";
        header("Refresh:3; url='forum.php?'");
    }
}

include_once 'footer.php';