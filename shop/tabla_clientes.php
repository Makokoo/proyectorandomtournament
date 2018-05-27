<?php
# conectare la base de datos

include_once 'funciones.php';
$con = conectar();

if(!$con){
die("imposible conectarse: ".mysqli_error($con));
}
if (@mysqli_connect_errno()) {
die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax') {
    include 'pagination.php'; //incluir el archivo de paginación
//las variables de paginación
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 8; //la cantidad de registros que desea mostrar
    $adjacents = 4; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
//Cuenta el número total de filas de la tabla*/
    $count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM articulos WHERE estado LIKE 'alta' ");
    if ($row = mysqli_fetch_array($count_query)) {
        $numrows = $row['numrows'];
    }
    $total_pages = ceil($numrows / $per_page);
    $reload = 'index.php';
//consulta principal para recuperar los datos
    $query = mysqli_query($con, "SELECT * FROM articulos WHERE estado LIKE 'alta'  order by cod_articulo LIMIT $offset,$per_page");


    if ($numrows > 0) {
        ?>
        <table class="table table-bordered text-center">

            <tbody>
            <?php
            $mostrar = "";
            while ($row = mysqli_fetch_array($query)) {
                $mostrar .= "<link href=\"bootstrap.css\" rel=\"stylesheet\">
            <div class='border center-block hoover' style='float:left;padding:19px;'>";

                $nombre_fichero = "imagenes/" . $row['cod_articulo'] . ".png";
                if (file_exists($nombre_fichero)) {
                    $mostrar .= "<img src=" . $nombre_fichero . " width='265px' height='150px'>";
                } else {
                    $mostrar .= "<img src=" . $row['imagen'] . " width='265px' height='150px'>";
                }

                $mostrar .= "<div class='info'>
                    <h4 style='padding-left: 10px'>" . $row['nombre_articulo'] . "</h4>
                    <span class=\"description\" style='padding-left: 10px'>
                        " . $row['descripcion_articulo'] . "
                    </span>
                    </br>
                    <span class='h2' style='padding-left: 10px'>" . $row['precio'] . "€</span>
                    <a class='btn btn-info' style='float: right;margin: 20px' href='verproducto.php?codarticulo=" . $row['cod_articulo'] . "'><i></i>Ver Producto</a>
                </div>
            </div>
        
    ";

            }
            echo $mostrar;
            ?>
            </tbody>
        </table>
        <div class="table-pagination pull-right">
            <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
        </div>

        <?php

    } else {
        ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>Aviso!!!</h4> No hay datos para mostrar
        </div>
        <?php

    }
}