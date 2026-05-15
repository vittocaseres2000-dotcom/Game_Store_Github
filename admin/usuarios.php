<?php
include 'verificar_admin.php';
include '../config/conexion.php';

$resultado = mysqli_query($conexion, 'SELECT id_usuario, nombre, correo, rol, fecha_registro, estado_2fa FROM usuario ORDER BY fecha_registro DESC');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Usuarios registrados</h1>
    <table class="table table-dark table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>2FA</th>
                <th>Registro</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($u = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?= $u['id_usuario'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['correo']) ?></td>
                <td><?= htmlspecialchars($u['rol']) ?></td>
                <td><?= $u['estado_2fa'] ? 'Activo' : 'Inactivo' ?></td>
                <td><?= $u['fecha_registro'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-primary">Volver</a>
</div>
</body>
</html>
