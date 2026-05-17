<!--Trabajo_GrupalWeb/shared/navbar.php-->

<header class="navbar">

    <div class="container-custom nav-content">

        <!-- LOGO -->
        <div class="logo">

            <a href="../../modules/home/home-view.php">

                <img
                src="../../assets/img/icons/logo-gamer.png"
                alt="Logo GameStore">

            </a>

            <h1>

                <span class="logo-white">
                    Game
                </span>

                <span class="logo-red">
                    Store
                </span>

            </h1>

        </div>



        <!-- LINKS -->
        <nav class="nav-links">

            <a href="../../modules/home/home-view.php" class="active-link">
                Inicio
            </a>

            <a href="../../modules/products/products-view.php">
                Productos
            </a>

            <a href="../../modules/categories/categories-view.php">
                Categorías
            </a>

            <a href="../../modules/promotions/promotions-view.php">
                Promociones
            </a>

            <a href="../../modules/about/about-view.php">
                Nosotros
            </a>

            <a href="../../modules/contact/contact-view.php">
                Contacto
            </a>

        </nav>



        <!-- ICONOS -->
        <div class="nav-icons">

            <a href="#">
                <i class="ri-heart-3-line"></i>
            </a>

            <a href="#">
                <i class="ri-shopping-cart-2-line"></i>
            </a>

        </div>



        <!-- ACCIONES -->
        <div class="nav-actions">

            <input
            type="text"
            placeholder="Buscar productos...">

            <?php if(isset($_SESSION['usuario_id'])){ ?>

    <a
    href="../../modules/auth/logout.php"
    class="btn-login">

        Cerrar Sesión

    </a>

<?php }else{ ?>

    <a
    href="../../modules/auth/login-view.php"
    class="btn-login">

        Iniciar Sesión

    </a>

<?php } ?>

        </div>

    </div>

</header>