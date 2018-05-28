<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 17/01/2018
 * Time: 11:26
 */

include_once '../funciones.php';


function totalarticulos(){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM articulos WHERE estado LIKE 'alta'";
    $ro = $conexion->query($sql);
    $total = $ro->fetch_assoc();
    return $total['COUNT(*)'];
}

function totalarticuloscategoria($categoria){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM articulos WHERE categoria LIKE '".$categoria."'";
    $ro = $conexion->query($sql);
    $total = $ro->fetch_assoc();
    return $total['COUNT(*)'];
}



function verproductosoferta(){
    $conexion = conectar();


    $mostrar = "";
    $sqllineas = "SELECT * FROM articulos WHERE precio < 100 AND estado NOT LIKE 'baja' LIMIT 9";
    $ro = $conexion->query($sqllineas);
    while ($detalles = $ro->fetch_assoc()) {
        $mostrar .= "<div style='float:left;padding:45px;'>";

        $nombre_fichero = "imagenes/".$detalles['cod_articulo'].".png";

        if (file_exists($nombre_fichero)) {
            $mostrar.="<img src=" . $nombre_fichero . " width='265px' height='150px'>";
        } else {
            $mostrar.="<img src=" . $detalles['imagen'] . " width='265px' height='150px'>";
        }




                $mostrar.="<div class='info'>
                    <h3 style='padding-left: 10px'>" . $detalles['nombre_articulo'] . "</h3>
                    <span class=\"description\" style='padding-left: 10px'>";
                    if(strlen($detalles['descripcion_articulo']) > 50){
                        for($i = 0 ; $i<35 ; $i++){
                            $mostrar.= $detalles['descripcion_articulo'][$i];
                        }
                        $mostrar.="...";
                    }else{
                        $mostrar.= $detalles['descripcion_articulo'];
                    }
                    $mostrar.="</span>
                    </br>
                    <span class='h2' style='padding-left: 10px;'>" . $detalles['precio'] . "€</span>
                    <a class='btn btn-success' style='float: right;margin: 20px' href='verproducto.php?codarticulo=".$detalles['cod_articulo']."'><i></i>Ver Producto</a>
                </div>
            </div>
        
    ";

    }
    return $mostrar;
}

function verproductosporcategoria($categoria){
    $conexion = conectar();
    $num_filas = 8;
    $mostrar ="";
    $total_articulos = totalarticuloscategoria($categoria);
    if (isset($_GET["desplazamiento"]))
        $desplazamiento = $_GET["desplazamiento"];
    else $desplazamiento = 0;
    $sql = "SELECT * FROM articulos WHERE categoria LIKE '$categoria' ORDER BY cod_articulo  LIMIT $desplazamiento, $num_filas ";

    $ro = $conexion->query($sql);

    while($detalles = $ro->fetch_assoc()){
        if($detalles['estado']=="alta") {
            $mostrar .= "<div class='border center-block hoover' style='float:left;padding:45px;'>";
            $nombre_fichero = "imagenes/".$detalles['cod_articulo'].".png";
            if (file_exists($nombre_fichero)) {
                $mostrar.="<img src=" . $nombre_fichero . " width='265px' height='150px'>";
            } else {
                $mostrar.="<img src=" . $detalles['imagen'] . " width='265px' height='150px'>";
            }
                $mostrar.="<div class='info'>
                    <h4 style='padding-left: 10px'>" . $detalles['nombre_articulo'] . "</h4>
                    <span class=\"description\" style='padding-left: 10px'>";
                    if(strlen($detalles['descripcion_articulo']) > 50){
                        for($i = 0 ; $i<35 ; $i++){
                            $mostrar.= $detalles['descripcion_articulo'][$i];
                        }
                        $mostrar.="...";
                    }else{
                        $mostrar.= $detalles['descripcion_articulo'];
                    }
                    $mostrar.="</span>
                    </br>
                    <span class='h2' style='padding-left: 10px'>" . $detalles['precio'] . "€</span>
                    <a class='btn btn-info' style='float: right;margin: 20px' href=\"verproducto.php?codarticulo=" . $detalles['cod_articulo'] . "\"><i></i>Ver Producto</a>
                </div>
            </div>
        
    ";
        }

    }

    if ($desplazamiento > 0) {
        $prev = $desplazamiento - $num_filas;
        $url = $_SERVER["PHP_SELF"] . "?categoria=$categoria&desplazamiento=$prev";
        $mostrar .= "<button><A HREF='$url'>Página anterior</A></button>";
    }
    if ($total_articulos > ($desplazamiento + $num_filas)) {
        $prox = $desplazamiento + $num_filas;
        $url = "index.php?categoria=$categoria&desplazamiento=$prox";
        $mostrar .= "<button class='buttons'><A HREF='$url'>Próxima página</A></button>";
    }
    return $mostrar;

}

