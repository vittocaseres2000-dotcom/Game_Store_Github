<?php
include '../auth/verificar_sesion.php';
include '../config/conexion.php';

$id_usuario = (int) $_SESSION['id_usuario'];

$sql = 'SELECT * FROM venta WHERE id_usuario = ? ORDER BY fecha DESC';
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Mis compras</h1>

    <?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success">Compra registrada correctamente.</div>
    <?php endif; ?>

    <table class="table table-dark table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_venta'] ?></td>
                <td><?= $row['fecha'] ?></td>
                <td>$<?= number_format((float) $row['total'], 2) ?></td>
                <td><?= htmlspecialchars($row['estado_venta']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../productos.php" class="btn btn-primary">Seguir comprando</a>
</div>
</body>
</html>
