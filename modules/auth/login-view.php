<!--Trabajo_GrupalWeb/modules/auth/login-view.php-->

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión | GameStore</title>

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
        href="login.css">
    <link
rel="stylesheet"
href="../../shared/navbar.css">
</head>

<body>

    <!-- NAVBAR -->
    <?php include("../../shared/navbar.php"); ?>



    <!-- LOGIN -->
    <section class="login-page">

        <div class="login-overlay"></div>

        <div class="container-custom login-container">

            <!-- LEFT -->
            <div class="login-left">

                <span class="login-badge">
                    BIENVENIDO DE NUEVO
                </span>

                <h1>
                    INICIA SESIÓN
                    <span>
                        EN TU CUENTA
                    </span>
                </h1>

                <p>
                    Accede a tu cuenta para continuar disfrutando
                    de la mejor experiencia gamer.
                </p>



                <div class="login-benefits">

                    <div class="login-benefit">

                        <div class="login-benefit-icon">
                            <i class="ri-shield-check-line"></i>
                        </div>

                        <div>

                            <h4>
                                Compra segura
                            </h4>

                            <p>
                                Tus datos están protegidos
                            </p>

                        </div>

                    </div>



                    <div class="login-benefit">

                        <div class="login-benefit-icon">
                            <i class="ri-heart-3-line"></i>
                        </div>

                        <div>

                            <h4>
                                Lista de deseos
                            </h4>

                            <p>
                                Guarda tus productos favoritos
                            </p>

                        </div>

                    </div>



                    <div class="login-benefit">

                        <div class="login-benefit-icon">
                            <i class="ri-shopping-bag-line"></i>
                        </div>

                        <div>

                            <h4>
                                Historial de compras
                            </h4>

                            <p>
                                Revisa tus pedidos anteriores
                            </p>

                        </div>

                    </div>

                </div>

            </div>



            <!-- RIGHT -->
            <div class="login-card">

  

    <div class="login-logo">

                    <i class="ri-gamepad-line"></i>

                </div>

                <h2>
                    Iniciar Sesión
                </h2>

                <p>
                    Ingresa tus credenciales para continuar
                </p>



                <form action="auth-controller.php" method="POST" class="login-form">

                    <!-- EMAIL -->
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
            placeholder="Ejemplo: usuario@correo.com"
            value="<?php
                echo isset($_GET['correo'])
                ? htmlspecialchars($_GET['correo'])
                : '';
            ?>">

    </div>

    <?php if(isset($_GET['correo_error'])){ ?>

        <span class="input-message">

            <?php echo $_GET['correo_error']; ?>

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
            placeholder="Ingresa tu contraseña">

        <i class="ri-eye-off-line"></i>

    </div>

    <?php if(isset($_GET['password_error'])){ ?>

        <span class="input-message">

            <?php echo $_GET['password_error']; ?>

        </span>

    <?php } ?>

</div>
                    <!-- OPTIONS -->
                    <div class="login-options">

                        <label class="remember-me">

                            <input type="checkbox">

                            Recordarme

                        </label>

                        <a href="#">
                            ¿Olvidaste tu contraseña?
                        </a>

                    </div>



                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="login-btn"
                        name="login">
                        

                        Iniciar Sesión

                    </button>

                </form>



                <!-- SOCIAL -->
                <div class="login-divider">

                    <span>
                        o continúa con
                    </span>

                </div>



                <div class="social-login">

                    <button>

                        <i class="ri-google-fill"></i>

                        Google

                    </button>

                    <button>

                        <i class="ri-facebook-circle-fill"></i>

                        Facebook

                    </button>

                </div>



                <div class="register-link">

                    ¿No tienes cuenta?

                    <a href="#">
                        Regístrate aquí
                    </a>

                </div>

            </div>

        </div>

    </section>



    <!-- FOOTER -->
    <?php include("../../shared/footer.php"); ?>

</body>
</html>