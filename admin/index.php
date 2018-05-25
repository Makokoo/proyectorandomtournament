<?php
include_once 'cabecera.php';
?>



    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">


        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <a href='gestion_clientes.php'>
              <div class="info-box blue-bg">
                <i class="icon_profile"></i>
                <div class="count"><?=getCantidadUsuarios();?></div>
                <div class="title">Usuarios</div>
              </div>
            </a>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <a href='gestion_articulos.php'>
              <div class="info-box brown-bg">
                <i class="fa fa-shopping-cart"></i>
                <div class="count"><?=obtenerarticulosvendidos();?></div>
                <div class="title">Nº items vendidos</div>
              </div>
            </a>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <a href='gestion_pedidos.php'>
              <div class="info-box dark-bg">
                <i class="fa fa-thumbs-o-up"></i>
                <div class="count"><?=obtenernumeropedidos();?></div>
                <div class="title">Nº Pedidos</div>
              </div>
            </a>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <a href='gestion_articulos.php'>
              <div class="info-box green-bg">
                <i class="fa fa-cubes"></i>
                <div class="count"><?=getStockTotal();?></div>
                <div class="title">Stock total</div>
              </div>
            </a>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        
        <?php
        include_once 'pie.php';
