<?php
session_start();
include 'config/conexion.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: productos.php');
    exit();
}

$stmt = $conexion->prepare("SELECT p.*, c.nombre_categoria
    FROM producto p
    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
    WHERE p.id_producto = ? AND p.estado = 'activo'");
$stmt->bind_param('i', $id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();

if (!$p) {
    header('Location: productos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($p['nombre']) ?> - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <a href="productos.php" class="btn btn-outline-light btn-sm mb-3">← Volver al catálogo</a>
    <div class="card bg-secondary p-4">
        <h1><?= htmlspecialchars($p['nombre']) ?></h1>
        <p><strong>Categoría:</strong> <?= htmlspecialchars($p['nombre_categoria'] ?? 'N/A') ?></p>
        <p><strong>Marca:</strong> <?= htmlspecialchars($p['marca'] ?? 'N/A') ?></p>
        <p><?= nl2br(htmlspecialchars($p['descripcion'] ?? '')) ?></p>
        <p class="fs-4 fw-bold">$<?= number_format((float) $p['precio'], 2) ?></p>
        <p>Stock disponible: <?= (int) $p['stock'] ?></p>
        <a href="productos.php?agregar=<?= $p['id_producto'] ?>" class="btn btn-success">Agregar al carrito</a>
        <?php if (isset($_SESSION['id_usuario'])): ?>
            <a href="cliente/agregar_favorito.php?id=<?= $p['id_producto'] ?>" class="btn btn-warning">⭐ Agregar a favoritos</a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
