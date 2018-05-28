<?php

/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 25/01/2017
 * Time: 8:03
 */


class Carrito{

    private $lista = array();

    public function __construct($usuario){
        $this->usuario = $usuario;
    }

    public function addProducto($cod_articulo,$cantidad){
        if(empty($this->lista[$cod_articulo])){
            $this->lista[$cod_articulo] = $cantidad;
        }else{
            $this->lista[$cod_articulo] = $this->lista[$cod_articulo]+$cantidad;
        }
    }

    public function delProducto($cod_articulo){
        if (array_key_exists($cod_articulo, $this->lista)) {
            unset($this->lista[$cod_articulo]);
        }
    }

    public function vaciarCarrito(){
        $this->lista = array();
    }

    public function getlista(){
        return $this->lista;
    }



    public function __toString(){
        $conexion = conectar();
        $total = 0;
        $mostrar = "";
        $mostrar.= "<table class='table text-center'>";
        foreach ($this->lista as $clave => $valor) {
            $datos = sacardatoarticulo($clave,$conexion);
            $imagen = $datos['imagen'];
            $mostrar.= "<tr><td><img src='$imagen' style='max-height: 30px'></td><td>".$datos['nombre_articulo']." (".$datos['precio']."€)</td><td>x".$valor."</td></tr>";
            $total = $total + ($datos['precio']*$valor);
        }
        $mostrar.= "</table>";
        $mostrar.= "<table class='table-bordered text-right' style='float:right'><tr><td><b>TOTAL: </b>".$total."€</td></tr>";
        $mostrar.= "</table>";
        $mostrar.= "<br>";

        return $mostrar;

    }

}