<?php

include 'verificar_admin.php';
include '../config/conexion.php';

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
    <title>Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h1>Ventas Realizadas</h1>

    <table class="table table-dark table-bordered mt-4">

        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>

        <?php while($fila = mysqli_fetch_assoc($resultado)): ?>

            <tr>
                <td><?php echo $fila['id_venta']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['fecha']; ?></td>
                <td>$<?php echo $fila['total']; ?></td>
                <td><?php echo $fila['estado_venta']; ?></td>
            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

    <a href="dashboard.php" class="btn btn-primary">Volver</a>

</div>

</body>
</html>