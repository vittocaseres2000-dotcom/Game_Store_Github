<?php

include 'verificar_admin.php';
include '../config/conexion.php';

$accion = $_GET['accion'] ?? '';
$id = $_GET['id'] ?? null;

$mensaje = "";

/* =========================
   ELIMINAR PRODUCTO
========================= */
if ($accion == "eliminar" && $id) {

    $stmt = $conexion->prepare("DELETE FROM producto WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: productos.php");
    exit();
}

/* =========================
   AGREGAR PRODUCTO
========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    $imagen = "";

    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != "") {

        $imagen = "img/productos/" . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../" . $imagen);
    }

    $stmt = $conexion->prepare("
        INSERT INTO producto
        (nombre, marca, descripcion, precio, stock, imagen, id_categoria)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssdisi",
        $nombre,
        $marca,
        $descripcion,
        $precio,
        $stock,
        $imagen,
        $id_categoria
    );

    $stmt->execute();

    header("Location: productos.php");
    exit();
}

/* =========================
   LISTADO
========================= */
$productos = mysqli_query($conexion, "
    SELECT p.*, c.nombre_categoria
    FROM producto p
    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
");

$categorias = mysqli_query($conexion, "SELECT * FROM categoria");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-4">

    <h1 class="mb-4">Gestión de Productos</h1>

    <!-- FORMULARIO AGREGAR -->
    <div class="card p-3 mb-4">

        <h4>Agregar Producto</h4>

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-4">
                    <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre" required>
                </div>

                <div class="col-md-4">
                    <input type="text" name="marca" class="form-control mb-2" placeholder="Marca">
                </div>

                <div class="col-md-4">
                    <input type="number" name="precio" class="form-control mb-2" placeholder="Precio" required>
                </div>

                <div class="col-md-4">
                    <input type="number" name="stock" class="form-control mb-2" placeholder="Stock">
                </div>

                <div class="col-md-4">
                    <select name="id_categoria" class="form-control mb-2">

                        <?php while($c = mysqli_fetch_assoc($categorias)): ?>
                            <option value="<?php echo $c['id_categoria']; ?>">
                                <?php echo $c['nombre_categoria']; ?>
                            </option>
                        <?php endwhile; ?>

                    </select>
                </div>

                <div class="col-md-4">
                    <input type="file" name="imagen" class="form-control mb-2">
                </div>

                <div class="col-md-12">
                    <textarea name="descripcion" class="form-control mb-2" placeholder="Descripción"></textarea>
                </div>

                <div class="col-md-12">
                    <button name="guardar" class="btn btn-success w-100">
                        Guardar Producto
                    </button>
                </div>

            </div>

        </form>

    </div>

    <!-- LISTA PRODUCTOS -->
    <table class="table table-dark table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

        <?php while($p = mysqli_fetch_assoc($productos)): ?>

            <tr>

                <td><?= $p['id_producto'] ?></td>
                <td><?= $p['nombre'] ?></td>
                <td><?= $p['marca'] ?></td>
                <td><?= $p['precio'] ?></td>
                <td><?= $p['stock'] ?></td>
                <td><?= $p['nombre_categoria'] ?></td>

                <td>
                    <?php if($p['imagen']): ?>
                        <img src="../<?= $p['imagen'] ?>" width="50">
                    <?php endif; ?>
                </td>

                <td>

                    <a href="editar_producto.php?id=<?= $p['id_producto'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="productos.php?accion=eliminar&id=<?= $p['id_producto'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Eliminar producto?')">
                        Eliminar
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

    <a href="dashboard.php" class="btn btn-primary">
        Volver
    </a>

</div>

</body>
</html>