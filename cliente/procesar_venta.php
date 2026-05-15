<?php
include '../auth/verificar_sesion.php';
include '../config/conexion.php';

$carrito = $_SESSION['carrito'] ?? [];
if (empty($carrito)) {
    header('Location: carrito.php');
    exit();
}

$id_usuario = (int) $_SESSION['id_usuario'];
$total = 0;
$lineas = [];

foreach ($carrito as $id_producto => $cantidad) {
    $id_producto = (int) $id_producto;
    $cantidad = (int) $cantidad;
    if ($cantidad <= 0) {
        continue;
    }

    $stmt = $conexion->prepare('SELECT id_producto, precio, stock FROM producto WHERE id_producto = ?');
    $stmt->bind_param('i', $id_producto);
    $stmt->execute();
    $prod = $stmt->get_result()->fetch_assoc();

    if (!$prod || $prod['stock'] < $cantidad) {
        header('Location: carrito.php?error=stock');
        exit();
    }

    $subtotal = $prod['precio'] * $cantidad;
    $total += $subtotal;
    $lineas[] = [
        'id_producto' => $id_producto,
        'cantidad' => $cantidad,
        'subtotal' => $subtotal,
    ];
}

if ($total <= 0 || empty($lineas)) {
    header('Location: carrito.php');
    exit();
}

$conexion->begin_transaction();

try {
    $stmtVenta = $conexion->prepare("INSERT INTO venta (id_usuario, total, estado_venta) VALUES (?, ?, 'pendiente')");
    $stmtVenta->bind_param('id', $id_usuario, $total);
    $stmtVenta->execute();
    $id_venta = $conexion->insert_id;

    $stmtDetalle = $conexion->prepare('INSERT INTO detalle_venta (id_venta, id_producto, cantidad, subtotal) VALUES (?, ?, ?, ?)');
    $stmtStock = $conexion->prepare('UPDATE producto SET stock = stock - ? WHERE id_producto = ?');

    foreach ($lineas as $linea) {
        $stmtDetalle->bind_param('iiid', $id_venta, $linea['id_producto'], $linea['cantidad'], $linea['subtotal']);
        $stmtDetalle->execute();

        $stmtStock->bind_param('ii', $linea['cantidad'], $linea['id_producto']);
        $stmtStock->execute();
    }

    $conexion->commit();
    unset($_SESSION['carrito']);
    header('Location: compras.php?ok=1');
    exit();
} catch (Exception $e) {
    $conexion->rollback();
    header('Location: carrito.php?error=venta');
    exit();
}
