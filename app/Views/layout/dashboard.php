<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIFAS  CHILAS  </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 80px;
            --bg-cream: #f6f1ea;
            --ink: #1a1a1a;
            --muted: #6e6a64;
            --champagne: #d7c3a5;
            --wine: #7a2e3a;
            --card: rgba(255, 255, 255, 0.78);
            --card-border: rgba(215, 195, 165, 0.45);
            --shadow: 0 18px 40px rgba(26, 26, 26, 0.08);
        }

        body {
            font-family: 'Sora', sans-serif;
            background: radial-gradient(1200px circle at 90% -10%, #ffffff 0%, #f6f1ea 45%, #efe5d8 100%);
            color: var(--ink);
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.25) 1px, transparent 1px, transparent 10px);
            opacity: 0.2;
            pointer-events: none;
            z-index: 0;
        }

        /* Wrapper */
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            position: relative;
            z-index: 1;
        }

        /* Sidebar Estilos */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: #fbf7f0;
            min-height: 100vh;
            box-shadow: 8px 0 30px rgba(26, 26, 26, 0.06);
            border-right: 1px solid var(--champagne);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        #sidebar.active {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-header h4 {
            font-family: 'Cormorant Garamond', serif;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--ink);
        }

        .sidebar-header h4 span {
            color: var(--wine);
        }

        .nav-link {
            color: var(--muted);
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 5px 15px;
            display: flex;
            align-items: center;
            border: 1px solid transparent;
            transition: all 0.25s ease;
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 12px;
            color: var(--wine);
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(215, 195, 165, 0.2);
            border-color: var(--champagne);
            color: var(--ink);
            box-shadow: 0 8px 20px rgba(122, 46, 58, 0.08);
        }

        /* Contenido */
        #content {
            width: 100%;
            padding: 30px;
            transition: all 0.3s;
        }

        #content h2,
        #content h4,
        #content h5 {
            font-family: 'Cormorant Garamond', serif;
            letter-spacing: 0.03em;
        }

        .card {
            border: 1px solid var(--card-border);
            border-radius: 18px;
            background: var(--card);
            box-shadow: var(--shadow);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 50px rgba(26, 26, 26, 0.12);
        }

        .row.g-4 > *:nth-child(-n+3) {
            animation: rise 0.45s ease both;
        }

        .row.g-4 > *:nth-child(1) { animation-delay: 0.04s; }
        .row.g-4 > *:nth-child(2) { animation-delay: 0.08s; }
        .row.g-4 > *:nth-child(3) { animation-delay: 0.12s; }

        /* Botón de toggle hamburguesa */
        #sidebarCollapse {
            background: #ffffff;
            border: 1px solid var(--champagne);
            box-shadow: 0 6px 16px rgba(26, 26, 26, 0.08);
            border-radius: 8px;
            padding: 8px 12px;
            color: var(--ink);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        #sidebarCollapse:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 22px rgba(26, 26, 26, 0.12);
        }

        .btn-primary {
            background-color: var(--wine);
            border-color: var(--wine);
            box-shadow: 0 10px 20px rgba(122, 46, 58, 0.18);
        }

        .btn-primary:hover {
            background-color: #61232d;
            border-color: #61232d;
        }

        .btn-warning {
            background-color: var(--champagne);
            border-color: var(--champagne);
            color: var(--ink);
        }

        .badge {
            border: 1px solid rgba(215, 195, 165, 0.6);
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive para móviles */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div id="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold text-primary mb-0">RIFAS <span class="text-dark">CHILAS</span></h4>
        </div>
        
        <ul class="nav flex-column">
        <?php if(session()->get("usuario.rol") == "admin" OR session()->get("usuario.rol") == "trabajador"){ ?>
            <li class="nav-item">
                <a href="/usuarios" class="nav-link active">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        <?php } ?>

            <li class="nav-item">
                <a href="<?= session()->get('usuario.rol') === 'cliente' ? '/rifas/catalogo' : '/rifas' ?>" class="nav-link">
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Rifas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-wallet2"></i>
                    <span>Pagos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-chat-dots"></i>
                    <span>Mensajes</span>
                </a>
            </li>
        </ul>

        <div class="position-absolute bottom-0  p-3">
            <a href="/usuarios/logout" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left"></i>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg mb-4">
            <div class="container-fluid p-0">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="ms-auto d-flex align-items-center">
                    <div class="me-3 text-end d-none d-sm-block">
                        <p class="mb-0 fw-bold"><?= session()->get('usuario.nombre') ?></p>
                        <small class="text-muted"><?= session()->get('usuario.email') ?></small>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Alex+Doe&background=4e73df&color=fff" class="rounded-circle" width="40">
                </div>
            </div>
        </nav>

        <div class="container-fluid p-0">
            <h2 class="fw-bold mb-4">Panel de Control</h2>
            
          

            <div class="row g-4">
                
            <?= $this->renderSection('content') ?>
 
            </div>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Lógica para colapsar el menú
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('sidebarCollapse');
        const sidebar = document.getElementById('sidebar');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    });
</script>
</body>
</html>
