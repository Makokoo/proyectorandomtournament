
<?php
include_once 'funciones.php';
include_once 'Carrito.php';
include_once 'Producto.php';
include_once 'header_tienda.php';
?>

            <?php
if(isset($_POST['id_articulo'])) {
    $cliente = $_SESSION['usuario'];
    $cantidad = $_POST['cantidad'];
    $cod = $_POST['id_articulo'];
    $_SESSION['usuario'] = $cliente;


    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = new Carrito($cliente);
    }

    $carrito = $_SESSION['carrito'];

    $conexion = conectar();
    $sql = "SELECT * FROM articulos WHERE cod_articulo LIKE '$cod'";


    $res = $conexion->query($sql);

    $linea = $res->fetch_row();
    /*
    0 -> cod_articulo
    1 -> nombre_articulo
    2 -> descripcion_articulo
    3 -> imagen
    4 -> precio
    */

    $articulo = new Producto($linea[0], $linea[1], $linea[4]);

    $carrito->addProducto($cod,$cantidad);
    echo "<div class=\"container\" style='margin: 250px'>";
    echo "<h2 class='text-center'>El Artículo se ha añadido correctamente</h2>";
    echo "</div>";
    header("Refresh:3; url='ver_carrito.php?'");


    //header("refresh:1; url=ver_carrito.php?cliente=$cliente");
    ?>
    </div>
    </div>


    <?php
}else{
    echo "<div class=\"container\" style='margin: 250px'>";
    echo "<h2 class='text-center'>Debes seleccionar articulo</h2>";
    echo "</div>";
    header("Refresh:3; url='index.php'");
}
include_once 'footer_tienda.php';