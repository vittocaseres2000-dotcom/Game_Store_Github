<?php

include 'verificar_sesion.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>

        <p>Rol: <?php echo $_SESSION['rol']; ?></p>

        <a href="logout.php" class="btn btn-danger">
            Cerrar sesión
        </a>

    </div>

</div>

</body>
</html>