function verproductosporbusqueda($busqueda){
    $conexion = conectar();

    $mostrar ="";

    $sql = "SELECT * FROM articulos WHERE nombre_articulo LIKE '%$busqueda%' OR descripcion_articulo LIKE '%$busqueda%'";

    $ro = $conexion->query($sql);

    while($detalles = $ro->fetch_assoc()){
        if($detalles['estado'] == "alta") {
            $mostrar .= "<div class='border center-block hoover' style='float:left;padding:45px;'>";

            $nombre_fichero = "imagenes/".$detalles['cod_articulo'].".png";
            if (file_exists($nombre_fichero)) {
                $mostrar.="<img src=" . $nombre_fichero . " width='265px' height='150px'>";
            } else {
                $mostrar.="<img src=" . $detalles['imagen'] . " width='265px' height='150px'>";
            }
                $mostrar.="<div class='info'>
                    <h4 style='padding-left: 10px'>" . $detalles['nombre_articulo'] . "</h4>
                    <span class=\"description\" style='padding-left: 10px'>
                        ";
                    if(strlen($detalles['descripcion_articulo']) > 50){
                        for($i = 0 ; $i<35 ; $i++){
                            $mostrar.= $detalles['descripcion_articulo'][$i];
                        }
                        $mostrar.="...";
                    }else{
                        $mostrar.= $detalles['descripcion_articulo'];
                    }
                    $mostrar.="</span>
                    </br>
                    <span class='h2' style='padding-left: 10px'>" . $detalles['precio'] . "€</span>
                    <a class='btn btn-success' style='float: right;margin: 20px' href=\"verproducto.php?codarticulo=" . $detalles['cod_articulo'] . "\"><i></i>Ver Producto</a>
                </div>
            </div>
        
    ";
        }
    }

    return $mostrar;
}

function vertodoslosproductos(){
    $conexion = conectar();
    $num_filas = 8;
    $mostrar ="";
    $total_articulos = totalarticulos();
    if (isset($_GET["desplazamiento"]))
        $desplazamiento = $_GET["desplazamiento"];
    else $desplazamiento = 0;
    $sql = "SELECT * FROM articulos WHERE estado NOT LIKE 'baja' ORDER BY cod_articulo LIMIT $desplazamiento, $num_filas";

    $ro = $conexion->query($sql);

    while($detalles = $ro->fetch_assoc()){
        $mostrar .= "<link href=\"bootstrap.css\" rel=\"stylesheet\">
            <div class='border center-block hoover' style='float:left;padding:19px;'>";

        $nombre_fichero = "imagenes/".$detalles['cod_articulo'].".png";
        if (file_exists($nombre_fichero)) {
            $mostrar.="<img src=" . $nombre_fichero . " width='265px' height='150px'>";
        } else {
            $mostrar.="<img src=" . $detalles['imagen'] . " width='265px' height='150px'>";
        }

                $mostrar.="<div class='info'>
                    <h4 style='padding-left: 10px'>" . $detalles['nombre_articulo'] . "</h4>
                    <span class=\"description\" style='padding-left: 10px'>";
                    if(strlen($detalles['descripcion_articulo']) > 50){
                        for($i = 0 ; $i<35 ; $i++){
                            $mostrar.= $detalles['descripcion_articulo'][$i];
                        }
                        $mostrar.="...";
                    }else{
                        $mostrar.= $detalles['descripcion_articulo'];
                    }
                    $mostrar.="</span>
                    </br>
                    <span class='h2' style='padding-left: 10px'>" . $detalles['precio'] . "€</span>
                    <a class='btn btn-info' style='float: right;margin: 20px' href='verproducto.php?codarticulo=".$detalles['cod_articulo']."'><i></i>Ver Producto</a>
                </div>
            </div>
        
    ";

    }

    if ($desplazamiento > 0) {
        $prev = $desplazamiento - $num_filas;
        $url = $_SERVER["PHP_SELF"] . "?categoria=all&desplazamiento=$prev";
        $mostrar .= "</br><div class='text-center float-left'><button><A HREF='$url'>Página anterior</A></button></div>";
    }
    if ($total_articulos > ($desplazamiento + $num_filas)) {
        $prox = $desplazamiento + $num_filas;
        $url = "index.php?categoria=all&desplazamiento=$prox";
        $mostrar .= "<div class='text-center'><button class='buttons' style='float:right'><A HREF='$url'>Próxima página</A></button></div>";
    }


    return $mostrar;

}

