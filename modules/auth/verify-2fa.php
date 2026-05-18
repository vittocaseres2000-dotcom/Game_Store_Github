<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Verificación 2FA | GameStore
    </title>

    <!-- GOOGLE FONTS -->
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- REMIX ICONS -->
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet">

    <!-- CSS -->
    <link
    rel="stylesheet"
    href="../../shared/navbar.css">

    <link
    rel="stylesheet"
    href="verify-2fa.css">

</head>

<body>

<?php include("../../shared/navbar.php"); ?>

<section class="verify-page">

    <div class="container-custom verify-container">

        <!-- LEFT -->
        <div class="verify-left">

            <span class="verify-badge">

                SEGURIDAD AVANZADA

            </span>

            <h1>

                VERIFICA TU
                <span>
                    CUENTA GAMER
                </span>

            </h1>

            <p>

                Hemos enviado un código de seguridad
                a tu correo electrónico para proteger
                tu cuenta y tus compras.

            </p>



            <!-- BENEFITS -->
            <div class="verify-benefits">

                <div class="verify-benefit">

                    <div class="verify-benefit-icon">

                        <i class="ri-mail-check-line"></i>

                    </div>

                    <div>

                        <h4>
                            Código Temporal
                        </h4>

                        <p>
                            Protección contra accesos no autorizados
                        </p>

                    </div>

                </div>



                <div class="verify-benefit">

                    <div class="verify-benefit-icon">

                        <i class="ri-shield-check-line"></i>

                    </div>

                    <div>

                        <h4>
                            Seguridad 2FA
                        </h4>

                        <p>
                            Verificación en dos pasos
                        </p>

                    </div>

                </div>



                <div class="verify-benefit">

                    <div class="verify-benefit-icon">

                        <i class="ri-lock-star-line"></i>

                    </div>

                    <div>

                        <h4>
                            Cuenta Protegida
                        </h4>

                        <p>
                            Mayor seguridad para tus datos
                        </p>

                    </div>

                </div>

            </div>

        </div>



        <!-- RIGHT -->
        <div class="verify-card">

            <div class="verify-logo">

                <i class="ri-shield-keyhole-line"></i>

            </div>

            <h2>
                Verificación 2FA
            </h2>

            <p>

                Ingresa el código enviado
                a tu correo electrónico

            </p>



            <form
            action="verify-code.php"
            method="POST"
            class="verify-form">

                <div class="code-container">

                    <input
                    type="text"
                    maxlength="1"
                    name="c1"
                    required>

                    <input
                    type="text"
                    maxlength="1"
                    name="c2"
                    required>

                    <input
                    type="text"
                    maxlength="1"
                    name="c3"
                    required>

                    <input
                    type="text"
                    maxlength="1"
                    name="c4"
                    required>

                    <input
                    type="text"
                    maxlength="1"
                    name="c5"
                    required>

                    <input
                    type="text"
                    maxlength="1"
                    name="c6"
                    required>

                </div>



                <button
                type="submit"
                class="verify-btn">

                    Verificar Cuenta

                </button>

            </form>



            <div class="resend-code">

                ¿No recibiste el código?

                <a href="#">
                    Reenviar código
                </a>

            </div>

        </div>

    </div>

</section>

<?php include("../../shared/footer.php"); ?>

</body>
</html>