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

    if($_POST['psw'] != "" && $_POST['ps2'] != "") {
        if ($_POST['psw'] != $_POST['psw2']) {
            $passErr = "Las contraseñas no coinciden";
            $bien = false;
        } else if ($_POST['psw'] == "" || $_POST['psw2'] == "") {
            $passErr = "Campo requerido";
        }
    }

    if($bien){
        if($nuevapass == false) {
            if (modificarusuario(getid($_SESSION['usuario']), $_POST['uname'], $_POST['mail'], $_POST['psw']) == true) {
                $msgfinal = "Se han modificado los datos correctamente";
                $_SESSION['usuario'] = $_POST['uname'];
                header( "Refresh:1; url='profile.php'");
            } else {
                $msgfinal = "Ha ocurrido un error.";
            }
        }else{
            if(modificarsinpass($datos_usuario['id_usuario'], $_POST['uname'], $_POST['mail']) == true){
                $msgfinal = "Se han modificado los datos correctamente";
                $_SESSION['usuario'] = $_POST['uname'];
                header( "Refresh:1; url='profile.php'");
            }else{
                $msgfinal = "Ha ocurrido un error.";
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Random Tournament</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 890px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            background-color: #555;
            text-align: center;
        }

        .msgerror{
            color: #990000;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-tower"></span></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Torneos</a></li>
                <li><a href="#">Tienda</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>

            <?php
            if(!isset($_SESSION['usuario'])) {
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><button onclick="location.href = 'login.php'" class="btn" style="width:auto;"><span class="glyphicon glyphicon-log-in text-right"></span> Iniciar Sesión</button>/li>
                </ul>
                <?php
            }else{
                ?>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>
</nav>


<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p><a href="#">Link</a></p>
            <p><a href="#">Link</a></p>
            <p><a href="#">Link</a></p>
        </div>

        <div class="col-sm-8 text-left">
            <h1>Hola <?=$datos_usuario['username']?></h1>
            <hr>
            <h3 class="text-center">Datos usuario</h3>

            <form method="post" action="modprofile.php">
                <table class="table text-center">
                    <td>Nombre de usuario:</td>
                    <td><input value="<?= $datos_usuario['username'] ?>" name="uname" id="uname"><span class="msgerror"><?php echo $nameErr;?></span></td>
                    </tr>
                    <tr>
                        <td>E-Mail:</td>
                        <td><input value="<?= $datos_usuario['mail'] ?>" name="mail" id="mail"><span class="msgerror"><?php echo $emailErr;?></span></td>
                    </tr>
                    <tr>
                        <td>Nueva Contraseña:</td>
                        <td><input type="password" name="psw" id="psw">*<span class="msgerror"><?php echo $passErr;?></span></td>
                    </tr>
                    <tr>
                        <td>Repetir Contraseña:</td>
                        <td><input type="password" name="psw2" id="psw2">*<span class="msgerror"><?php echo $passErr;?></span></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="modprofile.php">
                                <button type="button" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-pencil"></span> Cancelar
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

        <div class="col-sm-2 sidenav">
            <div class="well">
                <p>ADS</p>
            </div>
            <div class="well">
                <p>ADS</p>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

</body>
</html>