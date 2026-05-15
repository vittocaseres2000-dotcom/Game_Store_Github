<?php
session_start();
include 'config/conexion.php';

$sql = "SELECT * FROM producto WHERE estado='activo' LIMIT 6";
$productos = mysqli_query($conexion, $sql);

$sqlCat = "SELECT * FROM categoria";
$categorias = mysqli_query($conexion, $sqlCat);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0f0f0f; color: white; }
        .hero { background: linear-gradient(90deg, #6a00ff, #00d4ff); padding: 80px 20px; text-align: center; }
        .card-producto { background: #1c1c1c; border: none; color: white; }
        .categoria-box { background: #222; padding: 15px; border-radius: 10px; text-align: center; }
        .beneficio { background: #1a1a1a; border-radius: 10px; padding: 20px; height: 100%; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">🎮 GameStore</a>
        <div class="d-flex gap-2">
            <a href="productos.php" class="btn btn-outline-light btn-sm">Catálogo</a>
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a href="cliente/carrito.php" class="btn btn-outline-light btn-sm">Carrito</a>
                <a href="auth/logout.php" class="btn btn-danger btn-sm">Salir</a>
            <?php else: ?>
                <a href="auth/login.php" class="btn btn-outline-light btn-sm">Login</a>
                <a href="auth/registro.php" class="btn btn-primary btn-sm">Registro</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="hero">
    <h1>Bienvenido a GameStore</h1>
    <p>Los mejores equipos gamer al mejor precio</p>
    <a href="productos.php" class="btn btn-light btn-lg mt-2">Ver catálogo</a>
</div>

<div class="container mt-5">
    <h2 class="mb-3">Categorías</h2>
    <div class="row">
        <?php while ($cat = mysqli_fetch_assoc($categorias)): ?>
        <div class="col-6 col-md-2 mb-3">
            <div class="categoria-box">
                <a href="productos.php?categoria=<?= $cat['id_categoria'] ?>" class="text-white text-decoration-none">
                    <?= htmlspecialchars($cat['nombre_categoria']) ?>
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-3">Beneficios</h2>
    <div class="row">
        <div class="col-md-4 mb-3"><div class="beneficio"><h5>🚚 Envío rápido</h5><p>Entrega en todo el país.</p></div></div>
        <div class="col-md-4 mb-3"><div class="beneficio"><h5>💳 Pago seguro</h5><p>Compras protegidas con sesión y 2FA.</p></div></div>
        <div class="col-md-4 mb-3"><div class="beneficio"><h5>🎁 Promociones</h5><p>Ofertas en equipos gamer seleccionados.</p></div></div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-3">Productos destacados</h2>
    <div class="row">
        <?php while ($p = mysqli_fetch_assoc($productos)): ?>
        <div class="col-md-4 mb-4">
            <div class="card card-producto p-3">
                <h5><?= htmlspecialchars($p['nombre']) ?></h5>
                <p><?= htmlspecialchars($p['descripcion'] ?? '') ?></p>
                <p><strong>$<?= number_format((float) $p['precio'], 2) ?></strong></p>
                <a href="producto.php?id=<?= $p['id_producto'] ?>" class="btn btn-success btn-sm">Ver producto</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="container mt-4 mb-5">
    <h2>Sobre la tienda</h2>
    <p>GameStore es tu tienda online de equipos gamer: laptops, monitores, periféricos y más.</p>
</div>

<footer class="bg-dark text-center text-white p-3 mt-5">
    © 2026 GameStore - Todos los derechos reservados
</footer>

</body>
</html>
