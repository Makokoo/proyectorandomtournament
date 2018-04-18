<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 16/04/2018
 * Time: 21:26
 */

if(isset($_GET['user'])){
    echo "Bienvenido ".$_GET['user'];
    header( "Refresh:3; url='index.php'");
}