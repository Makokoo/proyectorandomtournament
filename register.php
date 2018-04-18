<?php
include_once "funciones.php";
session_start();

$nameErr = "";
$emailErr = "";
$passErr = "";
$name = "";
$email = "";

if(isset($_POST['register'])){

    $bien = true;
    //compruebo si existe el nombre en la base de datos
    if(existenick($_POST['uname']) == true){
        $nameErr = "Ya existe una cuenta con ese nombre de usuario";
        $name = $_POST['uname'];
        $bien = false;
    }else if($_POST['uname'] == ""){
        $nameErr = "Campo requerido";
        $bien = false;
    }

    //compruebo si existe el mail
    if(existemail($_POST['email']) == true){
        $emailErr = "Ya hay una cuenta asociada a ese e-mail";
        $email = $_POST['email'];
        $bien = false;
    }else if($_POST['email'] == ""){
        $emailErr = "Campo requerido";
        $bien = false;
    }

    if($_POST['psw'] != $_POST['psw2']){
        $passErr = "Las contraseñas no coinciden";
        $bien = false;
    }else if($_POST['psw'] == "" ||  $_POST['psw2'] == ""){
        $passErr = "Campo requerido";
    }

    if($bien){
        registrarusuario($_POST['uname'], $_POST['psw'], $_POST['email']);
    }
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }


            input[type=text], input[type=password], input[type=email] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            button, input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
            }

            button:hover {
                opacity: 0.8;
            }

            .cancelbtn {
                width: auto;
                padding: 10px 18px;
                background-color: #f44336;
            }

            .msgerror{
                color: #990000;
            }

            .imgcontainer {
                text-align: center;
                margin: 24px 0 12px 0;
            }

            img.avatar {
                width: 20%;
                border-radius: 50%;
            }

            .container {

            }

            span.psw {
                float: right;
                padding-top: 16px;
            }

            /* Change styles for span and cancel button on extra small screens */
            @media screen and (max-width: 300px) {
                span.psw {
                    display: block;
                    float: none;
                }
                .cancelbtn {
                    width: 100%;
                }
            }
        </style>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>

    </head>
    <body>



        <div class="imgcontainer">
            <img src="media/trophy.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">

            <form method="post" action="register.php">
                <label for="uname"><b>Usuario</b></label>
                <input type="text" name="uname" value="<?php echo $name;?>">
                * <span class="msgerror"><?php echo $nameErr;?></span>
                <br><br>
                <label for="psw"><b>E-Mail</b></label>
                <input type="text" name="email" value="<?php echo $email;?>">
                * <span class="msgerror"><?php echo $emailErr;?></span>
                <br><br>
                <label for="psw"><b>Contraseña</b></label>
                <input type="password" name="psw" id="psw">
                * <span class="msgerror"><?php echo $passErr;?></span>
                <br><br>
                <label for="psw"><b>Vuelva a repetir la Contraseña</b></label>
                <input type="password" name="psw2" id="psw2">
                * <span class="msgerror"><?php echo $passErr;?></span>
                <input type="submit" class='btn btn-info' name="register" id="register" value="REGISTRAR">

            </form>




        </div>















        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="goBack()" class="cancelbtn">Volver</button>
            <span class="psw">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></span>
        </div>
    </form>

    </body>
    </html>

