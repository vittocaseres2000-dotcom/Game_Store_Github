<?php
include 'verificar_admin.php';
include '../config/conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM producto WHERE id_producto=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: productos.php");
exit();
?>