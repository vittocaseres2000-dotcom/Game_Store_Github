<?php

session_start();
include '../config/conexion.php';

$carrito = $_SESSION['carrito'] ?? [];

$total = 0;
session_start();

if (isset($_GET['quitar'])) {

    $id = $_GET['quitar'];

    if (isset($_SESSION['carrito'][$id])) {

        $_SESSION['carrito'][$id]--;

        if ($_SESSION['carrito'][$id] <= 0) {
            unset($_SESSION['carrito'][$id]);
        }
    }

    header("Location: carrito.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <h1>Carrito de Compras</h1>

    <table class="table table-dark table-bordered mt-4">

        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($carrito as $id => $cantidad): ?>

            <?php

            $sql = "SELECT * FROM producto WHERE id_producto = $id";
            $res = mysqli_query($conexion, $sql);
            $prod = mysqli_fetch_assoc($res);

            $subtotal = $prod['precio'] * $cantidad;
            $total += $subtotal;

            ?>

            <tr>

                <td><?php echo $prod['nombre']; ?></td>

                <td><?php echo $prod['precio']; ?></td>

                <td><?php echo $cantidad; ?></td>

                <td><?php echo $subtotal; ?></td>

                <td>
                    <a href="carrito.php?quitar=<?php echo $id; ?>" class="btn btn-danger btn-sm">
                        Quitar
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

    <h3>Total: <?php echo $total; ?> Bs</h3>

    <a href="checkout.php" class="btn btn-success">
        Confirmar compra
    </a>

    <a href="../productos.php" class="btn btn-primary">
        Seguir comprando
    </a>

</div>

</body>
</html>