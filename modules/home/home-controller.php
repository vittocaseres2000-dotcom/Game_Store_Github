<?php
/*Trabajo_GrupalWeb/modules/home/home-controller.php*/

require_once("../../config/conexion.php");

require_once("home-model.php");

$productos = obtenerProductos($conn);

?>