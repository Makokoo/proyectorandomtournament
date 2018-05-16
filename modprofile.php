<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 18/04/2018
 * Time: 20:34
 */
include_once 'funciones.php';
session_start();

$datos_usuario['username'] = "";

if(isset($_SESSION['usuario'])) {
    $datos_usuario = getDatosUsuario($_SESSION['usuario']);
}


$nameErr = "";
$emailErr = "";
$passErr = "";
$name = "";
$email = "";
$msgfinal = "";

if(isset($_POST['modified'])){

    $bien = true;
    $nuevapass = false;
    //compruebo si existe el nombre en la base de datos
    if($_POST['uname'] != $datos_usuario['username']) {
        if (existenick($_POST['uname']) == true) {
            $nameErr = "Ya existe una cuenta con ese nombre de usuario";
            $name = $_POST['uname'];
            $bien = false;
        } else if ($_POST['uname'] == "") {
            $nameErr = "Campo requerido";
            $bien = false;
        }
    }

    //compruebo si existe el mail
    if($_POST['mail'] != $datos_usuario['mail']) {
        if (existemail($_POST['mail']) == true) {
            $emailErr = "Ya hay una cuenta asociada a ese e-mail";
            $email = $_POST['mail'];
            $bien = false;
        } else if ($_POST['mail'] == "") {
            $emailErr = "Campo requerido";
            $bien = false;
        }
    }

    if($_POST['passtoconfirm'] != ""){
          if($_POST['passtoconfirm'] != $datos_usuario['password']){
                $bien = false;
          }
     }

    if($_POST['psw'] != "" && $_POST['psw2'] != "") {
        if ($_POST['psw'] != $_POST['psw2']) {
            $passErr = "Las contraseñas no coinciden";
            $bien = false;
        } else if ($_POST['psw'] == "" || $_POST['psw2'] == "") {
            $passErr = "Campo requerido";
        } else if ($_POST['psw'] == $_POST['psw2']){
          $nuevapass = true;
          $bien = true;
        }
     }

    

    if($bien){
        if($nuevapass == true) {
            if (modificarusuario(getid($_SESSION['usuario']), $_POST['uname'], $_POST['mail'], $_POST['psw']) == true) {
                $msgfinal = "<span class='success'>Se han modificado los datos correctamente</span>";
                $_SESSION['usuario'] = $_POST['uname'];
                header( "Refresh:2; url='profile.php'");
            } else {
                $msgfinal = "Ha ocurrido un error.";
            }
        }else{
            if(modificarsinpass($datos_usuario['id_usuario'], $_POST['uname'], $_POST['mail']) == true){
                $msgfinal = "<span class='success'>Se han modificado los datos correctamente</span>";
                $_SESSION['usuario'] = $_POST['uname'];
                header( "Refresh:2; url='profile.php'");
            }else{
                $msgfinal = "Ha ocurrido un error.";
            }
        }
    }
}



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
    <style>

        .msgerror{
            color: #990000;
        }


    </style>
    <script type="text/javascript">
        window.onload = function() {
            var refButton = document.getElementById( 'uname' );
            var test = document.getElementById( 'passconfirm' );
            refButton.oninput = function() {
                test.style.visibility='visible';
            }
          }
    </script>
    
    
</head>

<body>


<nav class="main-nav-outer" id="test">
    <!--main-nav-start-->
    <div class="container">
        <ul class="main-nav">
            <li><a href="index.php">INICIO</a></li>
            <li><a href="tournaments.php">TORNEOS</a></li>
            <li><a href="quienessomos.php">TIENDA</a></li>
            <li class="small-logo"><a href="index.php"><img src="img/small-logo.png" alt=""></a></li>
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





<!--business-talking-end-->
<div class="container">
    <section class="main-section contact" id="contact">
        <div class="row">
            <h3 class="text-center">Modificando datos usuario</h3>
            
            <form method="post" action="modprofile.php">
                <table class="table text-center">
                    <td>Nombre de usuario:</td>
                    <td><input value="<?= $datos_usuario['username'] ?>"  name="uname" id="uname"><span class="msgerror"><?php echo $nameErr;?></span></td>
                    </tr>
                    <tr>
                        <td>E-Mail:</td>
                        <td><input value="<?= $datos_usuario['mail'] ?>"  name="mail" id="mail"><span class="msgerror"><?php echo $emailErr;?></span></td>
                    </tr>
                    <tr>
                        <td>Nueva Contraseña:</td>
                        <td><input type="password" name="psw" id="psw"><span class="msgerror"><?php echo $passErr;?></span></td>
                    </tr>
                    <tr>
                        <td>Repetir Contraseña:</td>
                        <td><input type="password" name="psw2" id="psw2"><span class="msgerror"><?php echo $passErr;?></span></td>
                    </tr>
                    <tr style="visibility: hidden;" class='animated fadeInDown delay-07s' id="passconfirm">
                        <td>Introduce tu contraseña para confirmar los cambios:</td>
                        <td><input type="password" name="passtoconfirm" id="passtoconfirm">*<span class="msgerror"><?php echo $passErr;?></span></td>
                    </tr>
                    <tr>                        
                        <td>
                            <a href="profile.php">
                                <button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span> Cancelar
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="modprofile.php">
                                <button type="submit" class="btn btn-success" id="modified" name="modified">
                                    <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                </button>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
            <span><?=$msgfinal?></span>

            <hr>

        </div>
    </section>
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
