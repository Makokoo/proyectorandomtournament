<?php
include_once '../funciones.php';
include_once '../shop/funciones.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Panel Administración</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      
      <!--logo start-->
      <a href="index.php" class="logo"><img src='../img/logo.png' style='height: 35px'>&nbsp;RANDOM TOURNAMENTS - <span class="lite">Panel de Administración</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>

          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <?php

          $datos_usuario = getDatosUsuario($_SESSION['usuario']);
          $avatar = "../img/default-avatar.png";
          if (!$datos_usuario['avatar'] == null || !$datos_usuario['avatar'] == "") {

            $avatar = "../avatar/" . $datos_usuario['id_usuario'] . ".png";
          }
          ?>



          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="profile-ava">
                <img alt="" style="height:  35px;" src="<?=$avatar?>">
              </span>
              
              <span class="username"><?=$datos_usuario['username']?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li>
                <a href="../logout.php"><i class="icon_key_alt"></i> Cerrar Sesión</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->
        <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li>
            <a class="" href="index.php">
              <i class="icon_house_alt"></i>
              <span>INICIO</span>
            </a>
          </li>
          <?php
          if(isset($_SESSION['usuario']) && getPermiso($_SESSION['usuario']) == 2){
            ?>
          <li>
            <a href="gestion_clientes.php">
              <i class="icon_profile"></i>
              <span>USUARIOS</span>

            </a>
          </li>
        <?php
        }
        ?>
          <li>
            <a href="tournaments_admin.php">
              <i class="icon_desktop"></i>
              <span>TORNEOS</span>

            </a>
          </li>
          <li>
            <a href="shop_admin.php">
              <i class="icon_gift_alt"></i>
              <span>TIENDA</span>
            </a>
          </li>
          <li>
            <a href="solicitudes_contacto.php">
              <i class="icon_document_alt"></i>
              <span>CONTACTO</span>
            </a>
          </li>
          <li>
            <a href="stats_admin.php">
              <i class="icon_piechart"></i>
              <span>ESTADISTICAS</span>

            </a>
          </li>
          <li>
            <a href="../home.php">
              <i class="icon_arrow"></i>
              <span>VOLVER a RT(Home)</span>

            </a>

          </li>



        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->