<?php
include_once 'Carrito.php';
include_once 'Producto.php';
include_once 'funciones.php';

session_start();
if(isset($_SESSION['carrito'])) {

    $carrito = $_SESSION['carrito'];
    $carrito->vaciarCarrito();
    header('location:ver_carrito.php');


}
?>
