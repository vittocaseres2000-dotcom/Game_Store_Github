<?php
session_start();
include 'config/conexion.php';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['agregar'])) {
    $id = (int) $_GET['agregar'];
    if ($id > 0) {
        $_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + 1;
    }
    header('Location: productos.php');
    exit();
}

$buscar = trim($_GET['buscar'] ?? '');
$categoria = (int) ($_GET['categoria'] ?? 0);
$marca = trim($_GET['marca'] ?? '');

$sql = "SELECT p.*, c.nombre_categoria
        FROM producto p
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
        WHERE p.estado = 'activo'";
$params = [];
$types = '';

if ($buscar !== '') {
    $sql .= " AND (p.nombre LIKE ? OR p.descripcion LIKE ?)";
    $like = '%' . $buscar . '%';
    $params[] = $like;
    $params[] = $like;
    $types .= 'ss';
}
if ($categoria > 0) {
    $sql .= " AND p.id_categoria = ?";
    $params[] = $categoria;
    $types .= 'i';
}
if ($marca !== '') {
    $sql .= " AND p.marca LIKE ?";
    $params[] = '%' . $marca . '%';
    $types .= 's';
}

$sql .= " ORDER BY p.nombre";

$stmt = $conexion->prepare($sql);
if ($types !== '') {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$productos = $stmt->get_result();

$categorias = mysqli_query($conexion, 'SELECT * FROM categoria ORDER BY nombre_categoria');
$marcas = mysqli_query($conexion, "SELECT DISTINCT marca FROM producto WHERE marca IS NOT NULL AND marca != '' ORDER BY marca");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<nav class="navbar navbar-dark bg-black mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">🎮 GameStore</a>
        <div>
            <a href="cliente/carrito.php" class="btn btn-outline-light btn-sm">Carrito</a>
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a href="cliente/favoritos.php" class="btn btn-warning btn-sm">Favoritos</a>
                <a href="cliente/compras.php" class="btn btn-info btn-sm">Mis compras</a>
                <a href="auth/logout.php" class="btn btn-danger btn-sm">Salir</a>
            <?php else: ?>
                <a href="auth/login.php" class="btn btn-primary btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="mb-4">Catálogo de productos</h1>

    <form class="row g-2 mb-4" method="GET">
        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre..." value="<?= htmlspecialchars($buscar) ?>">
        </div>
        <div class="col-md-3">
            <select name="categoria" class="form-select">
                <option value="0">Todas las categorías</option>
                <?php while ($c = mysqli_fetch_assoc($categorias)): ?>
                    <option value="<?= $c['id_categoria'] ?>" <?= $categoria === (int) $c['id_categoria'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nombre_categoria']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="marca" class="form-select">
                <option value="">Todas las marcas</option>
                <?php while ($m = mysqli_fetch_assoc($marcas)): ?>
                    <option value="<?= htmlspecialchars($m['marca']) ?>" <?= $marca === $m['marca'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m['marca']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-success w-100">Filtrar</button>
        </div>
    </form>

    <div class="row">
        <?php while ($p = $productos->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-white h-100">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($p['nombre']) ?></h5>
                        <p class="small mb-1"><?= htmlspecialchars($p['nombre_categoria'] ?? '') ?> · <?= htmlspecialchars($p['marca'] ?? '') ?></p>
                        <p><?= htmlspecialchars($p['descripcion'] ?? '') ?></p>
                        <p class="fw-bold">$<?= number_format((float) $p['precio'], 2) ?> · Stock: <?= (int) $p['stock'] ?></p>
                        <a href="producto.php?id=<?= $p['id_producto'] ?>" class="btn btn-outline-light btn-sm">Ver detalle</a>
                        <a href="productos.php?agregar=<?= $p['id_producto'] ?>" class="btn btn-success btn-sm">Agregar al carrito</a>
                        <?php if (isset($_SESSION['id_usuario'])): ?>
                            <a href="cliente/agregar_favorito.php?id=<?= $p['id_producto'] ?>" class="btn btn-warning btn-sm">⭐</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
