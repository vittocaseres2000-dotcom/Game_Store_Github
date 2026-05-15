<?php
include 'verificar_admin.php';
include '../config/conexion.php';

$id = $_GET['id'];

$categorias = mysqli_query($conexion, "SELECT * FROM categoria");

$sql = "SELECT * FROM producto WHERE id_producto=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "UPDATE producto SET nombre=?, marca=?, precio=?, stock=? WHERE id_producto=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdii", $nombre, $marca, $precio, $stock, $id);

    $stmt->execute();

    header("Location: productos.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h2>Editar Producto</h2>

    <form method="POST">

        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" class="form-control mb-2">

        <input type="text" name="marca" value="<?= $producto['marca'] ?>" class="form-control mb-2">

        <input type="number" name="precio" value="<?= $producto['precio'] ?>" class="form-control mb-2">

        <input type="number" name="stock" value="<?= $producto['stock'] ?>" class="form-control mb-2">

        <button class="btn btn-warning w-100">Actualizar</button>

    </form>

</div>

</body>
</html>