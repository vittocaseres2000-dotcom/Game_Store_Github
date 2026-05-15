<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['quitar'])) {
    $id = (int) $_GET['quitar'];
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]--;
        if ($_SESSION['carrito'][$id] <= 0) {
            unset($_SESSION['carrito'][$id]);
        }
    }
    header('Location: carrito.php');
    exit();
}

if (isset($_GET['mas'])) {
    $id = (int) $_GET['mas'];
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]++;
    }
    header('Location: carrito.php');
    exit();
}

if (isset($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];
    unset($_SESSION['carrito'][$id]);
    header('Location: carrito.php');
    exit();
}

$carrito = $_SESSION['carrito'];
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Carrito de compras</h1>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'stock'): ?>
        <div class="alert alert-danger">No hay stock suficiente para completar la compra.</div>
    <?php endif; ?>

    <?php if (empty($carrito)): ?>
        <p class="mt-4">Tu carrito está vacío.</p>
        <a href="../productos.php" class="btn btn-primary">Ver productos</a>
    <?php else: ?>
    <table class="table table-dark table-bordered mt-4">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($carrito as $id => $cantidad): ?>
            <?php
            $id = (int) $id;
            $stmt = $conexion->prepare('SELECT nombre, precio FROM producto WHERE id_producto = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $prod = $stmt->get_result()->fetch_assoc();
            if (!$prod) {
                continue;
            }
            $subtotal = $prod['precio'] * $cantidad;
            $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($prod['nombre']) ?></td>
                <td>$<?= number_format((float) $prod['precio'], 2) ?></td>
                <td><?= $cantidad ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
                <td>
                    <a href="carrito.php?mas=<?= $id ?>" class="btn btn-success btn-sm">+</a>
                    <a href="carrito.php?quitar=<?= $id ?>" class="btn btn-warning btn-sm">-</a>
                    <a href="carrito.php?eliminar=<?= $id ?>" class="btn btn-danger btn-sm">Quitar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total: $<?= number_format($total, 2) ?></h3>

    <?php if (isset($_SESSION['id_usuario'])): ?>
        <a href="checkout.php" class="btn btn-success">Confirmar compra</a>
    <?php else: ?>
        <a href="../auth/login.php" class="btn btn-success">Inicia sesión para comprar</a>
    <?php endif; ?>
    <a href="../productos.php" class="btn btn-primary">Seguir comprando</a>
    <?php endif; ?>
</div>
</body>
</html>
