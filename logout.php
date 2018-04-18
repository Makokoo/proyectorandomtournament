<?php
/**
 * Created by PhpStorm.
 * User: MoLy
 * Date: 02/04/2018
 * Time: 9:59
 */
session_start();
session_destroy();
header('location:index.php');