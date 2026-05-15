<?php
include '../auth/verificar_sesion.php';
include '../config/conexion.php';

$carrito = $_SESSION['carrito'] ?? [];
if (empty($carrito)) {
    header('Location: carrito.php');
    exit();
}

$total = 0;
$items = [];

foreach ($carrito as $id => $cantidad) {
    $id = (int) $id;
    $stmt = $conexion->prepare('SELECT id_producto, nombre, precio, stock FROM producto WHERE id_producto = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $prod = $stmt->get_result()->fetch_assoc();
    if ($prod) {
        $subtotal = $prod['precio'] * $cantidad;
        $total += $subtotal;
        $items[] = [
            'id_producto' => $prod['id_producto'],
            'nombre' => $prod['nombre'],
            'precio' => $prod['precio'],
            'cantidad' => $cantidad,
            'stock' => $prod['stock'],
            'subtotal' => $subtotal,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Confirmar compra</h1>
    <p>Hola, <strong><?= htmlspecialchars($_SESSION['nombre']) ?></strong></p>

    <table class="table table-dark table-bordered mt-4">
        <thead>
            <tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Stock</th></tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['nombre']) ?></td>
                <td>$<?= number_format((float) $item['precio'], 2) ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= number_format((float) $item['subtotal'], 2) ?></td>
                <td><?= $item['stock'] >= $item['cantidad'] ? 'OK' : '<span class="text-danger">Insuficiente</span>' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total: $<?= number_format($total, 2) ?></h3>

    <form method="POST" action="procesar_venta.php" class="mt-3">
        <button type="submit" class="btn btn-success">Confirmar y pagar</button>
        <a href="carrito.php" class="btn btn-secondary">Volver al carrito</a>
    </form>
</div>
</body>
</html>