function mostrarmenu(){

    $mostrar = "";
    $mostrar .= "<link href=\"bootstrap.css\" rel=\"stylesheet\">
<p align='center'>
<ul id=\"menu\" style='margin: auto;'>
            <li><a href=\"index.php\">Inicio</a></li>
            <li><a href=\"index.php\">Ofertas</a></li>
            <li><a href=\"quienessomos.php\">Quienes Somos</a> </li>
            <li><a href=\"contacto.php\">Contacto</a></li>";

        $mostrar .= "</ul>
        </p>";

    return $mostrar;

}

function verproducto($codigo){
    $conexion = conectar();

    if(isset($_SESSION['usuario']))
        $cliente = $_SESSION['usuario'];
    else{
        $cliente = "invitado";
    }


    $mostrar = "";
    $sqllineas = "SELECT * FROM articulos WHERE cod_articulo = $codigo ";
    $ro = $conexion->query($sqllineas);
    while ($detalles = $ro->fetch_assoc()) {
        $mostrar .= "<div class='border center-block hoover' style='float:none;padding:19px;'>";

        $nombre_fichero = "imagenes/".$detalles['cod_articulo'].".png";
        if (file_exists($nombre_fichero)) {
            $mostrar.="<img src=" . $nombre_fichero . " width='450px' height='250px'>";
        } else {
            $mostrar.="<img src=" . $detalles['imagen'] . " width='450px' height='250px'>";
        }
       

                $mostrar.="<div class='info'>
                    <h4 style='padding-left: 10px'>" .$detalles['nombre_articulo'].  "</h4>
                    
                    <span class=\"description\" style='padding-left: 10px'>
                        " . $detalles['descripcion_articulo'] . "
                    </span>
                    </br>
                    <span class='h2' style='padding-left: 10px'>" . $detalles['precio'] . "€</span>
                    
                    <form method='post' action='alcarrito.php' style='float:right'>
                        Cantidad: <input type='number' name='cantidad' id='cantidad' style='width:50px;' min='1' required class='form-group'>
                        <input type='submit' class='btn btn-info'  name='anadir' id='anadir' value='Añadir al carrito'>
                        <input type='hidden' name='cod' id='cod' value=" . $detalles['cod_articulo'] . ">
                        <input type='hidden' name='nick' id='nick' value=".$cliente.">
                        <input type='hidden' name='nombre' id='nombre' value=".$detalles['nombre_articulo'].">
                       
                        </form>
                    </br>
                </div>
            </div>
        
    ";

    }
    return $mostrar;
}

function sacarcodcliente($nombre, $conexion)
{
    $sql = "SELECT id_usuario FROM usuarios WHERE username LIKE '$nombre'";
    $res = $conexion->query($sql);
    $dato = $res->fetch_assoc();
    return $dato['id_usuario'];
}

function sacardatoarticulo($cod,$conexion){
    $sql = "SELECT * FROM articulos WHERE cod_articulo = $cod";
    $res = $conexion->query($sql);
    $dato = $res->fetch_assoc();
    return $dato;
}

