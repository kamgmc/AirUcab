<?php 
session_start(); 
include "conexion.php"; 
date_default_timezone_set('America/Port_of_Spain'); 
if($_SESSION['code']=="9d5e3ecdeb4cdb7acfd63075ae046672"){session_unset(); session_destroy();} 
header("location:modeloavion.php");
?>