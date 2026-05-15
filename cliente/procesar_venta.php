<?php

include '../config/conexion.php';
session_start();

$id_usuario = $_SESSION['id_usuario'];
$carrito = $_SESSION['carrito'];

$total = 0;

foreach($carrito as $item){
    $total += $item['precio'] * $item['cantidad'];
}

$sql = "INSERT INTO venta(id_usuario, total) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("id", $id_usuario, $total);
$stmt->execute();

$id_venta = $conexion->insert_id;

foreach($carrito as $item){

    $subtotal = $item['precio'] * $item['cantidad'];

    $sqlDetalle = "INSERT INTO detalle_venta
    (id_venta, id_producto, cantidad, subtotal)
    VALUES (?, ?, ?, ?)";

    $stmt2 = $conexion->prepare($sqlDetalle);

    $stmt2->bind_param(
        "iiid",
        $id_venta,
        $item['id_producto'],
        $item['cantidad'],
        $subtotal
    );

    $stmt2->execute();
}

unset($_SESSION['carrito']);

header("Location: compras.php");
exit();

?>