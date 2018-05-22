<?php
include_once "funciones.php";
session_start();
$nameErr = "";
$passErr = "";

if(isset($_POST['uname']) && isset($_POST['psw'])){
    $conexion = conectar();

    if(logincorrecto($_POST['uname'],$_POST['psw']) == true){
        header('location:welcome.php?user='.$_POST['uname']);
        $_SESSION['usuario'] = $_POST['uname'];
    }else{
        $nameErr = "&nbsp;-  Error de credenciales";
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
        .container{

        }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</head>

<body>
<header class="header" id="header">
    <!--header-start-->
    <div class="container">
        <figure class="logo animated fadeInDown delay-07s">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </figure>
        <h1 class="animated fadeInDown delay-07s">Bienvenido a RandomTournaments</h1>
        <form action="login.php" method="post">
            <div class="container animated fadeInLeft delay-06s">
                <label for="uname"><b>Usuario</b></label><label for="uname" style="color:red"><b><?=$nameErr?></b></label>
                <input type="text" class="form-control input-text" placeholder="Enter Username" name="uname" id="uname" required>
                <br>
                <label for="psw"><b>Contraseña</b></label><label for="uname" style="color:red"><b><?=$passErr?></b></label>
                <input type="password" class="form-control input-text" placeholder="Enter Password" name="psw" id="psw" required>

                <button class="link animated fadeInUp delay-1s" type="submit">Iniciar Sesión</button>
            </div>


                <button type="button" onclick="goBack()" class="animated fadeInUp delay-1s">Volver</button>
                <span class="psw" class="link animated fadeInUp delay-1s ">
                    <label class="animated fadeInUp delay-1s">¿No tienes cuenta?</label> 
                    <a href="register.php" class="animated fadeInUp delay-1s">Registrate aquí</a>
                </span>

        </form>
    </div>
</header>
<!--header-end-->




</body>

</html>

