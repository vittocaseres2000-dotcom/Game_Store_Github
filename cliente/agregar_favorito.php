<?php
include '../auth/verificar_sesion.php';
include '../config/conexion.php';

$id_producto = (int) ($_GET['id'] ?? 0);
$id_usuario = (int) $_SESSION['id_usuario'];

if ($id_producto > 0) {
    $check = $conexion->prepare('SELECT id_favorito FROM favorito WHERE id_usuario = ? AND id_producto = ?');
    $check->bind_param('ii', $id_usuario, $id_producto);
    $check->execute();

    if ($check->get_result()->num_rows === 0) {
        $stmt = $conexion->prepare('INSERT INTO favorito (id_usuario, id_producto) VALUES (?, ?)');
        $stmt->bind_param('ii', $id_usuario, $id_producto);
        $stmt->execute();
    }
}

$redirect = $_GET['redirect'] ?? '../productos.php';
header('Location: ' . $redirect);
exit();
