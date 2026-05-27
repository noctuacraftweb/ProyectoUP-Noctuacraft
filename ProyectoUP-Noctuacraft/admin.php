<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Noctuacraft</title>
    <meta name="description" content="Panel de administración de Noctuacraft">
    <link rel="stylesheet" href="styles.css?v=1.3">
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

        /* ====== LOGIN SCREEN ====== */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            background: var(--dark-blue);
            border: 1px solid rgba(255, 107, 53, 0.2);
            border-radius: var(--radius-md);
            padding: 3rem 2.5rem;
            max-width: 420px;
            width: 100%;
            text-align: center;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.4);
        }

        .login-logo {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: 2px solid var(--print-orange);
            margin: 0 auto 1.5rem;
            overflow: hidden;
            background: var(--coffee-brown);
        }

        .login-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-card h1 {
            font-family: 'Lovelo Line', sans-serif;
            font-size: 1.6rem;
            color: var(--moonlight);
            margin-bottom: 0.5rem;
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
            opacity: 1;
            animation: none;
        }

        .login-card p {
            color: rgba(233, 226, 214, 0.5);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .login-field {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .login-field input {
            width: 100%;
            padding: 0.85rem 1.2rem 0.85rem 2.8rem;
            background: rgba(10, 14, 23, 0.6);
            border: 1.5px solid rgba(255, 107, 53, 0.15);
            border-radius: var(--radius-sm);
            color: var(--moonlight);
            font-family: 'Bree Serif', serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .login-field input:focus {
            border-color: var(--print-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .login-field .field-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(233, 226, 214, 0.35);
            font-size: 0.9rem;
        }

        .login-btn {
            width: 100%;
            padding: 0.85rem;
            background: var(--print-orange);
            color: var(--night-blue);
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'Bree Serif', serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: var(--tech-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 168, 255, 0.3);
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .login-error {
            color: #ff4757;
            font-size: 0.85rem;
            margin-top: 1rem;
            display: none;
        }

        .login-error.visible {
            display: block;
            animation: fadeInUp 0.3s ease;
        }

        /* ====== ADMIN PANEL ====== */
        .admin-wrapper {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: clamp(6rem, 12vw, 7rem) clamp(1.2rem, 5vw, 2.5rem) 3rem;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-header h1 {
            font-family: 'Lovelo Line', sans-serif;
            font-size: clamp(1.4rem, 3vw, 1.8rem);
            color: var(--moonlight);
            margin: 0;
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
            opacity: 1;
            animation: none;
        }

        .admin-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-admin {
            padding: 0.65rem 1.4rem;
            border-radius: var(--radius-sm);
            font-family: 'Bree Serif', serif;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add {
            background: var(--print-orange);
            color: var(--night-blue);
        }

        .btn-add:hover {
            background: var(--tech-blue);
            transform: translateY(-2px);
        }

        .btn-logout {
            background: transparent;
            color: var(--moonlight);
            border: 1.5px solid rgba(233, 226, 214, 0.2);
        }

        .btn-logout:hover {
            border-color: #ff4757;
            color: #ff4757;
        }

        /* ====== PRODUCT TABLE ====== */
        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }

        .admin-table thead th {
            text-align: left;
            padding: 0.75rem 1rem;
            color: rgba(233, 226, 214, 0.5);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .admin-table tbody tr {
            background: var(--dark-blue);
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
        }

        .admin-table tbody tr:hover {
            background: rgba(18, 24, 38, 0.8);
            transform: translateX(4px);
        }

        .admin-table td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
        }

        .admin-table td:first-child {
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
        }

        .admin-table td:last-child {
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }

        .admin-thumb {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid rgba(255, 107, 53, 0.15);
        }

        .admin-product-name {
            font-weight: 600;
            color: var(--moonlight);
        }

        .admin-category {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .cat-llaveros { background: rgba(255, 107, 53, 0.15); color: var(--print-orange); }
        .cat-deco_hogar { background: rgba(78, 205, 196, 0.15); color: var(--filament-green); }
        .cat-utilidades { background: rgba(0, 168, 255, 0.15); color: var(--tech-blue); }
        .cat-juegos { background: rgba(233, 226, 214, 0.15); color: var(--moonlight); }

        .admin-price {
            font-weight: 700;
            color: var(--print-orange);
        }

        .admin-row-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit, .btn-delete {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: rgba(0, 168, 255, 0.15);
            color: var(--tech-blue);
        }

        .btn-edit:hover {
            background: var(--tech-blue);
            color: var(--night-blue);
        }

        .btn-delete {
            background: rgba(255, 71, 87, 0.15);
            color: #ff4757;
        }

        .btn-delete:hover {
            background: #ff4757;
            color: white;
        }

        .admin-empty {
            text-align: center;
            padding: 4rem 2rem;
            color: rgba(233, 226, 214, 0.4);
        }

        .admin-empty i {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
            opacity: 0.4;
        }

        /* ====== MODAL FORM ====== */
        .admin-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 2000;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
            overflow-y: auto;
            backdrop-filter: blur(4px);
        }

        .admin-modal.active {
            display: flex;
        }

        .admin-modal-content {
            background: var(--dark-blue);
            border-radius: var(--radius-md);
            max-width: 560px;
            width: 100%;
            border: 1px solid rgba(255, 107, 53, 0.2);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.5);
            margin-top: 4rem;
        }

        .admin-modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 107, 53, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-modal-header h2 {
            font-family: 'Lovelo Line', sans-serif;
            font-size: 1.2rem;
            color: var(--print-orange);
            margin: 0;
        }

        .admin-modal-header h2::after {
            display: none;
        }

        .admin-modal-close {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255, 107, 53, 0.1);
            border: 1px solid rgba(255, 107, 53, 0.2);
            color: var(--moonlight);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .admin-modal-close:hover {
            background: var(--print-orange);
            color: var(--night-blue);
        }

        .admin-modal-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-size: 0.85rem;
            color: rgba(233, 226, 214, 0.7);
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(10, 14, 23, 0.6);
            border: 1.5px solid rgba(255, 107, 53, 0.15);
            border-radius: var(--radius-sm);
            color: var(--moonlight);
            font-family: 'Bree Serif', serif;
            font-size: 0.92rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23e9e2d6' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        .form-group select option {
            background: var(--dark-blue);
            color: var(--moonlight);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--print-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-error {
            color: #ff4757;
            font-size: 0.8rem;
            margin-top: 0.3rem;
            display: none;
        }

        /* ====== IMAGE UPLOAD ====== */
        .image-upload-area {
            border: 2px dashed rgba(255, 107, 53, 0.25);
            border-radius: var(--radius-sm);
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .image-upload-area:hover {
            border-color: var(--print-orange);
            background: rgba(255, 107, 53, 0.05);
        }

        .image-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-area i {
            font-size: 2rem;
            color: var(--print-orange);
            opacity: 0.5;
            margin-bottom: 0.75rem;
            display: block;
        }

        .image-upload-area p {
            font-size: 0.85rem;
            color: rgba(233, 226, 214, 0.5);
            margin: 0;
        }

        .image-previews {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .image-preview-item {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(255, 107, 53, 0.2);
        }

        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview-remove {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255, 71, 87, 0.9);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            transition: all 0.2s ease;
        }

        .image-preview-remove:hover {
            background: #ff4757;
            transform: scale(1.1);
        }

        .form-submit {
            width: 100%;
            padding: 0.85rem;
            background: var(--print-orange);
            color: var(--night-blue);
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'Bree Serif', serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .form-submit:hover {
            background: var(--tech-blue);
            transform: translateY(-2px);
        }

        .form-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .form-message {
            text-align: center;
            padding: 0.75rem;
            border-radius: var(--radius-sm);
            margin-top: 1rem;
            font-size: 0.88rem;
            display: none;
        }

        .form-message.success {
            display: block;
            background: rgba(78, 205, 196, 0.1);
            color: var(--filament-green);
            border: 1px solid rgba(78, 205, 196, 0.2);
        }

        .form-message.error {
            display: block;
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: 1px solid rgba(255, 71, 87, 0.2);
        }

        /* ====== CONFIRM MODAL ====== */
        .confirm-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            z-index: 3000;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            backdrop-filter: blur(4px);
        }

        .confirm-modal.active {
            display: flex;
        }

        .confirm-box {
            background: var(--dark-blue);
            border: 1px solid rgba(255, 71, 87, 0.3);
            border-radius: var(--radius-md);
            padding: 2.5rem 2rem;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.5);
        }

        .confirm-box i {
            font-size: 2.5rem;
            color: #ff4757;
            margin-bottom: 1rem;
        }

        .confirm-box h3 {
            color: var(--moonlight);
            font-family: 'Lovelo Line', sans-serif;
            margin-bottom: 0.5rem;
        }

        .confirm-box p {
            color: rgba(233, 226, 214, 0.6);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .confirm-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-confirm-cancel, .btn-confirm-delete {
            flex: 1;
            padding: 0.75rem;
            border-radius: var(--radius-sm);
            font-family: 'Bree Serif', serif;
            font-size: 0.92rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-confirm-cancel {
            background: transparent;
            color: var(--moonlight);
            border: 1.5px solid rgba(233, 226, 214, 0.2);
        }

        .btn-confirm-cancel:hover {
            border-color: var(--moonlight);
        }

        .btn-confirm-delete {
            background: #ff4757;
            color: white;
        }

        .btn-confirm-delete:hover {
            background: #ee3b4b;
            transform: translateY(-2px);
        }

        /* ====== RESPONSIVE ADMIN TABLE ====== */
        @media (max-width: 768px) {
            .admin-table thead {
                display: none;
            }

            .admin-table tbody tr {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                padding: 1rem;
                margin-bottom: 0.5rem;
                border-radius: var(--radius-sm);
                align-items: center;
            }

            .admin-table td {
                padding: 0;
                border-radius: 0 !important;
            }

            .admin-table td:nth-child(1) { flex: 0 0 50px; }
            .admin-table td:nth-child(2) { flex: 1; }
            .admin-table td:nth-child(3) { flex: 0 0 auto; }
            .admin-table td:nth-child(4) { flex: 0 0 auto; }
            .admin-table td:nth-child(5) { flex: 0 0 100%; justify-content: flex-end; }

            .admin-row-actions { justify-content: flex-end; }
        }

        /* ====== ADMIN LOADING ====== */
        .admin-loading {
            text-align: center;
            padding: 4rem 2rem;
        }

        .admin-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(255, 107, 53, 0.2);
            border-top-color: var(--print-orange);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ====== HEADER NAV ====== */
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

        .btn-header-fill {
            background: var(--print-orange);
            color: var(--night-blue);
            border: 1.5px solid var(--print-orange);
            font-weight: 600;
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
            <div class="header-actions" id="headerActions">
                <!-- Dynamic: shows logout when logged in -->
            </div>
        </div>
    </header>

    <!-- ====== LOGIN SCREEN ====== -->
    <div class="login-wrapper" id="loginScreen" style="display: <?php echo isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true ? 'none' : 'flex'; ?>;">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/img/logo2.svg" alt="Noctuacraft Logo">
            </div>
            <h1>Panel Admin</h1>
            <p>Ingresá la contraseña para acceder</p>
            <form id="loginForm" onsubmit="return false;">
                <div class="login-field">
                    <i class="fa-solid fa-lock field-icon"></i>
                    <input type="password" id="loginPassword" placeholder="Contraseña" required autocomplete="current-password">
                </div>
                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
                </button>
                <p class="login-error" id="loginError"></p>
            </form>
        </div>
    </div>

    <!-- ====== ADMIN PANEL ====== -->
    <div class="admin-wrapper" id="adminPanel" style="display: <?php echo isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true ? 'block' : 'none'; ?>;">
        <div class="admin-header">
            <h1><i class="fa-solid fa-shield-halved"></i> Panel de Administración</h1>
            <div class="admin-actions">
                <button class="btn-admin btn-add" id="btnAddProduct">
                    <i class="fa-solid fa-plus"></i> Agregar producto
                </button>
                <button class="btn-admin btn-logout" id="btnLogout">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                </button>
            </div>
        </div>

        <div id="productListContainer">
            <div class="admin-loading" id="adminLoading">
                <div class="admin-spinner"></div>
                <p>Cargando productos...</p>
            </div>
        </div>
    </div>

    <!-- ====== MODAL: CREAR/EDITAR PRODUCTO ====== -->
    <div class="admin-modal" id="productModal">
        <div class="admin-modal-content">
            <div class="admin-modal-header">
                <h2 id="modalTitle">Agregar producto</h2>
                <button class="admin-modal-close" id="modalClose"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="admin-modal-body">
                <form id="productForm" onsubmit="return false;">
                    <input type="hidden" id="productId" value="">

                    <div class="form-group">
                        <label for="productName">Nombre *</label>
                        <input type="text" id="productName" placeholder="Nombre del producto" required>
                    </div>

                    <div class="form-group">
                        <label for="productDesc">Descripción *</label>
                        <textarea id="productDesc" placeholder="Describí el producto..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="productPrice">Precio (ARS) *</label>
                        <input type="number" id="productPrice" placeholder="0.00" step="0.01" min="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="productCategory">Categoría *</label>
                        <select id="productCategory" required>
                            <option value="">Seleccioná una categoría</option>
                            <option value="llaveros">Llaveros</option>
                            <option value="deco_hogar">Deco & Hogar</option>
                            <option value="utilidades">Utilidades</option>
                            <option value="juegos">Juegos</option>
                        </select>
                    </div>

                    <div class="form-group" id="imageUploadGroup">
                        <label>Imágenes</label>
                        <div class="image-upload-area" id="imageUploadArea">
                            <input type="file" id="imageInput" accept="image/*" multiple>
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <p>Hacé clic o arrastrá imágenes aquí<br><small>Se convertirán a WebP automáticamente</small></p>
                        </div>
                        <div class="image-previews" id="imagePreviews"></div>
                    </div>

                    <button type="submit" class="form-submit" id="formSubmitBtn">
                        <i class="fa-solid fa-save"></i> Guardar producto
                    </button>

                    <div class="form-message" id="formMessage"></div>
                </form>
            </div>
        </div>
    </div>

    <!-- ====== MODAL: CONFIRMAR ELIMINACIÓN ====== -->
    <div class="confirm-modal" id="confirmModal">
        <div class="confirm-box">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <h3>¿Eliminar producto?</h3>
            <p id="confirmText">Esta acción no se puede deshacer.</p>
            <div class="confirm-actions">
                <button class="btn-confirm-cancel" id="confirmCancel">Cancelar</button>
                <button class="btn-confirm-delete" id="confirmDelete">Eliminar</button>
            </div>
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
            <p class="copyright">&copy; <span id="yearFooter"></span> Noctuacraft. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
    // ====== GLOBALS ======
    document.getElementById('yearFooter').textContent = new Date().getFullYear();
    let isLoggedIn = <?php echo isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true ? 'true' : 'false'; ?>;
    let pendingDeleteId = null;
    let imageDataArray = []; // base64 webp strings

    const CATEGORIAS = {
        'llaveros': 'Llaveros',
        'deco_hogar': 'Deco & Hogar',
        'utilidades': 'Utilidades',
        'juegos': 'Juegos'
    };

    // ====== HEADER SCROLL ======
    window.addEventListener('scroll', function() {
        document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 60);
    });

    // Update header actions based on login state
    function updateHeaderActions() {
        const actions = document.getElementById('headerActions');
        if (isLoggedIn) {
            actions.innerHTML = '<a href="index.php" class="btn-header btn-header-outline"><i class="fa-solid fa-house"></i> Ver sitio</a>';
        } else {
            actions.innerHTML = '';
        }
    }
    updateHeaderActions();

    // ====== LOGIN ======
    document.getElementById('loginForm').addEventListener('submit', async function() {
        const password = document.getElementById('loginPassword').value.trim();
        const errorEl = document.getElementById('loginError');
        const btn = document.getElementById('loginBtn');

        if (!password) {
            errorEl.textContent = 'Ingresá la contraseña.';
            errorEl.classList.add('visible');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Verificando...';
        errorEl.classList.remove('visible');

        try {
            const formData = new FormData();
            formData.append('action', 'login');
            formData.append('password', password);

            const response = await fetch('api/admin_api.php', { method: 'POST', body: formData });
            const data = await response.json();

            if (data.success) {
                isLoggedIn = true;
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('adminPanel').style.display = 'block';
                updateHeaderActions();
                cargarProductosAdmin();
            } else {
                errorEl.textContent = data.error || 'Contraseña incorrecta.';
                errorEl.classList.add('visible');
            }
        } catch (err) {
            errorEl.textContent = 'Error de conexión. Intentá de nuevo.';
            errorEl.classList.add('visible');
        }

        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión';
    });

    // ====== LOGOUT ======
    document.getElementById('btnLogout').addEventListener('click', async function() {
        try {
            const formData = new FormData();
            formData.append('action', 'logout');
            await fetch('api/admin_api.php', { method: 'POST', body: formData });
        } catch (e) {}

        isLoggedIn = false;
        document.getElementById('adminPanel').style.display = 'none';
        document.getElementById('loginScreen').style.display = 'flex';
        document.getElementById('loginPassword').value = '';
        updateHeaderActions();
    });

    // ====== LOAD PRODUCTS ======
    async function cargarProductosAdmin() {
        const container = document.getElementById('productListContainer');
        container.innerHTML = '<div class="admin-loading"><div class="admin-spinner"></div><p>Cargando productos...</p></div>';

        try {
            const formData = new FormData();
            formData.append('action', 'listar');

            const response = await fetch('api/admin_api.php', { method: 'POST', body: formData });
            const productos = await response.json();

            if (!Array.isArray(productos) || productos.length === 0) {
                container.innerHTML = '<div class="admin-empty"><i class="fa-solid fa-box-open"></i><p>No hay productos cargados aún.<br>¡Agregá el primero!</p></div>';
                return;
            }

            let html = '<table class="admin-table"><thead><tr>';
            html += '<th>Imagen</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Acciones</th>';
            html += '</tr></thead><tbody>';

            productos.forEach(function(p) {
                const thumb = p.imagen_principal
                    ? p.imagen_principal
                    : 'data:image/svg+xml;base64,' + btoa('<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#121826"><rect width="50" height="50"/><text x="25" y="30" fill="#8b6b4c" font-size="8" text-anchor="middle">N/A</text></svg>');
                const catLabel = CATEGORIAS[p.categoria] || p.categoria;
                const catClass = 'cat-' + p.categoria;

                html += '<tr id="admin-row-' + p.id + '">';
                html += '<td><img src="' + thumb + '" alt="' + p.nombre + '" class="admin-thumb"></td>';
                html += '<td class="admin-product-name">' + p.nombre + '</td>';
                html += '<td><span class="admin-category ' + catClass + '">' + catLabel + '</span></td>';
                html += '<td class="admin-price">$' + p.precio.toLocaleString('es-AR', {minimumFractionDigits: 2}) + '</td>';
                html += '<td><div class="admin-row-actions">';
                html += '<button class="btn-edit" title="Editar" onclick="editarProducto(' + p.id + ')"><i class="fa-solid fa-pen"></i></button>';
                html += '<button class="btn-delete" title="Eliminar" onclick="confirmarEliminar(' + p.id + ', \'' + p.nombre.replace(/'/g, "\\'") + '\')"><i class="fa-solid fa-trash"></i></button>';
                html += '</div></td>';
                html += '</tr>';
            });

            html += '</tbody></table>';
            container.innerHTML = html;

        } catch (err) {
            console.error('Error:', err);
            container.innerHTML = '<div class="admin-empty"><i class="fa-solid fa-triangle-exclamation"></i><p>Error al cargar los productos.</p></div>';
        }
    }

    // Load products if already logged in
    if (isLoggedIn) {
        cargarProductosAdmin();
    }

    // ====== MODAL: OPEN/CLOSE ======
    document.getElementById('btnAddProduct').addEventListener('click', function() {
        abrirModal('crear');
    });

    document.getElementById('modalClose').addEventListener('click', cerrarModal);

    document.getElementById('productModal').addEventListener('click', function(e) {
        if (e.target === this) cerrarModal();
    });

    function abrirModal(modo, producto) {
        const modal = document.getElementById('productModal');
        const title = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('formSubmitBtn');
        const imageGroup = document.getElementById('imageUploadGroup');
        const msg = document.getElementById('formMessage');

        msg.className = 'form-message';
        msg.style.display = 'none';

        if (modo === 'crear') {
            title.textContent = 'Agregar producto';
            submitBtn.innerHTML = '<i class="fa-solid fa-save"></i> Guardar producto';
            document.getElementById('productId').value = '';
            document.getElementById('productName').value = '';
            document.getElementById('productDesc').value = '';
            document.getElementById('productPrice').value = '';
            document.getElementById('productCategory').value = '';
            imageGroup.style.display = 'block';
            imageDataArray = [];
            document.getElementById('imagePreviews').innerHTML = '';
        } else {
            title.textContent = 'Editar producto';
            submitBtn.innerHTML = '<i class="fa-solid fa-save"></i> Actualizar producto';
            document.getElementById('productId').value = producto.id;
            document.getElementById('productName').value = producto.nombre;
            document.getElementById('productDesc').value = producto.descripcion;
            document.getElementById('productPrice').value = producto.precio;
            document.getElementById('productCategory').value = producto.categoria;
            imageGroup.style.display = 'none'; // No editar imágenes en este sprint
            imageDataArray = [];
            document.getElementById('imagePreviews').innerHTML = '';
        }

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function cerrarModal() {
        document.getElementById('productModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // ====== IMAGE UPLOAD & WEBP CONVERSION ======
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        files.forEach(function(file) {
            convertToWebP(file);
        });
        // Reset input so same file can be selected again
        e.target.value = '';
    });

    function convertToWebP(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                // Limitar tamaño máximo
                const MAX = 1200;
                let w = img.width;
                let h = img.height;
                if (w > MAX || h > MAX) {
                    if (w > h) {
                        h = Math.round(h * MAX / w);
                        w = MAX;
                    } else {
                        w = Math.round(w * MAX / h);
                        h = MAX;
                    }
                }
                canvas.width = w;
                canvas.height = h;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, w, h);

                const webpBase64 = canvas.toDataURL('image/webp', 0.85);
                imageDataArray.push(webpBase64);
                renderImagePreviews();
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    function renderImagePreviews() {
        const container = document.getElementById('imagePreviews');
        container.innerHTML = imageDataArray.map(function(data, index) {
            return '<div class="image-preview-item">' +
                '<img src="' + data + '" alt="Preview ' + (index + 1) + '">' +
                '<button type="button" class="image-preview-remove" onclick="removeImage(' + index + ')"><i class="fa-solid fa-xmark"></i></button>' +
            '</div>';
        }).join('');
    }

    function removeImage(index) {
        imageDataArray.splice(index, 1);
        renderImagePreviews();
    }

    // ====== FORM SUBMIT ======
    document.getElementById('productForm').addEventListener('submit', async function() {
        const id = document.getElementById('productId').value;
        const nombre = document.getElementById('productName').value.trim();
        const descripcion = document.getElementById('productDesc').value.trim();
        const precio = parseFloat(document.getElementById('productPrice').value);
        const categoria = document.getElementById('productCategory').value;
        const msg = document.getElementById('formMessage');
        const btn = document.getElementById('formSubmitBtn');

        // Client-side validation
        if (!nombre || !descripcion || !categoria) {
            showFormMessage('Completá todos los campos obligatorios.', 'error');
            return;
        }

        if (isNaN(precio) || precio <= 0) {
            showFormMessage('El precio debe ser un número positivo.', 'error');
            return;
        }

        if (!id && imageDataArray.length === 0) {
            showFormMessage('Agregá al menos una imagen.', 'error');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';

        try {
            const formData = new FormData();
            formData.append('action', id ? 'editar' : 'crear');
            formData.append('nombre', nombre);
            formData.append('descripcion', descripcion);
            formData.append('precio', precio);
            formData.append('categoria', categoria);

            if (id) {
                formData.append('id', id);
            }

            // Append images for creation
            if (!id) {
                imageDataArray.forEach(function(data) {
                    formData.append('imagenes[]', data);
                });
            }

            const response = await fetch('api/admin_api.php', { method: 'POST', body: formData });
            
            // Intentar leer la respuesta como texto primero
            const responseText = await response.text();
            let result;
            try {
                result = JSON.parse(responseText);
            } catch (parseErr) {
                // El servidor devolvió algo que no es JSON (error PHP, página de error del hosting, etc.)
                console.error('Respuesta no JSON del servidor:', responseText);
                showFormMessage('Error del servidor: ' + (responseText.substring(0, 150) || 'Respuesta vacía'), 'error');
                btn.disabled = false;
                btn.innerHTML = id
                    ? '<i class="fa-solid fa-save"></i> Actualizar producto'
                    : '<i class="fa-solid fa-save"></i> Guardar producto';
                return;
            }

            if (result.success) {
                showFormMessage(id ? 'Producto actualizado correctamente.' : 'Producto creado correctamente.', 'success');
                setTimeout(function() {
                    cerrarModal();
                    cargarProductosAdmin();
                }, 1200);
            } else {
                showFormMessage(result.error || 'Error al guardar.', 'error');
            }
        } catch (err) {
            console.error('Error de red:', err);
            showFormMessage('Error de red: ' + err.message, 'error');
        }

        btn.disabled = false;
        btn.innerHTML = id
            ? '<i class="fa-solid fa-save"></i> Actualizar producto'
            : '<i class="fa-solid fa-save"></i> Guardar producto';
    });

    function showFormMessage(text, type) {
        const msg = document.getElementById('formMessage');
        msg.textContent = text;
        msg.className = 'form-message ' + type;
        msg.style.display = 'block';
    }

    // ====== EDIT PRODUCT ======
    async function editarProducto(id) {
        try {
            const response = await fetch('api/productos.php?id=' + id);
            const producto = await response.json();

            if (producto.error) {
                alert('Producto no encontrado.');
                return;
            }

            abrirModal('editar', producto);
        } catch (err) {
            alert('Error al cargar el producto.');
        }
    }

    // ====== DELETE PRODUCT ======
    function confirmarEliminar(id, nombre) {
        pendingDeleteId = id;
        document.getElementById('confirmText').textContent = '¿Seguro que querés eliminar "' + nombre + '"? Esta acción no se puede deshacer.';
        document.getElementById('confirmModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    document.getElementById('confirmCancel').addEventListener('click', function() {
        pendingDeleteId = null;
        document.getElementById('confirmModal').classList.remove('active');
        document.body.style.overflow = '';
    });

    document.getElementById('confirmModal').addEventListener('click', function(e) {
        if (e.target === this) {
            pendingDeleteId = null;
            this.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    document.getElementById('confirmDelete').addEventListener('click', async function() {
        if (!pendingDeleteId) return;

        const btn = this;
        btn.disabled = true;
        btn.textContent = 'Eliminando...';

        try {
            const formData = new FormData();
            formData.append('action', 'eliminar');
            formData.append('id', pendingDeleteId);

            const response = await fetch('api/admin_api.php', { method: 'POST', body: formData });
            const result = await response.json();

            if (result.success) {
                document.getElementById('confirmModal').classList.remove('active');
                document.body.style.overflow = '';
                cargarProductosAdmin();
            } else {
                alert(result.error || 'Error al eliminar.');
            }
        } catch (err) {
            alert('Error de conexión.');
        }

        pendingDeleteId = null;
        btn.disabled = false;
        btn.textContent = 'Eliminar';
    });
    </script>

</body>
</html>
