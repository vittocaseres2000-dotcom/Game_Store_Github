<?php

$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "gamestore";
$puerto = 3307;

$conexion = new mysqli(
    $host,
    $usuario,
    $password,
    $base_datos,
    $puerto
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>