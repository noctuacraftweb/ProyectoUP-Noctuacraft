<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noctuacraft — Impresión 3D</title>
    <meta name="description" content="Catálogo de productos de impresión 3D: llaveros, decoración, utilidades y juegos. Noctuacraft, diseño e innovación.">
    <link rel="stylesheet" href="styles.css?v=1.5">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ====== FUENTE LOVELO ====== */
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
            transform: translateY(-2px);
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
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(255, 107, 53, 0.3);
        }

        /* ====== HERO CTA ====== */
        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--print-orange);
            color: var(--night-blue);
            padding: 0.85rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-family: 'Bree Serif', serif;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeInUp 1s ease 1.1s forwards;
            margin-top: 1rem;
        }

        .hero-cta:hover {
            background: var(--tech-blue);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 168, 255, 0.35);
        }

        /* ====== PRODUCT CARD LINK ====== */
        .product-link {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* ====== CATEGORY BADGE ====== */
        .category-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
            width: fit-content;
        }

        .cat-llaveros { background: rgba(255, 107, 53, 0.15); color: var(--print-orange); }
        .cat-deco_hogar { background: rgba(78, 205, 196, 0.15); color: var(--filament-green); }
        .cat-utilidades { background: rgba(0, 168, 255, 0.15); color: var(--tech-blue); }
        .cat-juegos { background: rgba(233, 226, 214, 0.15); color: var(--moonlight); }

        /* ====== GALLERY 2 COLUMNS ====== */
        .gallery-3d {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        @media (max-width: 768px) {
            .gallery-3d {
                grid-template-columns: 1fr !important;
            }
        }

        /* ====== RESPONSIVE HEADER ====== */
        @media (max-width: 600px) {
            .header-actions {
                gap: 0.4rem;
            }
            .btn-header {
                padding: 0.4rem 0.8rem;
                font-size: 0.78rem;
            }
        }

        /* ====== SKELETON LOADING ====== */
        .skeleton-card {
            background: var(--night-blue);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: 0 0 0 6px rgba(255, 107, 53, 0.1), 0 8px 32px rgba(0, 0, 0, 0.35);
        }

        .skeleton-img {
            width: 100%;
            height: 220px;
            background: linear-gradient(90deg, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.03) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s ease-in-out infinite;
        }

        .skeleton-text {
            padding: 1.4rem 1.5rem 1.6rem;
        }

        .skeleton-line {
            height: 14px;
            border-radius: 7px;
            background: linear-gradient(90deg, rgba(255,255,255,0.03) 25%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.03) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s ease-in-out infinite;
            margin-bottom: 0.75rem;
        }

        .skeleton-line:nth-child(1) { width: 40%; }
        .skeleton-line:nth-child(2) { width: 80%; }
        .skeleton-line:nth-child(3) { width: 30%; }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
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

    <!-- ====== HERO ====== -->
    <section class="hero-3d" id="heroSection">
        <div class="hero-bg">
            <div class="stars" id="starsContainer"></div>
            <div class="layer-3d"></div>
        </div>
        <div class="hero-content">
            <h1>Noctua3D</h1>
            <p>Diseños únicos impresos en 3D. Llaveros, decoración, utilidades y juegos pensados para vos.</p>
            <a href="#galeria" class="hero-cta">
                <i class="fa-solid fa-layer-group"></i> Ver productos
            </a>
        </div>
    </section>

    <!-- ====== GALERÍA DE PRODUCTOS ====== -->
    <section class="gallery-section" id="galeria">
        <div class="section-title">
            <h2>Nuestros Productos</h2>
            <p>Explorá lo que tenemos para ofrecerte</p>
        </div>
        <div class="catalog-controls">
            <div class="search-bar" title="Próximamente">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar producto..." disabled>
            </div>
            <div class="filters">
                <button class="filter-btn active disabled" title="Próximamente">Todos</button>
                <button class="filter-btn disabled" title="Próximamente">Llaveros</button>
                <button class="filter-btn disabled" title="Próximamente">Deco & Hogar</button>
                <button class="filter-btn disabled" title="Próximamente">Utilidades</button>
                <button class="filter-btn disabled" title="Próximamente">Juegos</button>
            </div>
        </div>
        <div class="gallery-3d" id="dynamicGallery">
            <!-- Skeleton loaders -->
            <div class="skeleton-card"><div class="skeleton-img"></div><div class="skeleton-text"><div class="skeleton-line"></div><div class="skeleton-line"></div><div class="skeleton-line"></div></div></div>
            <div class="skeleton-card"><div class="skeleton-img"></div><div class="skeleton-text"><div class="skeleton-line"></div><div class="skeleton-line"></div><div class="skeleton-line"></div></div></div>
            <div class="skeleton-card"><div class="skeleton-img"></div><div class="skeleton-text"><div class="skeleton-line"></div><div class="skeleton-line"></div><div class="skeleton-line"></div></div></div>
            <div class="skeleton-card"><div class="skeleton-img"></div><div class="skeleton-text"><div class="skeleton-line"></div><div class="skeleton-line"></div><div class="skeleton-line"></div></div></div>
        </div>
    </section>

    <!-- ====== CTA DISEÑO PERSONALIZADO ====== -->
    <section class="custom-cta-section" id="customCta">
        <div class="custom-cta-card">
            <div class="custom-cta-icon">
                <i class="fa-solid fa-pen-ruler"></i>
            </div>
            <h3>¿Tenés algún diseño en mente o no encontrás el producto que querías?</h3>
            <p>En Noctua3D también diseñamos e imprimimos pedidos personalizados.</p>
            <a href="https://wa.me/5491160244156?text=Hola%2C%20me%20interesa%20hacer%20un%20dise%C3%B1o%20personalizado" class="custom-cta-btn" target="_blank" rel="noopener" id="btnCustomDesign">
                <i class="fa-brands fa-whatsapp"></i> Consultanos por WhatsApp
            </a>
        </div>
    </section>

    <!-- ====== SERVICIOS ====== -->
    <section class="servicios-section" id="servicios">
        <div class="section-title">
            <h2>Nuestros Servicios</h2>
            <p>Más allá de la impresión 3D, también podemos ayudarte con esto</p>
        </div>
        <div class="servicios-grid">
            <div class="servicio-card">
                <div class="servicio-icon" style="width: 48px; height: 48px;">
                    <img src="assets/img/noctuaclean.jpg" alt="NoctuaClean Logo" class="servicio-logo-img" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>NoctuaClean - Mantenimiento de PC</h3>
                <p>Limpiezas elementales y profundas para darle a tu computadora el cuidado que necesita. Tu equipo en las mejores manos.</p>
                <a href="https://wa.me/5491171164677?text=Hola%20Noctuaclean!%20Me%20interesa%20el%20servicio%20de%20mantenimiento%20de%20PC" class="servicio-btn" target="_blank" rel="noopener" id="btnServicioPC">
                    <i class="fa-brands fa-whatsapp"></i> Consultar por WhatsApp
                </a>
            </div>
            <div class="servicio-card">
                <div class="servicio-icon" style="width: 48px; height: 48px;">
                    <img src="assets/img/logo2.svg" alt="Noctuacraft Logo" class="servicio-logo-img" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Noctuacraft - Diseño Web</h3>
                <p>Páginas web modernas, responsivas y optimizadas. Desde landing pages hasta catálogos completos para tu negocio.</p>
                <a href="https://wa.me/5491171164680?text=Hola%20Noctuacraft!%20Me%20interesa%20el%20servicio%20de%20diseño%20web" class="servicio-btn" target="_blank" rel="noopener" id="btnServicioWeb">
                    <i class="fa-brands fa-whatsapp"></i> Consultar por WhatsApp
                </a>
            </div>
        </div>
    </section>

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

    <!-- ====== PATO FLOTANTE (WhatsApp) ====== -->
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

    // ====== ESTRELLAS DEL HERO ======
    (function() {
        const container = document.getElementById('starsContainer');
        for (let i = 0; i < 60; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            const size = Math.random() * 2.5 + 1;
            star.style.cssText = `
                width: ${size}px; height: ${size}px;
                top: ${Math.random() * 100}%; left: ${Math.random() * 100}%;
                animation-delay: ${Math.random() * 5}s;
                animation-duration: ${3 + Math.random() * 4}s;
            `;
            container.appendChild(star);
        }
    })();

    // ====== MAPA DE CATEGORÍAS ======
    const CATEGORIAS = {
        'llaveros': 'Llaveros',
        'deco_hogar': 'Deco & Hogar',
        'utilidades': 'Utilidades',
        'juegos': 'Juegos'
    };

    // ====== CARGAR PRODUCTOS ======
    async function cargarProductos() {
        const gallery = document.getElementById('dynamicGallery');

        try {
            const response = await fetch('api/productos.php?limit=10&random=true');
            const productos = await response.json();

            if (!Array.isArray(productos) || productos.length === 0) {
                gallery.innerHTML = `
                    <div class="empty-gallery">
                        <div class="empty-gallery-icon"><i class="fa-solid fa-cube"></i></div>
                        <p>Aún no hay productos cargados.<br>¡Volvé pronto!</p>
                    </div>
                `;
                return;
            }

            gallery.innerHTML = productos.map(function(p) {
                const imagen = p.imagen_principal 
                    ? p.imagen_principal 
                    : 'data:image/svg+xml;base64,' + btoa('<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" fill="%23121826"><rect width="400" height="300"/><text x="200" y="160" fill="%238b6b4c" font-size="16" text-anchor="middle" font-family="sans-serif">Sin imagen</text></svg>');
                const catLabel = CATEGORIAS[p.categoria] || p.categoria;
                const catClass = 'cat-' + p.categoria;

                return '<a href="producto.php?id=' + p.id + '" class="gallery-item product-link" id="product-' + p.id + '">' +
                    '<div class="product-image-container">' +
                        '<div class="product-blur-bg" style="background-image: url(\'' + imagen + '\');"></div>' +
                        '<img src="' + imagen + '" alt="' + p.nombre + '" loading="lazy" class="product-card-img">' +
                    '</div>' +
                    '<div class="item-info">' +
                        '<span class="category-badge ' + catClass + '">' + catLabel + '</span>' +
                        '<h3>' + p.nombre + '</h3>' +
                        '<p class="price">$' + p.precio.toLocaleString('es-AR', {minimumFractionDigits: 2}) + '</p>' +
                    '</div>' +
                '</a>';
            }).join('');

        } catch (err) {
            console.error('Error cargando productos:', err);
            gallery.innerHTML = `
                <div class="empty-gallery">
                    <div class="empty-gallery-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <p>Error al cargar los productos.<br>Intentá de nuevo más tarde.</p>
                </div>
            `;
        }
    }

    // Cargar al iniciar
    cargarProductos();
    </script>

</body>
</html>
