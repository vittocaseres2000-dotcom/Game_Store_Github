<?php
        $sql = "INSERT INTO usuario(nombre, correo, contraseña)
                VALUES (?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $nombre, $correo, $password_encriptada);

        if ($stmt->execute()) {
            $mensaje = "Usuario registrado correctamente";
        } else {
            $mensaje = "Error al registrar usuario";
        }

    else {
        $mensaje = "Complete todos los campos";
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card p-4 shadow">

                <h2 class="text-center mb-4 text-dark">Registro</h2>

                <?php if($mensaje != ""): ?>
                    <div class="alert alert-info">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label text-dark">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark">Correo</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
</html>