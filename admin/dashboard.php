<?php
include 'verificar_admin.php';
include '../config/conexion.php';

$ventas = mysqli_fetch_assoc(mysqli_query($conexion, 'SELECT COUNT(*) AS total FROM venta'))['total'];
$productos = mysqli_fetch_assoc(mysqli_query($conexion, 'SELECT COUNT(*) AS total FROM producto'))['total'];
$usuarios = mysqli_fetch_assoc(mysqli_query($conexion, 'SELECT COUNT(*) AS total FROM usuario'))['total'];
$categorias = mysqli_fetch_assoc(mysqli_query($conexion, 'SELECT COUNT(*) AS total FROM categoria'))['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h1>Panel administrativo</h1>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?></p>

    <div class="row mt-4">
        <div class="col-md-3 mb-3"><div class="card bg-primary text-white p-3"><h4><?= $ventas ?></h4><p class="mb-0">Ventas</p></div></div>
        <div class="col-md-3 mb-3"><div class="card bg-success text-white p-3"><h4><?= $productos ?></h4><p class="mb-0">Productos</p></div></div>
        <div class="col-md-3 mb-3"><div class="card bg-info text-white p-3"><h4><?= $usuarios ?></h4><p class="mb-0">Usuarios</p></div></div>
        <div class="col-md-3 mb-3"><div class="card bg-warning text-dark p-3"><h4><?= $categorias ?></h4><p class="mb-0">Categorías</p></div></div>
    </div>

    <div class="mt-4 d-flex flex-wrap gap-2">
        <a href="productos.php" class="btn btn-outline-light">Productos</a>
        <a href="categorias.php" class="btn btn-outline-light">Categorías</a>
        <a href="ventas.php" class="btn btn-outline-light">Ventas</a>
        <a href="usuarios.php" class="btn btn-outline-light">Usuarios</a>
        <a href="../auth/logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
</div>
</body>
</html>
