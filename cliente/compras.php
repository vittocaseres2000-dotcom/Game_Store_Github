<?php

include '../config/conexion.php';
session_start();

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM venta 
        WHERE id_usuario = ?
        ORDER BY fecha DESC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h1>Mis Compras</h1>

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

        <?php while($row = $resultado->fetch_assoc()): ?>

            <tr>
                <td><?php echo $row['id_venta']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>$<?php echo $row['total']; ?></td>
                <td><?php echo $row['estado_venta']; ?></td>
            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</body>
</html>