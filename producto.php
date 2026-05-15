<?php
include '../config/conexion.php';
session_start();

$id_usuario = $_SESSION['id_usuario'];
$id_producto = $_GET['id'];

// evitar duplicados
$check = $conexion->prepare("
    SELECT * FROM favorito 
    WHERE id_usuario = ? AND id_producto = ?
");

$check->bind_param("ii", $id_usuario, $id_producto);
$check->execute();

$result = $check->get_result();

if ($result->num_rows == 0) {

    $sql = "INSERT INTO favorito(id_usuario, id_producto)
            VALUES (?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();

}

header("Location: productos.php");
exit();
?>