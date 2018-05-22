<?php
include_once "funciones.php";
session_start();

$nameErr = "";
$emailErr = "";
$passErr = "";
$name = "";
$email = "";
$bien = true;
$registrado = false;
if(isset($_POST['register'])){
    
    //compruebo si existe el nombre en la base de datos
    if(existenick($_POST['uname']) == true){
        $nameErr = "  -  Ya existe una cuenta con ese nombre de usuario";
        $name = $_POST['uname'];
        $bien = false;
        $registrado == true;
    }else if($_POST['uname'] == ""){
        $nameErr = "  -  Campo requerido";
        $bien = false;
        $registrado == true;
    }

    //compruebo si existe el mail
    if(existemail($_POST['email']) == true){
        $emailErr = "  -  Ya hay una cuenta asociada a ese e-mail";
        $email = $_POST['email'];
        $bien = false;
        $registrado == true;
    }else if($_POST['email'] == ""){
        $emailErr = "  -  Campo requerido";
        $bien = false;
        $registrado == true;
    }

    if($_POST['psw'] != $_POST['psw2']){
        $passErr = "  -  Las contraseñas no coinciden";
        $bien = false;
        $registrado == true;
    }else if($_POST['psw'] == "" ||  $_POST['psw2'] == ""){
        $passErr = "  -  Campo requerido";
        $registrado == true;
    }

    if($bien){
        
        registrarusuario($_POST['uname'], $_POST['psw'], $_POST['email']);
        $nameErr = "<label style='color:green'>Cuenta creada correctamente</label>";
        //echo "<script>document.getElementById('formulario').style.display = 'none';</script>";
        //echo "<h3 class='text-center' style='color:darkgreen'>Cuenta creada correctamente</h2><br>";
        //header( "Refresh:3; url='login.php'");



        ?>



        <!doctype html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, maximum-scale=1">

            <title>RandomTournaments</title>
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
            <header class="header" id="header">
                <!--header-start-->
                <div class="container">
                    <figure class="logo animated fadeInDown delay-07s">
                        <img src="img/logo.png" alt="">
                    </figure>
                    <h1 class="animated fadeInDown delay-07s">Cuenta creada correctamente</h1>
                    <ul class='we-create animated fadeInUp delay-07s'>
                        <li>Bienvenido a la competición</li>
                    </ul>
                </div>
            </header>
            <!--header-end-->

        </body>

        </html>



        <?php
        header( "Refresh:3; url='login.php'");
    }else{
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
<header class="header" id="header">
    <!--header-start-->
    <div class="container">
        <figure class="logo animated fadeInDown delay-07s">
            <img src="img/logo.png" alt="">
        </figure>
        <h1 class="animated fadeInDown delay-07s">Bienvenido a RandomTournaments</h1>
        <form action="register.php" method="post">
            <div class="container animated fadeInLeft delay-06s" id='formulario'>
                <label for="uname"><b>Usuario</b></label><label style="color:red"><?=$nameErr?></label>
                <input type="text" class="form-control input-text" placeholder="Nombre de Usuario" name="uname" id="uname" required>
                <br>
                <label for="email"><b>E-Mail</b></label><label style="color:red"><?=$emailErr?></label>
                <input type="text" class="form-control input-text" placeholder="E-Mail" name="email" id="email" required>
                <br>
                <label for="psw"><b>Contraseña</b></label><label style="color:red"><?=$passErr?></label>
                <input type="password" class="form-control input-text" placeholder="Contraseña" name="psw" id="psw" required>
                <br>
                <label for="psw"><b>Repite Contraseña</b></label>
                <input type="password" class="form-control input-text" placeholder="Repita su Contraseña" name="psw2" id="psw2" required>

                <input class="link animated fadeInUp delay-1s" name="register" id="register" type="submit" value="Registrar">
            </div>


                
                <span class="psw" class="link animated fadeInUp delay-1s ">
                    <label class="animated fadeInUp delay-1s">Ya tienes cuenta?</label> 
                    <a href="login.php" class="animated fadeInUp delay-1s">Inicia sesión aquí</a>
                </span>

        </form>
    </div>
</header>
<!--header-end-->




</body>

</html>


        <?php
    }
}

else {

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">

    <title>RandomTournaments</title>
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
<header class="header" id="header">
    <!--header-start-->
    <div class="container">
        <figure class="logo animated fadeInDown delay-07s">
            <img src="img/logo.png" alt="">
        </figure>
        <h1 class="animated fadeInDown delay-07s">Bienvenido a RandomTournaments</h1>
        <form action="register.php" method="post">
            <div class="container animated fadeInLeft delay-06s" id='formulario'>
                <label for="uname"><b>Usuario</b></label><label style="color:red"><?=$nameErr?></label>
                <input type="text" class="form-control input-text" placeholder="Nombre de Usuario" name="uname" id="uname" required>
                <br>
                <label for="email"><b>E-Mail</b></label><label style="color:red"><?=$emailErr?></label>
                <input type="text" class="form-control input-text" placeholder="E-Mail" name="email" id="email" required>
                <br>
                <label for="psw"><b>Contraseña</b></label><label style="color:red"><?=$passErr?></label>
                <input type="password" class="form-control input-text" placeholder="Contraseña" name="psw" id="psw" required>
                <br>
                <label for="psw"><b>Repite Contraseña</b></label>
                <input type="password" class="form-control input-text" placeholder="Repita su Contraseña" name="psw2" id="psw2" required>

                <input class="link animated fadeInUp delay-1s" name="register" id="register" type="submit" value="Registrar">
            </div>


                
                <span class="psw" class="link animated fadeInUp delay-1s ">
                    <label class="animated fadeInUp delay-1s">Ya tienes cuenta?</label> 
                    <a href="login.php" class="animated fadeInUp delay-1s">Inicia sesión aquí</a>
                </span>

        </form>
    </div>
</header>
<!--header-end-->




</body>

</html>

<?php
}