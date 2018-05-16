<?php
session_start();
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1">

	<title>Homepage</title>
	<link rel="icon" href="favicon.png" type="image/png">
	<link rel="shortcut icon" href="favicon.ico" type="img/x-icon">

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="css/responsive.css" rel="stylesheet" type="text/css">
	<link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" type="text/css">


</head>

<body>


	<nav class="main-nav-outer" id="test">
		<!--main-nav-start-->
		<div class="container">
			<ul class="main-nav">
                <li><a href="home.php">INICIO</a></li>
				<li><a href="tournaments.php">TORNEOS</a></li>
                <li><a href="tienda/shop.php">TIENDA</a></li>
				<li class="small-logo"><a href="home.php"><img src="img/small-logo.png" alt=""></a></li>
                <li><a href="quienessomos.php">QUIENES SOMOS</a></li>


                <?php
                if(!isset($_SESSION['usuario'])) {
                    ?>

                        <li><a href='login.php'>Iniciar Sesión</a></li>

                    <?php
                }else{
                    ?>

                    <li><a href="profile.php">Mi Perfil</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>

                    <?php
                }
                ?>
			</ul>

			<a class="res-nav_click" href="#"><i class="fa fa-bars"></i></a>
		</div>
	</nav>




	<!--c-logo-part-end-->
	<section class="main-section team" id="team">
		<!--main-section team-start-->
		<div class="container">
			<h2>team</h2>
			<h6>Take a closer look into our amazing team. We won’t bite.</h6>
			<div class="team-leader-block clearfix">


				<div class="team-leader-box">
					<div class="team-leader wow fadeInDown delay-03s">
						<div class="team-leader-shadow"><a href="tdetails.php?id=8"></a></div>
						<img src="img/dbz.png" alt="">
					</div>
					<h3 class="wow fadeInDown delay-03s">TORNEO INAUGURACIÓN</h3>
					<span class="wow fadeInDown delay-03s">Dragon Ball FighterZ</span>
					<p class="wow fadeInDown delay-03s">Abiertas las inscripciones para el torneo de inauguración de DBFZ</p>
				</div>


				<div class="team-leader-box">
					<div class="team-leader  wow fadeInDown delay-06s">
						<div class="team-leader-shadow"><a href="ranking.php"></a></div>
						<img src="img/rank.png" alt="">
					</div>
					<h3 class="wow fadeInDown delay-06s">RANKING</h3>
					<span class="wow fadeInDown delay-06s"></span>
					<p class="wow fadeInDown delay-06s"></p>
				</div>


				<div class="team-leader-box">
					<div class="team-leader wow fadeInDown delay-09s">
						<div class="team-leader-shadow"><a href="tienda/shop.php"></a></div>
						<img src="img/tienda.png" alt="">
					</div>
					<h3 class="wow fadeInDown delay-09s">INAUGURAMOS NUESTRA TIENDA ONLINE</h3>
					<span class="wow fadeInDown delay-09s"></span>
					<p class="wow fadeInDown delay-09s">Ya puedes comprar el merchandising de nuestros juegos más populares</p>
				</div>


			</div>
		</div>
	</section>
	<!--main-section team-end-->




	<div class="c-logo-part">
		<!--c-logo-part-start-->
		<div class="container">
			<ul>
				<li><a href="#"><img src="img/c-liogo1.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo2.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo3.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo4.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo5.png" alt=""></a></li>
			</ul>
		</div>
	</div>




	<footer class="footer">
		<div class="container">
			<div class="footer-logo"><a href="#"><img src="img/footer-logo.png" alt=""></a></div>
			<span class="copyright">&copy; RandomTournament. All Rights Reserved</span>
			<div class="credits">
				<!--
All the links in the footer should remain intact.
You can delete the links only if you purchased the pro version.
Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Knight
        -->
				RandomTournament by Sergio Molina
</div>
		</div>
	</footer>



</body>

</html>
