<?php
session_start();
include '../config/conexion.php';

if (isset($_SESSION['id_usuario'])) {
    header('Location: ../index.php');
    exit();
}

$error = '';
$ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if ($nombre === '' || $correo === '' || $contrasena === '') {
        $error = 'Completa todos los campos.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = 'Correo inválido.';
    } elseif ($contrasena !== $confirmar) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        $check = $conexion->prepare('SELECT id_usuario FROM usuario WHERE correo = ?');
        $check->bind_param('s', $correo);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $error = 'Ese correo ya está registrado.';
        } else {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $rol = 'cliente';
            $stmt = $conexion->prepare('INSERT INTO usuario (nombre, correo, contrasena, rol) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $nombre, $correo, $hash, $rol);
            if ($stmt->execute()) {
                $ok = 'Registro exitoso. Ya puedes iniciar sesión.';
            } else {
                $error = 'No se pudo registrar el usuario.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5 col-md-5">
    <div class="card bg-secondary p-4">
        <h2 class="mb-3">Crear cuenta</h2>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($ok): ?><div class="alert alert-success"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
        <form method="POST" id="formRegistro">
            <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre completo" required>
            <input type="email" name="correo" class="form-control mb-2" placeholder="Correo" required>
            <input type="password" name="contrasena" class="form-control mb-2" placeholder="Contraseña" required minlength="6">
            <input type="password" name="confirmar" class="form-control mb-3" placeholder="Confirmar contraseña" required>
            <button class="btn btn-primary w-100">Registrarme</button>
        </form>
        <p class="mt-3 mb-0">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
</div>
<script src="../js/validaciones.js"></script>
</body>
</html>