function verpedidos($nombre)
{
    $conexion = conectar();


    $codigo = sacarcodcliente($nombre, $conexion);

    $sql = "SELECT * FROM pedidos WHERE id_usuario = $codigo";

    $resultado = $conexion->query($sql);
    $mostrar = "";
    echo "<h1>Pedidos del cliente: " . $nombre . "</h1>";
    while ($linea = $resultado->fetch_assoc()) {

        $mostrar .= "<table class='table table-bordered text-center '><tr>
    <th class='text-center label-primary btn-warning'>CODIGO PEDIDO</th>
    <th class='text-center label-primary btn-warning'>ESTADO</th>
    <th class='text-center label-primary btn-warning'>FECHA PEDIDO</th>";
        if(($linea['estado']=="procesando") && verpermiso($nombre,$conexion)>0) {
            //$mostrar.="<th class='text-center label-primary btn-warning' > MODIFICAR</th >";
        }
        $conexion = conectar();
        if(verpermiso($_SESSION['usuario'],$conexion)==1 || verpermiso($_SESSION['usuario'],$conexion)==3){
            if($linea['estado']=="procesando") {
                $mostrar .= "<th class='text-center label-primary btn-warning' >PROCESAR</th >";
                $mostrar .= "<th class='text-center label-primary btn-warning' >CANCELAR</th >";
            }
        }else if(verpermiso($_SESSION['usuario'],$conexion)==0 && $linea['estado']=='procesando' ){
            $mostrar .= "<th class='text-center label-primary btn-warning' >CANCELAR</th >";
        }

    $mostrar.="</tr>";


        $mostrar .= "<tr><td>" . $linea['cod_pedido'] . "</td><td>" . $linea['estado'] . "</td><td>" . $linea['fecha'] .
            "</td>";

        if($linea['estado']=="procesando" && verpermiso($nombre,$conexion)>0) {
            //$mostrar.="<td><form method='post' action='modificar_pedido.php'>";
            //$mostrar.= " <input class='btn btn-primary' type='submit' name='modificar' id='modificar' value='Modificar'>
                        //<input type='hidden' name='cod' id='cod' value=" . $linea['cod_pedido'] . ">
                                              
                        //</form>
                    //</td>";
        }
        if(verpermiso($_SESSION['usuario'],$conexion)==1 || verpermiso($_SESSION['usuario'],$conexion)==3){
            if($linea['estado']=="procesando") {
                $mostrar .= "<td><form method='post' action='procesar_pedido.php'>";
                $mostrar .= " <input class='btn btn-success' type='submit' name='procesar' id='procesar' value='Procesar'>
                        <input type='hidden' name='cod' id='cod' value=" . $linea['cod_pedido'] . ">";

                        $mostrar.="</form></td>";
                $mostrar .= "<td><form method='post' action='cancelar_pedido.php'>";
                $mostrar .= " <input class='btn btn-danger' type='submit' name='cancelar' id='cancelar' value='Cancelar'>
                        <input type='hidden' name='cod' id='cod' value=" . $linea['cod_pedido'] . ">";

                $mostrar.="</form></td>";
            }
        }else if(verpermiso($_SESSION['usuario'],$conexion)==0 && $linea['estado']=='procesando' ){
            $mostrar .= "<td><form method='post' action='cancelar_pedido.php'>";
            $mostrar .= " <input class='btn btn-danger' type='submit' name='cancelar' id='cancelar' value='Cancelar'>
                        <input type='hidden' name='cod' id='cod' value=" . $linea['cod_pedido'] . ">";

            $mostrar.="</form></td>";
}







        $sqllineas = "SELECT * FROM lineas_pedidos WHERE cod_pedido=" . $linea['cod_pedido'];

        $ro = $conexion->query($sqllineas);
        while ($linea_pedido = $ro->fetch_assoc()) {
            $datosproducto = sacardatoarticulo($linea_pedido['cod_articulo'],$conexion);
            $mostrar .= "</table><table class='table table-bordered text-center'><tr>
    <th class='text-center'>LINEA</th>
    <th class='text-center'>IMAGEN</th>
    <th class='text-center'>ARTICULO</th>
    <th class='text-center'>CANTIDAD</th>
   
    </tr>
    <td>" . $linea_pedido['num_linea_pedido'] . "</td>
    <td><img src='" . $datosproducto['imagen'] . "' width='10%'></td>
    <td>" . $datosproducto['nombre_articulo'] . "</td>
    <td>" . $linea_pedido['cantidad'] . "</td>
    
    </table>";
        }

        $mostrar .= "</table><hr>";
    }

    return $mostrar;
}

function verpermiso($nombre,$conexion){
    /*
     * 0: Cliente normal
     * 1: Empleado
     * 3: SuperUsuario
     */
    $sql = "SELECT permiso FROM usuarios WHERE nick LIKE '$nombre'";
    $res = $conexion->query($sql);
    $dato = $res->fetch_assoc();
    return $dato['permiso'];
}

