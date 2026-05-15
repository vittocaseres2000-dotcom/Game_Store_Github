<?php
session_start();
include '../config/conexion.php';

if (isset($_SESSION['id_usuario'])) {
    header('Location: ' . ($_SESSION['rol'] === 'admin' ? '../admin/dashboard.php' : '../index.php'));
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    $stmt = $conexion->prepare('SELECT id_usuario, nombre, contrasena, rol FROM usuario WHERE correo = ?');
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $codigo = (string) random_int(100000, 999999);

        $_SESSION['temp_usuario'] = $usuario['id_usuario'];
        $_SESSION['temp_nombre'] = $usuario['nombre'];
        $_SESSION['temp_rol'] = $usuario['rol'];
        $_SESSION['codigo_2fa'] = $codigo;

        $upd = $conexion->prepare('UPDATE usuario SET codigo_2fa = ?, estado_2fa = 1 WHERE id_usuario = ?');
        $upd->bind_param('si', $codigo, $usuario['id_usuario']);
        $upd->execute();

        header('Location: verificar_2fa.php');
        exit();
    }

    $error = 'Correo o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GameStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5 col-md-5">
    <div class="card bg-secondary p-4">
        <h2 class="mb-3">Iniciar sesión</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="correo" class="form-control mb-2" placeholder="Correo" required>
            <input type="password" name="contrasena" class="form-control mb-3" placeholder="Contraseña" required>
            <button class="btn btn-success w-100">Continuar</button>
        </form>
        <p class="mt-3 mb-0">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
        <p class="mt-2"><a href="../index.php">Volver al inicio</a></p>
    </div>
</div>
</body>
</html>
