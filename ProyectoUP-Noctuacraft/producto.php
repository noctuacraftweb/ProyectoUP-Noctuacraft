<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto — Noctuacraft</title>
    <meta name="description" content="Detalle de producto de impresión 3D — Noctuacraft">
    <link rel="stylesheet" href="styles.css?v=1.5">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @font-face {
            font-family: 'Lovelo Line';
            src: url('https://fonts.cdnfonts.com/css/lovelo') format('woff2');
            font-weight: 700;
            font-display: swap;
        }

        /* ====== HEADER BUTTONS ====== */
        .header-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-header {
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-family: 'Bree Serif', serif;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            letter-spacing: 0.3px;
        }

        .btn-header-outline {
            background: transparent;
            color: var(--moonlight);
            border: 1.5px solid rgba(233, 226, 214, 0.3);
        }

        .btn-header-outline:hover {
            border-color: var(--print-orange);
            color: var(--print-orange);
        }

        .btn-header-fill {
            background: var(--print-orange);
            color: var(--night-blue);
            border: 1.5px solid var(--print-orange);
            font-weight: 600;
        }

        .btn-header-fill:hover {
            background: transparent;
            color: var(--print-orange);
        }

        @media (max-width: 600px) {
            .header-actions { gap: 0.4rem; }
            .btn-header { padding: 0.4rem 0.8rem; font-size: 0.78rem; }
        }

        /* ====== PRODUCT DETAIL ====== */
        .product-detail {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: clamp(6rem, 12vw, 8rem) clamp(1.2rem, 5vw, 2.5rem) clamp(3rem, 6vw, 5rem);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding-top: 5.5rem;
            }
        }

        /* ====== CAROUSEL ====== */
        .carousel-container {
            position: relative;
            border-radius: var(--radius-md);
            overflow: hidden;
            background: var(--dark-blue);
            border: 1px solid rgba(255, 107, 53, 0.15);
        }

        .carousel-track {
            display: flex;
            transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .carousel-slide {
            position: relative;
            min-width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #06090f;
        }

        .slide-blur-bg {
            position: absolute;
            inset: -15px;
            background-size: cover;
            background-position: center;
            filter: blur(12px) brightness(0.45);
            z-index: 1;
            opacity: 0.65;
        }

        .slide-main-img {
            position: relative;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            z-index: 2;
            display: block;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(10, 14, 23, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 107, 53, 0.3);
            color: var(--moonlight);
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
        }

        .carousel-btn:hover {
            background: var(--print-orange);
            color: var(--night-blue);
            border-color: var(--print-orange);
        }

        .carousel-btn.prev { left: 12px; }
        .carousel-btn.next { right: 12px; }

        .carousel-dots {
            position: absolute;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 5;
        }

        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(233, 226, 214, 0.3);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: var(--print-orange);
            transform: scale(1.2);
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.5);
        }

        /* ====== PRODUCT INFO ====== */
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .product-category {
            display: inline-block;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: fit-content;
        }

        .cat-llaveros { background: rgba(255, 107, 53, 0.15); color: var(--print-orange); }
        .cat-deco_hogar { background: rgba(78, 205, 196, 0.15); color: var(--filament-green); }
        .cat-utilidades { background: rgba(0, 168, 255, 0.15); color: var(--tech-blue); }
        .cat-juegos { background: rgba(233, 226, 214, 0.15); color: var(--moonlight); }

        .product-name {
            font-family: 'Lovelo Line', sans-serif;
            font-size: clamp(1.6rem, 4vw, 2.2rem);
            color: var(--moonlight);
            margin: 0;
            line-height: 1.3;
        }

        .product-price {
            font-family: 'Lovelo Line', sans-serif;
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            color: var(--print-orange);
            font-weight: 700;
            margin: 0;
        }

        .product-description {
            color: rgba(233, 226, 214, 0.8);
            line-height: 1.8;
            font-size: 0.95rem;
            margin: 0;
        }

        .product-actions {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-product {
            padding: 0.85rem 1.8rem;
            border-radius: var(--radius-sm);
            font-family: 'Bree Serif', serif;
            font-size: 0.95rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            justify-content: center;
            min-width: 180px;
        }

        .btn-cart {
            background: var(--print-orange);
            color: var(--night-blue);
            cursor: not-allowed;
            opacity: 0.5;
        }

        .btn-buy {
            background: var(--filament-green);
            color: var(--night-blue);
            cursor: not-allowed;
            opacity: 0.5;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--tech-blue);
            text-decoration: none;
            font-family: 'Bree Serif', serif;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-back:hover {
            color: var(--print-orange);
            transform: translateX(-4px);
        }

        /* ====== LOADING STATE ====== */
        .detail-loading {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
            gap: 1.5rem;
        }

        .detail-spinner {
            width: 48px;
            height: 48px;
            border: 3px solid rgba(255, 107, 53, 0.2);
            border-top-color: var(--print-orange);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ====== ERROR STATE ====== */
        .detail-error {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
        }

        .detail-error-icon {
            font-size: 3.5rem;
            color: var(--print-orange);
            margin-bottom: 1.5rem;
            opacity: 0.6;
        }

        .detail-error h2 {
            color: var(--moonlight);
            margin-bottom: 0.75rem;
        }

        .detail-error p {
            color: rgba(233, 226, 214, 0.6);
        }

        /* ====== DISABLED TOOLTIP ====== */
        .btn-product[disabled] {
            position: relative;
        }

        .btn-product[disabled]:hover::after {
            content: 'Próximamente';
            position: absolute;
            top: -35px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark-blue);
            color: var(--moonlight);
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            border: 1px solid rgba(255, 107, 53, 0.2);
            pointer-events: none;
        }
    </style>
</head>
<body>

    <!-- ====== HEADER ====== -->
    <header id="mainHeader">
        <div class="nav-container">
            <a href="index.php" class="logo" id="logoLink">
                <div class="logo-img">
                    <img src="assets/img/noctua3d.jpg" alt="Noctua3D Logo" class="logo-image">
                </div>
                <div class="logo-text-container">
                    <span>Noctua3D</span>
                    <span class="logo-slogan">De tus ideas a tus manos</span>
                </div>
            </a>
            <div class="header-actions">
                <button class="btn-header btn-header-outline" id="btnCrearCuenta" disabled title="Próximamente">
                    <i class="fa-solid fa-user-plus"></i> Crear cuenta
                </button>
                <button class="btn-header btn-header-fill" id="btnIniciarSesion" disabled title="Próximamente">
                    <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
                </button>
            </div>
        </div>
    </header>

    <!-- ====== PRODUCT DETAIL ====== -->
    <div class="product-detail" id="productDetail">
        <div class="detail-loading" id="detailLoading">
            <div class="detail-spinner"></div>
            <p>Cargando producto...</p>
        </div>
    </div>

    <!-- ====== FOOTER ====== -->
    <footer>
        <div class="footer-content">
            <a href="index.php" class="logo">
                <div class="logo-img">
                    <img src="assets/img/logo2.svg" alt="Noctuacraft Logo" class="logo-image">
                </div>
                Noctuacraft
            </a>
            <div class="social-links">
                <a href="https://www.instagram.com/noctuacraft.web/" class="social-link" id="socialInstagram" title="Instagram" target="_blank" rel="noopener">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.tiktok.com/@noctuacraft" class="social-link" id="socialTikTok" title="TikTok" target="_blank" rel="noopener">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
            </div>
            <p class="copyright">&copy; <span id="yearFooter"></span> Noctuacraft. Todos los derechos reservados.</p>
        </div>
    </footer>

    <a href="https://wa.me/5491160244156?text=Hola%20Noctuacraft!" class="floating-duck" id="whatsappFloat" target="_blank" rel="noopener" title="Contactanos por WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <script>
    // ====== AÑO DINÁMICO ======
    document.getElementById('yearFooter').textContent = new Date().getFullYear();

    // ====== HEADER SCROLL ======
    window.addEventListener('scroll', function() {
        document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 60);
    });

    // ====== MAPA DE CATEGORÍAS ======
    const CATEGORIAS = {
        'llaveros': 'Llaveros',
        'deco_hogar': 'Deco & Hogar',
        'utilidades': 'Utilidades',
        'juegos': 'Juegos'
    };

    // ====== OBTENER ID DE LA URL ======
    const params = new URLSearchParams(window.location.search);
    const productoId = params.get('id');

    if (!productoId) {
        mostrarError('Producto no especificado', 'No se indicó qué producto querés ver.');
    } else {
        cargarProducto(productoId);
    }

    async function cargarProducto(id) {
        const container = document.getElementById('productDetail');

        try {
            const response = await fetch('api/productos.php?id=' + encodeURIComponent(id));
            const data = await response.json();

            if (data.error) {
                mostrarError('Producto no encontrado', data.error);
                return;
            }

            // Actualizar título de la página
            document.title = data.nombre + ' — Noctuacraft';

            const catLabel = CATEGORIAS[data.categoria] || data.categoria;
            const catClass = 'cat-' + data.categoria;

            // Construir carrusel
            let carouselHTML = '';
            const imagenes = data.imagenes && data.imagenes.length > 0 
                ? data.imagenes 
                : ['data:image/svg+xml;base64,' + btoa('<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" fill="#121826"><rect width="600" height="450"/><text x="300" y="235" fill="#8b6b4c" font-size="18" text-anchor="middle" font-family="sans-serif">Sin imagen disponible</text></svg>')];

            carouselHTML += '<div class="carousel-container" id="carousel">';
            carouselHTML += '<div class="carousel-track" id="carouselTrack">';
            imagenes.forEach(function(img, i) {
                carouselHTML += '<div class="carousel-slide">' +
                    '<div class="slide-blur-bg" style="background-image: url(\'' + img + '\')"></div>' +
                    '<img src="' + img + '" alt="' + data.nombre + ' - imagen ' + (i + 1) + '" class="slide-main-img">' +
                '</div>';
            });
            carouselHTML += '</div>';

            if (imagenes.length > 1) {
                carouselHTML += '<button class="carousel-btn prev" id="carouselPrev" aria-label="Imagen anterior"><i class="fa-solid fa-chevron-left"></i></button>';
                carouselHTML += '<button class="carousel-btn next" id="carouselNext" aria-label="Imagen siguiente"><i class="fa-solid fa-chevron-right"></i></button>';
                carouselHTML += '<div class="carousel-dots" id="carouselDots">';
                imagenes.forEach(function(_, i) {
                    carouselHTML += '<button class="carousel-dot' + (i === 0 ? ' active' : '') + '" data-index="' + i + '" aria-label="Ir a imagen ' + (i + 1) + '"></button>';
                });
                carouselHTML += '</div>';
            }
            carouselHTML += '</div>';

            // Construir info
            let infoHTML = '<div class="product-info">';
            infoHTML += '<a href="index.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Volver al catálogo</a>';
            infoHTML += '<span class="product-category ' + catClass + '">' + catLabel + '</span>';
            infoHTML += '<h1 class="product-name">' + data.nombre + '</h1>';
            infoHTML += '<p class="product-price">$' + data.precio.toLocaleString('es-AR', {minimumFractionDigits: 2}) + '</p>';
            var descHtml = (data.descripcion || '').replace(/\n/g, '<br>');
            infoHTML += '<p class="product-description">' + descHtml + '</p>';
            infoHTML += '<div class="product-actions">';
            infoHTML += '<button class="btn-product btn-cart" id="btnAddCart" disabled title="Próximamente"><i class="fa-solid fa-cart-plus"></i> Agregar al carrito</button>';
            infoHTML += '<button class="btn-product btn-buy" id="btnBuyNow" disabled title="Próximamente"><i class="fa-solid fa-bolt"></i> Comprar ahora</button>';
            infoHTML += '</div>';
            infoHTML += '</div>';

            container.innerHTML = carouselHTML + infoHTML;

            // Inicializar carrusel
            if (imagenes.length > 1) {
                initCarousel(imagenes.length);
            }

        } catch (err) {
            console.error('Error cargando producto:', err);
            mostrarError('Error de conexión', 'No se pudo cargar el producto. Intentá de nuevo más tarde.');
        }
    }

    function mostrarError(titulo, mensaje) {
        const container = document.getElementById('productDetail');
        container.innerHTML = `
            <div class="detail-error">
                <div class="detail-error-icon"><i class="fa-solid fa-cube"></i></div>
                <h2>${titulo}</h2>
                <p>${mensaje}</p>
                <a href="index.php" class="btn-back" style="margin-top:1.5rem; justify-content:center;">
                    <i class="fa-solid fa-arrow-left"></i> Volver al catálogo
                </a>
            </div>
        `;
    }

    // ====== CARRUSEL ======
    function initCarousel(total) {
        let current = 0;
        const track = document.getElementById('carouselTrack');
        const dots = document.querySelectorAll('.carousel-dot');

        function goTo(index) {
            if (index < 0) index = total - 1;
            if (index >= total) index = 0;
            current = index;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            dots.forEach(function(dot, i) {
                dot.classList.toggle('active', i === current);
            });
        }

        document.getElementById('carouselPrev').addEventListener('click', function() {
            goTo(current - 1);
        });

        document.getElementById('carouselNext').addEventListener('click', function() {
            goTo(current + 1);
        });

        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                goTo(parseInt(this.dataset.index));
            });
        });

        // Swipe support for mobile
        let startX = 0;
        const carousel = document.getElementById('carousel');

        carousel.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
        }, {passive: true});

        carousel.addEventListener('touchend', function(e) {
            const diff = startX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                goTo(diff > 0 ? current + 1 : current - 1);
            }
        }, {passive: true});
    }
    </script>

</body>
</html>
