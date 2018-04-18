<?php
include_once "funciones.php";
session_start();
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
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
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

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 20%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
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


<form action="login.php" method="post">
    <div class="imgcontainer">
        <img src="media/trophy.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Usuario</b></label>
        <input type="text" placeholder="Enter Username" name="uname" id="uname" required>

        <label for="psw"><b>Contraseña</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <button type="submit">Iniciar Sesión</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="goBack()" class="cancelbtn">Volver</button>
        <span class="psw">¿No tienes cuenta? <a href="register.php">Registrate aquí</a></span>
    </div>
</form>

</body>
</html>

<?php

if(isset($_POST['uname']) && isset($_POST['psw'])){
    $conexion = conectar();

    if(logincorrecto($_POST['uname'],$_POST['psw']) == true){
        header('location:welcome.php?user='.$_POST['uname']);
        $_SESSION['usuario'] = $_POST['uname'];
    }
}