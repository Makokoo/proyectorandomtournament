<?php
# conectare la base de datos

include '../funciones.php';
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
    $per_page = 9; //la cantidad de registros que desea mostrar
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
                $mostrar .= "<div class='border center-block hoover' style='float:left;padding:45px;'>";
                $nombre_fichero = "../admin/imagenes/".$row['cod_articulo'].".png";
                $nombre_fichero_jpg = "../admin/imagenes/".$row['cod_articulo'].".jpg";
                if (file_exists($nombre_fichero)) {
                    $mostrar.="<img src=" . $nombre_fichero . " width='265px' height='150px'>";
                }else if(file_exists($nombre_fichero_jpg = "../admin/imagenes/".$row['cod_articulo'].".jpg")){
                    $mostrar.="<img src=" . $nombre_fichero_jpg . " width='265px' height='150px'>";
                } else  {
                    $mostrar.="<img src=" . $row['imagen'] . " width='265px' height='150px'>";
                }
                $mostrar.="<div class='info'>
                    <h3 style='padding-left: 10px'>" . $row['nombre_articulo'] . "</h3>
                    <span class=\"description\" style='padding-left: 10px'>";
                if(strlen($row['descripcion_articulo']) > 50){
                    for($i = 0 ; $i<35 ; $i++){
                        $mostrar.= $row['descripcion_articulo'][$i];
                    }
                    $mostrar.="...";
                }else{
                    $mostrar.= $row['descripcion_articulo'];
                }
                $mostrar.="</span>
                    </br>
                    <span class='h2' style='padding-left: 10px'>" . $row['precio'] . "€</span>
                    <a class='btn btn-success' style='float: right;margin: 20px' href=\"verproducto.php?codarticulo=" . $row['cod_articulo'] . "\"><i></i>Ver Producto</a>
                </div>
            </div>
        
    ";

            }
            echo $mostrar;
            ?>
            </tbody>
        </table>
        <div class="table-pagination text-center">
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