<?php

include 'verificar_admin.php';
include '../config/conexion.php';

$mensaje = "";

/* =========================
ELIMINAR
========================= */

if (isset($_GET['eliminar'])) {

    $idEliminar = $_GET['eliminar'];

    $sqlDelete = "DELETE FROM categoria
                  WHERE id_categoria = ?";

    $stmtDelete = $conexion->prepare($sqlDelete);

    $stmtDelete->bind_param("i", $idEliminar);

    $stmtDelete->execute();

    header("Location: categorias.php");
    exit();

}

/* =========================
AGREGAR
========================= */

if (isset($_POST['agregar'])) {

    $nombre = trim($_POST['nombre_categoria']);
    $descripcion = trim($_POST['descripcion']);

    if (!empty($nombre)) {

        $sqlInsert = "INSERT INTO categoria(
                        nombre_categoria,
                        descripcion
                    )
                    VALUES (?, ?)";

        $stmtInsert = $conexion->prepare($sqlInsert);

        $stmtInsert->bind_param(
            "ss",
            $nombre,
            $descripcion
        );

        if ($stmtInsert->execute()) {

            $mensaje = "Categoría agregada";

        } else {

            $mensaje = "Error al agregar";

        }

    } else {

        $mensaje = "Complete el nombre";

    }

}

/* =========================
ACTUALIZAR
========================= */

if (isset($_POST['actualizar'])) {

    $idEditar = $_POST['id_categoria'];

    $nombre = trim($_POST['nombre_categoria']);

    $descripcion = trim($_POST['descripcion']);

    $sqlUpdate = "UPDATE categoria
                  SET nombre_categoria = ?,
                      descripcion = ?
                  WHERE id_categoria = ?";

    $stmtUpdate = $conexion->prepare($sqlUpdate);

    $stmtUpdate->bind_param(
        "ssi",
        $nombre,
        $descripcion,
        $idEditar
    );

    if ($stmtUpdate->execute()) {

        $mensaje = "Categoría actualizada";

    } else {

        $mensaje = "Error al actualizar";

    }

}

/* =========================
EDITAR
========================= */

$modoEditar = false;

$categoriaEditar = null;

if (isset($_GET['editar'])) {

    $modoEditar = true;

    $idEditar = $_GET['editar'];

    $sqlEditar = "SELECT * FROM categoria
                  WHERE id_categoria = ?";

    $stmtEditar = $conexion->prepare($sqlEditar);

    $stmtEditar->bind_param("i", $idEditar);

    $stmtEditar->execute();

    $resultadoEditar = $stmtEditar->get_result();

    $categoriaEditar = $resultadoEditar->fetch_assoc();

}

/* =========================
LISTAR
========================= */

$sql = "SELECT * FROM categoria";

$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Categorías</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Categorías</h1>

        <a href="dashboard.php"
           class="btn btn-primary">
            Volver
        </a>

    </div>

    <?php if($mensaje != ""): ?>

        <div class="alert alert-info">
            <?php echo $mensaje; ?>
        </div>

    <?php endif; ?>

    <!-- =========================
    FORMULARIO
    ========================= -->

    <div class="card p-4 mb-4">

        <h3 class="text-dark mb-3">

            <?php
            echo $modoEditar
                ? "Editar Categoría"
                : "Agregar Categoría";
            ?>

        </h3>

        <form method="POST">

            <?php if($modoEditar): ?>

                <input
                    type="hidden"
                    name="id_categoria"
                    value="<?php echo $categoriaEditar['id_categoria']; ?>"
                >

            <?php endif; ?>

            <div class="mb-3">

                <label class="form-label text-dark">
                    Nombre Categoría
                </label>

                <input
                    type="text"
                    name="nombre_categoria"
                    class="form-control"
                    required

                    value="<?php
                    echo $modoEditar
                        ? $categoriaEditar['nombre_categoria']
                        : '';
                    ?>"
                >

            </div>

            <div class="mb-3">

                <label class="form-label text-dark">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    class="form-control"
                ><?php
                    echo $modoEditar
                        ? $categoriaEditar['descripcion']
                        : '';
                ?></textarea>

            </div>

            <?php if($modoEditar): ?>

                <button
                    type="submit"
                    name="actualizar"
                    class="btn btn-warning w-100"
                >
                    Actualizar Categoría
                </button>

            <?php else: ?>

                <button
                    type="submit"
                    name="agregar"
                    class="btn btn-success w-100"
                >
                    Agregar Categoría
                </button>

            <?php endif; ?>

        </form>

    </div>

    <!-- =========================
    TABLA
    ========================= -->

    <table class="table table-dark table-bordered table-hover">

        <thead>

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

        <?php while($fila = mysqli_fetch_assoc($resultado)): ?>

            <tr>

                <td>
                    <?php echo $fila['id_categoria']; ?>
                </td>

                <td>
                    <?php echo $fila['nombre_categoria']; ?>
                </td>

                <td>
                    <?php echo $fila['descripcion']; ?>
                </td>

                <td>

                    <a
                        href="categorias.php?editar=<?php echo $fila['id_categoria']; ?>"
                        class="btn btn-warning btn-sm"
                    >
                        Editar
                    </a>

                    <a
                        href="categorias.php?eliminar=<?php echo $fila['id_categoria']; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Eliminar categoría?')"
                    >
                        Eliminar
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</body>
</html>