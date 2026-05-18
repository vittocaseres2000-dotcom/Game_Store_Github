<!--Trabajo_GrupalWeb/modules/auth/register-view.php-->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Registro | GameStore</title>

    <!-- GOOGLE FONTS -->
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- REMIX ICONS -->
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet">

    <link
    rel="stylesheet"
    href="../../shared/navbar.css">

    <link
    rel="stylesheet"
    href="login.css">

</head>

<body>

<?php include("../../shared/navbar.php"); ?>

<section class="login-page">

    <div class="container-custom login-container">

        <!-- LEFT -->
        <div class="login-left">

            <span class="login-badge">
                CREA TU CUENTA
            </span>

            <h1>
                ÚNETE A LA
                <span>
                    EXPERIENCIA GAMER
                </span>
            </h1>

            <p>
                Regístrate para acceder a ofertas exclusivas,
                favoritos, historial de compras y más.
            </p>

            <div class="login-benefits">

                <div class="login-benefit">

                    <div class="login-benefit-icon">
                        <i class="ri-user-star-line"></i>
                    </div>

                    <div>

                        <h4>
                            Cuenta personalizada
                        </h4>

                        <p>
                            Configura tu perfil gamer
                        </p>

                    </div>

                </div>

                <div class="login-benefit">

                    <div class="login-benefit-icon">
                        <i class="ri-shield-keyhole-line"></i>
                    </div>

                    <div>

                        <h4>
                            Seguridad avanzada
                        </h4>

                        <p>
                            Protección con autenticación 2FA
                        </p>

                    </div>

                </div>

                <div class="login-benefit">

                    <div class="login-benefit-icon">
                        <i class="ri-vip-crown-line"></i>
                    </div>

                    <div>

                        <h4>
                            Beneficios exclusivos
                        </h4>

                        <p>
                            Acceso a promociones especiales
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="login-card">

            <div class="login-logo">

                <i class="ri-user-add-line"></i>

            </div>

            <h2>
                Crear Cuenta
            </h2>

            <p>
                Completa tus datos para registrarte
            </p>

            <form
            action="auth-controller.php"
            method="POST"
            class="login-form">

                <!-- NOMBRE -->
                <div class="input-group">

                    <label>
                        Nombre completo
                    </label>

                    <div class="input-box <?php
                    if(isset($_GET['nombre_error'])){
                        echo 'input-error';
                    }
                    ?>">

                        <i class="ri-user-line"></i>

                        <input
                        type="text"
                        name="nombre"
                        placeholder="Ingresa tu nombre"
                        value="<?php
                        echo isset($_GET['nombre'])
                        ? htmlspecialchars($_GET['nombre'])
                        : '';
                        ?>">

                    </div>

                    <?php if(isset($_GET['nombre_error'])){ ?>

                        <span class="input-message">

                            <?php
                            echo $_GET['nombre_error'];
                            ?>

                        </span>

                    <?php } ?>

                </div>

                <!-- CORREO -->
                <div class="input-group">

                    <label>
                        Correo electrónico
                    </label>

                    <div class="input-box <?php
                    if(isset($_GET['correo_error'])){
                        echo 'input-error';
                    }
                    ?>">

                        <i class="ri-mail-line"></i>

                        <input
                        type="email"
                        name="correo"
                        placeholder="usuario@correo.com"
                        value="<?php
                        echo isset($_GET['correo'])
                        ? htmlspecialchars($_GET['correo'])
                        : '';
                        ?>">

                    </div>

                    <?php if(isset($_GET['correo_error'])){ ?>

                        <span class="input-message">

                            <?php
                            echo $_GET['correo_error'];
                            ?>

                        </span>

                    <?php } ?>

                </div>

                <!-- PASSWORD -->
                <div class="input-group">

                    <label>
                        Contraseña
                    </label>

                    <div class="input-box <?php
                    if(isset($_GET['password_error'])){
                        echo 'input-error';
                    }
                    ?>">

                        <i class="ri-lock-line"></i>

                        <input
                        type="password"
                        name="password"
                        placeholder="Crea una contraseña segura">

                    </div>

                    <?php if(isset($_GET['password_error'])){ ?>

                        <span class="input-message">

                            <?php
                            echo $_GET['password_error'];
                            ?>

                        </span>

                    <?php } ?>

                </div>

                <!-- CONFIRMAR -->
                <div class="input-group">

                    <label>
                        Confirmar contraseña
                    </label>

                    <div class="input-box <?php
                    if(isset($_GET['confirmar_error'])){
                        echo 'input-error';
                    }
                    ?>">

                        <i class="ri-shield-check-line"></i>

                        <input
                        type="password"
                        name="confirmar_password"
                        placeholder="Repite tu contraseña">

                    </div>

                    <?php if(isset($_GET['confirmar_error'])){ ?>

                        <span class="input-message">

                            <?php
                            echo $_GET['confirmar_error'];
                            ?>

                        </span>

                    <?php } ?>

                </div>

                <!-- BUTTON -->
                <button
                type="submit"
                name="register"
                class="login-btn">

                    Crear Cuenta

                </button>

            </form>

            <div class="register-link">

                ¿Ya tienes cuenta?

                <a href="login-view.php">
                    Inicia sesión
                </a>

            </div>

        </div>

    </div>

</section>

<?php include("../../shared/footer.php"); ?>

</body>
</html>