<?php
include_once 'funciones.php';
include_once 'Carrito.php';
include_once  'Producto.php';
include_once 'header_tienda.php';
?>
    <script>
        function eliminar(codigo) {

            window.location.href = 'quitardelcarrito.php?id='+codigo;

            }

    </script>
<div class="container">
    <div class="row">
        <div class="col-md-12">

        <?php

            if (isset($_SESSION['usuario'])) {

                $usuario = $_SESSION['usuario'];
                $invitado = false;


                if (!isset($_SESSION["carrito"])) {
                    $_SESSION["carrito"] = new Carrito($usuario);
                }

                $carrito = $_SESSION['carrito'];

                    $lista = $carrito->getlista();
                if (count($lista) > 0) {
                    echo "<br>";
                    echo "<h2>CARRITO</h2>";
                    $conexion = conectar();
                    $total = 0;
                    echo "";
                    echo "<table class='table text-center'>";
                    foreach ($lista as $clave => $valor) {
                        $datos = sacardatoarticulo($clave, $conexion);
                        $imagen = $datos['imagen'];
                        echo "<tr><td><img src='$imagen' style='max-height: 30px'></td><td><a style='color:black;' href='verproducto.php?codarticulo=$clave'>" . $datos['nombre_articulo'] . " (" . $datos['precio'] . "€)</a></td><td>x" . $valor . "</td>";
                        echo "<td><a href='javascript:eliminar($clave)'><span class='fa fa-trash'></span></a></td></tr>";
                        $total = $total + ($datos['precio'] * $valor);
                    }
                    echo "</table>";
                    echo "<hr>";
                    echo "<table class='table-bordered text-right' style='float:right'><tr><td><b>TOTAL: </b>" . $total . "€</td></tr>";
                    echo "</table>";

                    echo "<br>";
                    echo "<br>";


                echo "<div class='row text-center'>
                        <div class='col-md-6 wow fadeInUp delay-05s'>

                          <a href='vaciar_carrito.php'><button class='btn btn-danger'>Vaciar carrito</button></a>


                        </div>

                        <div class='col-md-6 wow fadeInUp delay-05s'>
                        <a href='carrito_a_pedido.php'><button style='margin-bottom: 150px;' class='btn btn-success'>Finalizar Compra</button></a>
                        </div></div>";
                }else{

                    echo "<h2 style='margin: 250px;;' class='text-center'>Ops, tu carrito está vacio.</h2>";

                }
            }

?>

</div>
    </div>
</div>
    <?php

            include_once 'footer_tienda.php';
            ?>