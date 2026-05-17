<?php
/*Trabajo_GrupalWeb/modules/home/home-view.php*/

require_once("home-controller.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>GameStore</title>

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
        href="home.css">

</head>

<body>

    <!-- NAVBAR -->
    <?php include("../../shared/navbar.php"); ?>



    <!-- HERO -->
    <section class="hero">

        <div class="hero-overlay"></div>

        <div class="container-custom hero-container">

            <div class="hero-content">

                <span class="hero-badge">
                    #1 EN EQUIPOS GAMER
                </span>

                <h1>
                    EQUIPOS GAMER
                    <span>
                        DE LA MAS ALTA CALIDAD
                    </span>
                </h1>

                <p>
                    Descubre los mejores productos gamer con la más alta
                    tecnología, potencia y rendimiento para dominar cada partida.
                </p>

                <div class="hero-buttons">

                    <a href="#" class="btn-primary-custom">
                        <i class="ri-shopping-cart-2-line"></i>
                        Ver Productos
                    </a>

                    <a href="#" class="btn-secondary-custom">
                        <i class="ri-apps-2-line"></i>
                        Explorar Categorías
                    </a>

                </div>



                <!-- BENEFICIOS -->
                <div class="hero-benefits">

                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="ri-truck-line"></i>
                        </div>

                        <div>

                            <h4>
                                Envío Rápido
                            </h4>

                            <p>
                                A todo el país
                            </p>

                        </div>

                    </div>



                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="ri-shield-check-line"></i>
                        </div>

                        <div>

                            <h4>
                                Garantía Oficial
                            </h4>

                            <p>
                                Hasta 2 años
                            </p>

                        </div>

                    </div>



                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="ri-customer-service-2-line"></i>
                        </div>

                        <div>

                            <h4>
                                Soporte 24/7
                            </h4>

                            <p>
                                Siempre disponible
                            </p>

                        </div>

                    </div>



                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="ri-bank-card-line"></i>
                        </div>

                        <div>

                            <h4>
                                Pagos Seguros
                            </h4>

                            <p>
                                100% confiables
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>





    <!-- CATEGORÍAS -->
    <section class="categories">

        <div class="container-custom">

            <div class="section-header">

                <h2 class="section-title">
                    Categorías Principales
                </h2>

                <a href="#" class="section-link">
                    Ver todas
                    <i class="ri-arrow-right-line"></i>
                </a>

            </div>



            <div class="grid-5">

                <!-- CARD -->
                <div class="category-card">

                    <div class="category-image">

                        <img
                            src="../../assets/img/categories/categoria-laptop.jpg"
                            alt="Laptop Gamer">

                    </div>

                    <div class="category-info">

                        <h3>
                            Laptops Gamer
                        </h3>

                        <a href="#">
                            Ver productos
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>



                <!-- CARD -->
                <div class="category-card">

                    <div class="category-image">

                        <img
                            src="../../assets/img/categories/categoria-monitor.jpg"
                            alt="Monitores">

                    </div>

                    <div class="category-info">

                        <h3>
                            Monitores
                        </h3>

                        <a href="#">
                            Ver productos
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>



                <!-- CARD -->
                <div class="category-card">

                    <div class="category-image">

                        <img
                            src="../../assets/img/categories/categoria-mouse.jpg"
                            alt="Mouse Gamer">

                    </div>

                    <div class="category-info">

                        <h3>
                            Mouse
                        </h3>

                        <a href="#">
                            Ver productos
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>



                <!-- CARD -->
                <div class="category-card">

                    <div class="category-image">

                        <img
                            src="../../assets/img/categories/categoria-teclado.jpg"
                            alt="Teclados">

                    </div>

                    <div class="category-info">

                        <h3>
                            Teclados
                        </h3>

                        <a href="#">
                            Ver productos
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>



                <!-- CARD -->
                <div class="category-card">

                    <div class="category-image">

                        <img
                            src="../../assets/img/categories/categoria-consola.jpg"
                            alt="Consolas">

                    </div>

                    <div class="category-info">

                        <h3>
                            Consolas
                        </h3>

                        <a href="#">
                            Ver productos
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>






    <!-- PRODUCTOS -->
    <section class="products">

        <div class="container-custom">

            <div class="section-header">

                <h2 class="section-title">
                    Productos Destacados
                </h2>

                <a href="#" class="section-link">
                    Ver todos
                    <i class="ri-arrow-right-line"></i>
                </a>

            </div>



            <div class="grid-5">

                <?php while($producto = mysqli_fetch_assoc($productos)){ ?>

                    <div class="product-card">

                        <!-- BADGE -->
                        <span class="product-badge">

                            <?php
                                if($producto['stock'] > 10){
                                    echo "NUEVO";
                                }else{
                                    echo "OFERTA";
                                }
                            ?>

                        </span>



                        <!-- FAVORITO -->
                        <button class="wishlist-btn">

                            <i class="ri-heart-line"></i>

                        </button>



                        <!-- IMAGEN -->
                        <div class="product-image">

                            <img
                                src="../../assets/img/productos/<?php echo $producto['imagen']; ?>"
                                alt="<?php echo $producto['nombre']; ?>">

                        </div>



                        <!-- INFO -->
                        <div class="product-info">

                            <h3>
                                <?php echo $producto['nombre']; ?>
                            </h3>



                            <p class="product-specs">

                                <?php
                                    echo $producto['descripcion'];
                                ?>

                            </p>



                            <!-- ESTRELLAS -->
                            <div class="product-rating">

                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-fill"></i>

                                <span>
                                    (24)
                                </span>

                            </div>



                            <!-- PRECIOS -->
                            <div class="product-prices">

                                <span class="price">
                                    $<?php echo $producto['precio']; ?>
                                </span>

                                <span class="old-price">

                                    $<?php echo $producto['precio'] + 50; ?>

                                </span>

                            </div>



                            <!-- BOTÓN -->
                            <button class="buy-btn">

                                <i class="ri-shopping-cart-2-line"></i>

                            </button>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </section>







    <!-- NEWSLETTER -->
    <section class="newsletter">

        <div class="container-custom">

            <div class="newsletter-content">

                <div class="newsletter-text">

                    <h2>
                        ÚNETE A LA COMUNIDAD GAMER
                    </h2>

                    <p>
                        Recibe ofertas exclusivas, novedades y descuentos especiales.
                    </p>

                </div>



                <form class="newsletter-form">

                    <input
                        type="email"
                        placeholder="Ingresa tu correo electrónico">

                    <button type="submit">

                        Suscribirme

                    </button>

                </form>



                <div class="newsletter-benefits">

                    <div>

                        <i class="ri-coupon-3-line"></i>
                        <span>5% Descuento</span>

                    </div>

                    <div>

                        <i class="ri-fire-line"></i>
                        <span>Ofertas Exclusivas</span>

                    </div>

                    <div>

                        <i class="ri-notification-3-line"></i>
                        <span>Novedades</span>

                    </div>

                </div>

            </div>

        </div>

    </section>





    <!-- FOOTER -->
    <?php include("../../shared/footer.php"); ?>

</body>
</html>