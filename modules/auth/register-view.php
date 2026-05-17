<!--Trabajo_GrupalWeb/modules/auth/register-view.php-->
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Registro | GameStore</title>

    <link
    rel="stylesheet"
    href="../../shared/navbar.css">

    <link
    rel="stylesheet"
    href="auth.css">

</head>

<body>

<?php include("../../shared/navbar.php"); ?>

<section class="login-page">

    <div class="login-card">

        <h2>Crear Cuenta</h2>

        <form
        action="auth-controller.php"
        method="POST"
        class="login-form">

            <div class="input-group">

                <label>Nombre</label>

                <div class="input-box">

                    <input
                    type="text"
                    name="nombre"
                    required>

                </div>

            </div>



            <div class="input-group">

                <label>Correo</label>

                <div class="input-box">

                    <input
                    type="email"
                    name="correo"
                    required>

                </div>

            </div>



            <div class="input-group">

                <label>Contraseña</label>

                <div class="input-box">

                    <input
                    type="password"
                    name="password"
                    required>

                </div>

            </div>



            <button
            type="submit"
            name="register"
            class="login-btn">

                Registrarse

            </button>

        </form>

    </div>

</section>

</body>
</html>