<?php
include 'verificar_admin.php';
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_venta'], $_POST['estado_venta'])) {
    $id_venta = (int) $_POST['id_venta'];
    $estado = $_POST['estado_venta'];
    $permitidos = ['pendiente', 'pagado', 'entregado'];
    if (in_array($estado, $permitidos, true)) {
        $stmt = $conexion->prepare('UPDATE venta SET estado_venta = ? WHERE id_venta = ?');
        $stmt->bind_param('si', $estado, $id_venta);
        $stmt->execute();
    }
    header('Location: ventas.php');
    exit();
}

$sql = "SELECT v.*, u.nombre
        FROM venta v
        INNER JOIN usuario u ON v.id_usuario = u.id_usuario
        ORDER BY v.fecha DESC";
$resultado = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Ventas realizadas</h1>
    <table class="table table-dark table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?= $fila['id_venta'] ?></td>
                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                <td><?= $fila['fecha'] ?></td>
                <td>$<?= number_format((float) $fila['total'], 2) ?></td>
                <td><?= htmlspecialchars($fila['estado_venta']) ?></td>
                <td>
                    <form method="POST" class="d-flex gap-1">
                        <input type="hidden" name="id_venta" value="<?= $fila['id_venta'] ?>">
                        <select name="estado_venta" class="form-select form-select-sm">
                            <option value="pendiente" <?= $fila['estado_venta'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="pagado" <?= $fila['estado_venta'] === 'pagado' ? 'selected' : '' ?>>Pagado</option>
                            <option value="entregado" <?= $fila['estado_venta'] === 'entregado' ? 'selected' : '' ?>>Entregado</option>
                        </select>
                        <button class="btn btn-success btn-sm">Guardar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-primary">Volver</a>
</div>
</body>
</html>
