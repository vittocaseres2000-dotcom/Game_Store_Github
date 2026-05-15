<?php
session_start();

if (!isset($_SESSION['codigo_2fa'])) {
    header("Location: login.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigo_ingresado = $_POST['codigo'];

    if ($codigo_ingresado == $_SESSION['codigo_2fa']) {

        // activar sesión real
        $_SESSION['id_usuario'] = $_SESSION['temp_usuario'];
        $_SESSION['nombre'] = $_SESSION['temp_nombre'];
        $_SESSION['rol'] = $_SESSION['temp_rol'];

        // limpiar temporales
        unset($_SESSION['temp_usuario']);
        unset($_SESSION['temp_nombre']);
        unset($_SESSION['temp_rol']);
        unset($_SESSION['codigo_2fa']);

        header("Location: ../admin/dashboard.php");
        exit();

    } else {
        $mensaje = "Código incorrecto";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación 2FA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <div class="card p-4">

        <h2>Verificación 2FA</h2>

        <p>Tu código es:</p>

        <h3 class="text-primary">
            <?php echo $_SESSION['codigo_2fa']; ?>
        </h3>

        <?php if($mensaje != ""): ?>
            <div class="alert alert-danger">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <input type="text" name="codigo" class="form-control mb-3" placeholder="Ingresa el código" required>

            <button class="btn btn-success w-100">
                Verificar
            </button>

        </form>

    </div>

</div>

</body>
</html>