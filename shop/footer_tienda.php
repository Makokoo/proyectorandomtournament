<div class="c-logo-part">
		<!--c-logo-part-start-->
		<div class="container">
            <?php
		/*
				<ul>
				<li><a href="#"><img src="img/c-liogo1.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo2.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo3.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo4.png" alt=""></a></li>
				<li><a href="#"><img src="img/c-liogo5.png" alt=""></a></li>
			</ul>
		*/
?>
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
				<?php
				include_once 'funciones.php';
				if(isset($_SESSION['usuario'])){
					if(getPermiso($_SESSION['usuario']) == 2){
						echo "<p><a href='../admin/index.php'>Panel de administración</a></p>";
					}
				}
				?>
</div>
		</div>
	</footer>



</body>

</html>
