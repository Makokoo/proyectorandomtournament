<?php
include_once './shop/Carrito.php';
include_once 'funciones.php';
include_once './shop/funciones.php';
session_start();
?>

<!doctype html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name='viewport' content='width=device-width, maximum-scale=1'>

	<title>RandomTournaments</title>
	<link rel='icon' href='favicon.png' type='image/png'>
	<link rel='shortcut icon' href='favicon.ico' type='img/x-icon'>

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

	<link href='css/bootstrap.css' rel='stylesheet' type='text/css'>
	<link href='css/style.css' rel='stylesheet' type='text/css'>
	<link href='css/font-awesome.css' rel='stylesheet' type='text/css'>
	<link href='css/responsive.css' rel='stylesheet' type='text/css'>
	<link href='css/magnific-popup.css' rel='stylesheet' type='text/css'>
	<link href='css/animate.css' rel='stylesheet' type='text/css'>


</head>

<body>


	<nav class='main-nav-outer' id='test'>
		<!--main-nav-start-->
		<div class='container'>
			<ul class='main-nav'>
				<li><a href='tournaments.php'>TORNEOS</a></li>
                <li><a href='forum.php'>FORO</a></li>
                <li><a href='./shop/index.php'>TIENDA</a></li>
				<li class='small-logo'><a href='home.php'><img src='img/small-logo.png' alt=''></a></li>
                <li><a href='quienessomos.php'>QUIENES SOMOS</a></li>


                <?php
                if(!isset($_SESSION['usuario'])) {
                    ?>

                    <li><a href='login.php'>Iniciar Sesión</a></li>

                    <?php
                }else{
                    ?>

                    <li><a href='profile.php'>Mi Perfil</a></li>
                    <li><a href='logout.php'>Cerrar Sesión</a></li>

                    <?php
                }

                $items = 0;
                if(isset($_SESSION['carrito'])) {
                    $lista = $_SESSION['carrito']->getlista();
                    $items = count($lista);

                    $total = 0;
                    if (count($lista) > 0) {

                        $conexion = conectar();


                        foreach ($lista as $clave => $valor) {
                            $datos = sacardatoarticulo($clave, $conexion);
                            $total = $total + ($datos['precio'] * $valor);
                        }

                    }
                }else{
                	$total = 0;
                }

                ?>
            </ul>

            <a class='res-nav_click' href='#'><i class='fa fa-bars'></i></a>
        </div>
        <div style="background-color: #7cc576;height: 25px;" class="text-right">
        	<?php
        	if(isset($_SESSION['usuario'])){
        		?>
            <a href="./shop/ver_carrito.php" style="margin: 5px;">
                <span style="color:black; margin: 5px;" class="fa fa-shopping-cart"></span>
                <span style="color: black; margin: 5px;">CARRITO(<?=$items?>) - TOTAL: <?=$total?>€</span>
            </a>
            <?php
        }
        ?>
        </div>
    </nav>
