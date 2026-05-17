<?php

$host = "127.0.0.1";

$user = "root";

$password = "";

$database = "gamestore";

$port = 3307;

/* =========================
   CONEXIÓN MYSQL
========================= */

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database,
    $port
);

/* =========================
   VALIDAR CONEXIÓN
========================= */

if(!$conn){

    die(
        "Error de conexión: "
        . mysqli_connect_error()
    );

}

/* =========================
   UTF8
========================= */

mysqli_set_charset(
    $conn,
    "utf8"
);