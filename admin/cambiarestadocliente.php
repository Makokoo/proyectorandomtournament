<?php
include_once '../funciones.php';
include_once '../tienda/funciones.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Creative - Bootstrap Admin Template</title>

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
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
    </div>

    <!--logo start-->
    <a href="index.html" class="logo">Nice <span class="lite">Admin</span></a>
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
      <li class="eborder-top">
        <a href="#"><i class="icon_profile"></i> Perfil</a>
    </li>
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
      <li class="active">
        <a class="" href="index.php">
          <i class="icon_house_alt"></i>
          <span>INICIO</span>
      </a>
  </li>
  <li>
    <a href="gestion_clientes.php">
      <i class="icon_document_alt"></i>
      <span>USUARIOS</span>

  </a>
</li>
<li>
    <a href="tournaments_admin.php">
      <i class="icon_desktop"></i>
      <span>TORNEOS</span>

  </a>
</li>
<li>
    <a href="shop_admin.php">
      <i class="icon_genius"></i>
      <span>TIENDA</span>
  </a>
</li>
<li>
    <a href="stats_admin.php">
      <i class="icon_piechart"></i>
      <span>ESTADISTICAS</span>

  </a>

</li>



</ul>
<!-- sidebar menu end-->
</div>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
  <section class="wrapper">


    <div class="row">



        <div class="col col-lg-8 style='float: none;margin-left: auto;margin-right: auto;'">
            <?php

            if(isset($_POST['cod'])){
                $codigo = $_POST['cod'];
                cambiarestadocliente($codigo);
                echo "El estado del cliente se ha actualizado correctamente";
                header('location:gestion_clientes.php');
            }else {

                echo "No hay codigo";

            }
            ?>
        </div>

        
    </div>

    <!-- statics end -->


    <div class="widget-foot">
      <!-- Footer goes here -->
  </div>
</div>
</div>

</div>

</div>
<!-- project team & activity end -->

</section>

</section>
<!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.4.min.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<!-- bootstrap -->
<script src="js/bootstrap.min.js"></script>


<!--custome script for all page-->
<script src="js/scripts.js"></script>
<!-- custom script for this page-->
<script src="js/sparkline-chart.js"></script>
<script src="js/easy-pie-chart.js"></script>
<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/xcharts.min.js"></script>
<script src="js/jquery.autosize.min.js"></script>
<script src="js/jquery.placeholder.min.js"></script>
<script src="js/gdp-data.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/sparklines.js"></script>
<script src="js/charts.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>

</body>

</html>