function verclientes()
{
    $conexion = conectar();

    //echo "<a href='nuevocliente.php'><button class='btn btn-success'>Nuevo Cliente</button></a>";

    $sql = "SELECT * FROM usuarios WHERE permiso != 3";

    $resultado = $conexion->query($sql);
    $mostrar = "";
    $mostrar .= "<table class='table table-bordered text-center '><tr>
        <th class='text-center label-primary btn-info'>ID</th>
        <th class='text-center label-primary btn-info'>USERNAME</th>
        <th class='text-center label-primary btn-info'>ESTADO</th>
        <th class='text-center label-primary btn-info'>CAMBIAR ESTADO</th>
        <th class='text-center label-primary btn-info'>MODIFICAR</th>
    </tr>";
    while ($linea = $resultado->fetch_assoc()) {




        $mostrar .= "<tr><td>" . $linea['id_usuario'] . "</td><td>" . $linea['username'] .
            "</td>";
        if($linea['estado'] == 'alta') {
            $mostrar .= "<td class='alert-success'>".$linea['estado']."</td>";
        }else{
            $mostrar .= "<td class='alert-warning'>".$linea['estado']."</td>";
        }

        $mostrar .="<td><form method='post' action='cambiarestadocliente.php'>

                <input class='btn btn-primary' type='submit' name='modificar' id='modificar' value='Cambiar Estado'>
                <input type='hidden' name='cod' id='cod' value=" . $linea['id_usuario'] . ">

            </form>
        </td><td><form method='post' action='modificarcliente.php'>

                <input class='btn btn-primary' type='submit' name='modificar' id='modificar' value='Modificar'>
                <input type='hidden' name='cod' id='cod' value=" . $linea['id_usuario'] . ">

            </form>";




    }
    $mostrar .= "</td></table>";

    return $mostrar;

}

function cambiarestadocliente ($cod){
    $conexion = conectar();
    $estadoinicial = "";
    $sql = "SELECT estado FROM usuarios WHERE id_usuario = ".$cod;
    $resultado = $conexion->query($sql);
    $sql2 = "";

    while ($linea = $resultado->fetch_assoc()) {
        $estadoinicial = $linea['estado'];
    }

    if($estadoinicial=="alta"){
        $sql2 = "UPDATE usuarios SET estado = 'baja' WHERE id_usuario=$cod ";

    }else{
        $sql2 = "UPDATE usuarios SET estado = 'alta' WHERE id_usuario=$cod ";
    }
    echo $sql2;

    $conexion->query($sql2);


}

function cambiarestadoproducto ($cod, $conexion){
    $estadoinicial = "";
    $sql = "SELECT estado FROM articulos WHERE cod_articulo = ".$cod;
    $resultado = $conexion->query($sql);
    $sql2 = "";

    while ($linea = $resultado->fetch_assoc()) {
        $estadoinicial = $linea['estado'];
    }

    if($estadoinicial=="alta"){
        $sql2 = "UPDATE articulos SET estado = 'baja' WHERE cod_articulo=$cod ";
    }else{
        $sql2 = "UPDATE articulos SET estado = 'alta' WHERE cod_articulo=$cod ";
    }

    $conexion->query($sql2);


}

