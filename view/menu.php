<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Vertical</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: #34495e;
            color: #fff;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <nav class="col-12 col-md-3 col-lg-2 sidebar d-flex flex-column p-0">
                <div class="d-flex flex-column flex-shrink-0 p-3">
                    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">Menú</span>
                    </a>
                    <hr class="text-secondary">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">Dashboard</a>
                        </li>
                        <li>
                            <a href="usuarios.php" class="nav-link">Usuarios</a>
                        </li>
                        <li>
                            <a href="roles.php" class="nav-link">Roles</a>
                        </li>
                        <li>
                            <a href="permisos.php" class="nav-link">Permisos</a>
                        </li>
                        <li>
                            <a href="configuracion.php" class="nav-link">Configuración</a>
                        </li>
                        <li>
                            <a href="logout.php" class="nav-link">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-12 col-md-9 col-lg-10 py-4 px-4 main-content">
                <!-- Aquí va el contenido de la vista seleccionada -->
                <h2>Bienvenido al Sistema de Roles</h2>
                <p>Selecciona una opción del menú.</p>
            </main>
        </div>
    </div>
    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>