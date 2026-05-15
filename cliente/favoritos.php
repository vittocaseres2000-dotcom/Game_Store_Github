<?php
include '../auth/verificar_sesion.php';
include '../config/conexion.php';

$id_usuario = (int) $_SESSION['id_usuario'];

if (isset($_GET['eliminar'])) {
    $id_favorito = (int) $_GET['eliminar'];
    $del = $conexion->prepare('DELETE FROM favorito WHERE id_favorito = ? AND id_usuario = ?');
    $del->bind_param('ii', $id_favorito, $id_usuario);
    $del->execute();
    header('Location: favoritos.php');
    exit();
}

$sql = "SELECT f.id_favorito, p.id_producto, p.nombre, p.precio, p.marca, f.fecha
        FROM favorito f
        INNER JOIN producto p ON f.id_producto = p.id_producto
        WHERE f.id_usuario = ?
        ORDER BY f.fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$favoritos = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis favoritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Mis favoritos</h1>
    <table class="table table-dark table-bordered mt-4">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($f = $favoritos->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($f['nombre']) ?></td>
                <td><?= htmlspecialchars($f['marca'] ?? '') ?></td>
                <td>$<?= number_format((float) $f['precio'], 2) ?></td>
                <td><?= $f['fecha'] ?></td>
                <td>
                    <a href="../producto.php?id=<?= $f['id_producto'] ?>" class="btn btn-primary btn-sm">Ver</a>
                    <a href="favoritos.php?eliminar=<?= $f['id_favorito'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar de favoritos?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="../productos.php" class="btn btn-outline-light">Seguir comprando</a>
</div>
</body>
</html>
