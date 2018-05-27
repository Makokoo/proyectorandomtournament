<?php
session_start();
?>

<!doctype html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name='viewport' content='width=device-width, maximum-scale=1'>

	<title>RandomTournaments</title>
	<link rel='icon' href='../favicon.png' type='image/png'>
	<link rel='shortcut icon' href='../favicon.ico' type='img/x-icon'>

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
                <li><a href='../home.php'>INICIO</a></li>
				<li><a href='../tournaments.php'>TORNEOS</a></li>
                <li><a href='../forum.php'>FORO</a></li>
				<li class='small-logo'><a href='../home.php'><img src='img/small-logo.png' alt=''></a></li>
                <li><a href='../quienessomos.php'>QUIENES SOMOS</a></li>


                <?php
                if(!isset($_SESSION['usuario'])) {
                    ?>

                        <li><a href='../login.php'>Iniciar Sesión</a></li>

                    <?php
                }else{
                    ?>

                    <li><a href='../profile.php'>Mi Perfil</a></li>
                    <li><a href='../logout.php'>Cerrar Sesión</a></li>

                    <?php
                }
                ?>
			</ul>

			<a class='res-nav_click' href='#'><i class='fa fa-bars'></i></a>
		</div>
	</nav>