function verlistaproductos()
{
    $conexion = conectar();


    echo "<a href='modificararticulo.php'><button class='btn btn-success'>Crear Nuevo Producto</button></a>";
    echo "<a href='crearcategoria.php'><button class='btn btn-warning'>Crear Nueva Categoria</button></a>";
    echo "<a href='eliminarcategoria.php'><button class='btn btn-danger'>Eliminar Categoria</button></a>";
    $sql = "SELECT * FROM articulos";

    $resultado = $conexion->query($sql);
    $mostrar = "";
    $mostrar .= "<table class='table table-bordered text-center '><tr>
        <th class='text-center label-primary btn-info'>NOMBRE</th>
        <th class='text-center label-primary btn-info'>IMAGEN</th>
        <th class='text-center label-primary btn-info'>PRECIO</th>
        <th class='text-center label-primary btn-info'>ESTADO</th>
        <th class='text-center label-primary btn-info'>CAMBIAR ESTADO</th>
        <th class='text-center label-primary btn-info'>MODIFICAR ARTÍCULO</th>
        
    </tr><tr>";

    while ($linea = $resultado->fetch_assoc()) {

        $nombre_fichero = "imagenes/".$linea['cod_articulo'].".png";
        if (file_exists($nombre_fichero)) {
            $mostrar.="<td><img src='" . $nombre_fichero ."' style='width: 30px'></td>";
        } else {
            $mostrar.="<td><img src='" . $linea['imagen'] ."' style='width: 30px'></td>";
        }


        $mostrar .= "<td>" . $linea['nombre_articulo'] . "</td>
             </td><td>".$linea['precio']."</td>";
        if($linea['estado'] == 'alta') {
            $mostrar .= "<td class='alert-success'>".$linea['estado']."</td>";
        }else{
            $mostrar .= "<td class='alert-warning'>".$linea['estado']."</td>";
        }

        $mostrar .="<td><form method='post' action='cambiarestadoproducto.php'>

                <input class='btn btn-primary' type='submit' name='modificar' id='modificar' value='Cambiar Estado'>
                <input type='hidden' name='cod' id='cod' value=" . $linea['cod_articulo'] . ">

            </form>
        </td>";

        $mostrar .="<td><form method='post' action='modificararticulo.php'>

                <input class='btn btn-primary' type='submit' name='modificar' id='modificar' value='Modificar'>
                <input type='hidden' name='cod' id='cod' value=" . $linea['cod_articulo'] . ">
                <input type='hidden' name='precio' id='precio' value=" . $linea['precio'] . ">
                <input type='hidden' name='nombre' id='nombre' value=" . $linea['nombre_articulo'] . ">
                <input type='hidden' name='descripcion' id='descripcion' value=" . $linea['descripcion_articulo'] . ">
                <input type='hidden' name='categoria' id='categoria' value=" . $linea['categoria'] . ">

            </form>
        </td>";




        $mostrar .= "</tr>";

    }
    $mostrar.= "</table>";
    return $mostrar;

}



function mismonick($original,$nuevo){
    $sql = "SELECT nick FROM usuarios WHERE nick LIKE '$original'";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $dato = $res->fetch_assoc();

    if($dato['nick']==$nuevo){
        return true;
    }else{
        return false;
    }

}

function getnick($cod){
    $sql = "SELECT nick FROM usuarios WHERE id_usuario=$cod";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $dato = $res->fetch_assoc();

    return $dato['nick'];

}

function gestionpedido($nombre)
{
    $conexion = conectar();


    $codigo = sacarcodcliente($nombre, $conexion);

    $sql = "SELECT * FROM pedidos WHERE id_usuario = $codigo";

    $resultado = $conexion->query($sql);
    $mostrar = "";
    echo "<h1>Pedidos del cliente: " . $nombre . "</h1>";
    while ($linea = $resultado->fetch_assoc()) {

        $mostrar .= "<table class='table table-bordered text-center '><tr>
    <th class='text-center label-primary btn-warning'>CODIGO PEDIDO</th>
    <th class='text-center label-primary btn-warning'>ESTADO</th>
    <th class='text-center label-primary btn-warning'>FECHA PEDIDO</th>";
        if(($linea['estado']=="procesando") && verpermiso($nombre,$conexion)>0) {
            $mostrar.="<th class='text-center label-primary btn-warning' > MODIFICAR</th >";
        }
        $conexion = conectar();
        if(verpermiso($_SESSION['usuario'],$conexion)==1 || verpermiso($_SESSION['usuario'],$conexion)==3){
            if($linea['estado']=="procesando") {
                $mostrar .= "<th class='text-center label-primary btn-warning' >PROCESAR</th >";
            }
        }
        $mostrar.="</tr>";


        $mostrar .= "<tr><td>" . $linea['cod_pedido'] . "</td><td>" . $linea['estado'] . "</td><td>" . $linea['fecha'] .
            "</td>";

        if($linea['estado']=="procesando" && verpermiso($nombre,$conexion)>0) {
            $mostrar.="<td><form method='post' action='modificar_pedido.php'>";
            $mostrar.= " <input class='btn btn-primary' type='submit' name='modificar' id='modificar' value='Modificar'>
                        <input type='hidden' name='cod' id='cod' value=" . $linea['cod_pedido'] . ">
                                              
                        </form>
                    </td>";
        }
        if(verpermiso($_SESSION['usuario'],$conexion)==1 || verpermiso($_SESSION['usuario'],$conexion)==3){
            if($linea['estado']=="procesando") {
                $mostrar .= "<td><form method='post' action='procesar_pedido.php'>";
                $mostrar .= " <input class='btn btn-danger' type='submit' name='procesar' id='procesar' value='Procesar'>
                        <input type='hidden' name='cod' id='cod' value=" . $linea['cod_pedido'] . ">
                                              
                        </form>
                    </td>";
            }
        }







        $sqllineas = "SELECT * FROM lineas_pedidos WHERE cod_pedido=" . $linea['cod_pedido'];

        $ro = $conexion->query($sqllineas);
        while ($linea_pedido = $ro->fetch_assoc()) {
            $datosproducto = sacardatoarticulo($linea_pedido['cod_articulo'],$conexion);
            $mostrar .= "</table><table class='table table-bordered text-center'><tr>
    <th class='text-center'>LINEA</th>
    <th class='text-center'>IMAGEN</th>
    <th class='text-center'>ARTICULO</th>
    <th class='text-center'>CANTIDAD</th>
   
    </tr>
    <td>" . $linea_pedido['num_linea_pedido'] . "</td>
    <td><img src='" . $datosproducto['imagen'] . "' width='10%'></td>
    <td>" . $datosproducto['nombre_articulo'] . "</td>
    <td>" . $linea_pedido['cantidad'] . "</td>
    
    </table>";
        }

        $mostrar .= "</table><hr>";
    }

    return $mostrar;
}

