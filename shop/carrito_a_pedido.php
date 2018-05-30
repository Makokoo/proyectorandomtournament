<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */

include_once 'header_tienda.php';


$cuenta = 0;
$datos_usuario['username'] = "";


?>


<div class="container">
    <div class="col col-lg-12">
        <section class="main-section">
            <div class="row">

                <?php
                if(isset($_SESSION['usuario'])) {
                    $datos_usuario = getDatosUsuario($_SESSION['usuario']);
                    $id_usuario = $datos_usuario['id_usuario'];
                    if(isset($_SESSION['carrito'])){

                        $carrito = $_SESSION['carrito'];
                        $lista = $carrito->getlista();
                        if(count($lista)>0) {
                            $conexion = conectar();
                            $conexion->begin_transaction();

                            $insertpedido = "INSERT INTO pedidos (cod_cliente,fecha,estado) VALUES ($id_usuario,CURDATE(),'procesando')";
                            $conexion->query($insertpedido);
                            $cod_pedido = $conexion->insert_id;
                            if($conexion->affected_rows > 0) {
                                $contador = 0;

                                foreach ($lista as $clave => $valor) {
                                    if(restarStock($clave,$valor) == true) {
                                        $datos = sacardatoarticulo($clave, $conexion);
                                        $contador++;
                                        $insert = "INSERT INTO lineas_pedidos (num_linea_pedido,cod_pedido,cod_articulo,cantidad,estado) VALUES ($contador,$cod_pedido,$clave,$valor,'pedido')";

                                        $res = $conexion->query($insert);
                                    }

                                }
                                $conexion->commit();
                                $carrito->vaciarCarrito();
                                echo "<h2>¡Muchas gracias por tu compra!</h2>";

                            }else{
                                echo "<h2>Ops, ha habido un error.</h2>";
                                $conexion->rollback();
                            }

                        }else{
                            echo "<h2>Ops, tu carrito está vacio.</h2>";
                        }

                    }else{
                        echo "<h2>Ops, tu carrito está vacio.</h2>";
                    }
                }else{
                    echo "<h2>Debes iniciar sesión para entrar aquí.</h2>";
                }
                ?>


            </div>
        </section>
    </div>
</div>



<?php
include_once '../footer.php';

?>
