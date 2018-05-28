<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 28/05/2018
 * Time: 18:26
 */
include_once 'Carrito.php';
session_start();
$carrito = $_SESSION['carrito'];
$codigo = $_GET['id'];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($codigo !== "") {

    $carrito->delProducto($codigo);
    $hint = "Borrado correctamente";
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No se ha podido borrar" : $hint;
header('location:ver_carrito.php');