function obtenernumeropedidos(){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM pedidos";
    $r = $conexion->query($sql);
    $d = $r->fetch_assoc();
    $numpedidos = $d['COUNT(*)'];

    return $numpedidos;
}

function obtenerarticulosvendidos(){
    $conexion = conectar();
    $sql2 = "SELECT SUM(cantidad) FROM lineas_pedidos";
    $r2 = $conexion->query($sql2);
    $d2 = $r2->fetch_assoc();
    $numarticulosvendidos = $d2['SUM(cantidad)'];
    return $numarticulosvendidos;
}

function obtenernumerousuarios(){
    $conexion = conectar();
    $sql3 = "SELECT COUNT(*) FROM usuarios";
    $r3 = $conexion->query($sql3);
    $d3 = $r3->fetch_assoc();
    $numusuarios = $d3['COUNT(*)'];
    return $numusuarios;

}

function obtenernumeroarticulos(){
    $conexion = conectar();
    $sql4 = "SELECT COUNT(*) FROM articulos";
    $r4 = $conexion->query($sql4);
    $d4 = $r4->fetch_assoc();
    $numarticulos = $d4['COUNT(*)'];
    return $numarticulos;
}

function obtenerarticulosenalta(){
    $conexion = conectar();
    $sql5 = "SELECT COUNT(*) FROM articulos WHERE estado LIKE 'alta'";
    $r5 = $conexion->query($sql5);
    $d5 = $r5->fetch_assoc();
    $numarticulosalta = $d5['COUNT(*)'];
    return $numarticulosalta;
}

function obtenerarticulosenbaja(){
    $conexion = conectar();
    $sql6 = "SELECT COUNT(*) FROM articulos WHERE estado LIKE 'baja'";
    $r6 = $conexion->query($sql6);
    $d6 = $r6->fetch_assoc();
    $numarticulosalta = $d6['COUNT(*)'];
    return $numarticulosalta;
}

function getStocktotal(){
    $conexion = conectar();
    $sql6 = "SELECT SUM(stock) FROM articulos WHERE estado LIKE 'alta'";
    $r6 = $conexion->query($sql6);
    $d6 = $r6->fetch_assoc();
    $numarticulosalta = $d6['SUM(stock)'];
    return $numarticulosalta;
}

function getValoraciones($id_articulo)
{
    $sql = "SELECT * FROM valoraciones WHERE id_articulo = $id_articulo";
    $conexion = conectar();
    $res = $conexion->query($sql);
    $datos = [];

    while ($data = $res->fetch_assoc()) {
        $datos[] = $data;
    }
    return $datos;
}

function getValoracionMedia($id_articulo){
    $conexion = conectar();
    $sql = "SELECT AVG(valoracion) FROM valoraciones WHERE id_articulo = $id_articulo";
    $r6 = $conexion->query($sql);
    $d6 = $r6->fetch_assoc();
    $valoracion = $d6['AVG(valoracion)'];
    return $valoracion;
}


