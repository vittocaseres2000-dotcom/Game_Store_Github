<?php
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
    <title>GameStore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f0f0f;
            color: white;
        }

        .hero {
            background: linear-gradient(90deg, #6a00ff, #00d4ff);
            padding: 80px 20px;
            text-align: center;
        }

        .card-producto {
            background: #1c1c1c;
            border: none;
            color: white;
        }

        .categoria-box {
            background: #222;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }
    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">🎮 GameStore</a>

        <div>
            <a href="auth/login.php" class="btn btn-outline-light btn-sm">Login</a>
            <a href="auth/registro.php" class="btn btn-primary btn-sm">Registro</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <h1>Bienvenido a GameStore</h1>
    <p>Los mejores equipos gamer al mejor precio</p>
</div>

<!-- CATEGORÍAS -->
<div class="container mt-5">
    <h2 class="mb-3">Categorías</h2>

    <div class="row">

        <?php while($cat = mysqli_fetch_assoc($categorias)): ?>

        <div class="col-md-2 mb-3">
            <div class="categoria-box">
                <?php echo $cat['nombre_categoria']; ?>
            </div>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<!-- PRODUCTOS -->
<div class="container mt-5">
    <h2 class="mb-3">Productos Destacados</h2>

    <div class="row">

        <?php while($p = mysqli_fetch_assoc($productos)): ?>

        <div class="col-md-4 mb-4">

            <div class="card card-producto p-3">

                <h5><?php echo $p['nombre']; ?></h5>

                <p><?php echo $p['descripcion']; ?></p>

                <p><strong>$<?php echo $p['precio']; ?></strong></p>

                <a href="#" class="btn btn-success btn-sm">
                    Ver Producto
                </a>

            </div>

        </div>

        <?php endwhile; ?>

    </div>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-center text-white p-3 mt-5">
    © 2026 GameStore - Todos los derechos reservados
</footer>

</body>
</html>