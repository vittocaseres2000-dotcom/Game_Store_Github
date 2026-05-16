<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "gamestore";

$port = 3307;

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database,
    $port
);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>