<?php
include_once('funciones.php');
include_once('header.php');

if(!isset($_POST['name'])){
	$msg = "";
}else{
	$nombre = $_POST['name'];
	$mail = $_POST['email'];
	$asunto = $_POST['subject'];
	$mensaje = htmlspecialchars($_POST['message']);

	$msg = "HOLA";


}

?>



<section class="main-section" id="service">
		<!--main-section-start-->
		<div class="container">
			<h2>RANDOM TOURNAMENTS</h2>
			<h6>Ofrecemos diversión con randomizador</h6>
			<div class="row">
				<div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s">
					<div class="service-list">
						<div class="service-list-col1">
							<i class="fa fa-diamond"></i>
						</div>
						<div class="service-list-col2">
							<h3>COMPITE Y GANA</h3>
							<p>Inscríbete en nuestros torneos y demuestra que eres el mejor.</p>
						</div>
					</div>
					<div class="service-list">
						<div class="service-list-col1">
							<i class="fa fa-forumbee"></i>
						</div>
						<div class="service-list-col2">
							<h3>Foros oficiales</h3>
							<p>Podrás comunicarte con los demás miembros de RT en nuestros foros oficiales.</p>
						</div>
					</div>
					<div class="service-list">
						<div class="service-list-col1">
							<i class="fa fa-mobile-phone"></i>
						</div>
						<div class="service-list-col2">
							<h3>Interfaz para smartphone</h3>
							<p>Podrás usar RT en tu dispositivo móvil sin ningún problema.</p>
						</div>
					</div>
					<div class="service-list">
						<div class="service-list-col1">
							<i class="fa fa-medkit"></i>
						</div>
						<div class="service-list-col2">
							<h3>Soporte 24H</h3>
							<p>Podrás jugar siempre que quieras</p>
						</div>
					</div>
				</div>
				<figure class="col-lg-8 col-sm-6  text-right wow fadeInUp delay-02s">
					<img src="img/macbook-pro.png" alt="">
				</figure>

			</div>
		</div>
	</section>
	<!--main-section-end-->



<!--business-talking-end-->
	<div class="container">
		<section class="main-section contact" id="contact">

			<div class="row">
				<div class="col-lg-6 col-sm-7 wow fadeInLeft">
					<div class="contact-info-box address clearfix">
						<h3><i class=" icon-map-marker"></i>Dirección:</h3>
						<span>Carrer Illueca, 28<br>03206 Elx, Alacant</span>
					</div>
					<div class="contact-info-box phone clearfix">
						<h3><i class="fa fa-phone"></i>Tlf:</h3>
						<span>966 666 666</span>
					</div>
					<div class="contact-info-box email clearfix">
						<h3><i class="fa fa-pencil"></i>E-MAIL:</h3>
						<span>hello@randomt.com</span>
					</div>
					<div class="contact-info-box hours clearfix">
						<h3><i class="fa fa-clock-o"></i>HORARIO:</h3>
						<span>Soporte 24/7</span>
					</div>
					<ul class="social-link">
						<li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
						<li class="gplus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
					</ul>
				</div>
				<h3 class='text-center'>Formulario de contacto</h3>
				<div class="col-lg-6 col-sm-5 wow fadeInUp delay-05s">
					<div class="form">

						<div id="sendmessage" class='success'><?=$msg?></div>
						<div id="errormessage"></div>
						<form action="quienessomos.php" method="post" role="form" class="contactForm">
							<div class="form-group">
								<input type="text" name="name" class="form-control input-text" id="name" required placeholder="Nombre" />
								<div class="validation"></div>
							</div>
							<div class="form-group">
								<input type="email" class="form-control input-text" name="email" id="email" required placeholder="E-mail"/>
								<div class="validation"></div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control input-text" name="subject" id="subject" required placeholder="Asunto"/>
								<div class="validation"></div>
							</div>
							<div class="form-group">
								<textarea class="form-control input-text text-area" name="message" id="message" rows="5" data-rule="required" placeholder="Por favor escribenos aquí tu mensaje">
								</textarea>
								<div class="validation"></div>
							</div>

							<div class="text-center"><button type="submit" class="input-btn">Enviar Mensaje</button></div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>






<?php

include_once('footer.php');
