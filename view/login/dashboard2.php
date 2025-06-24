<?php
//inicio de sesion
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}
$rol = $_SESSION['rol'];
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Navegación</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .menu-container {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }
        .menu-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .list-group-item {
            font-size: 1.15rem;
        }
        .list-group-item i {
            width: 28px;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <div class="d-flex align-items-center ms-3">
                <span class="text-white me-3">
                    <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($usuario); ?>
                </span>
                <a href="logout.php" class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                </a>
            </div>
        </div>
    </nav>
    <!-- menu lateral -->
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        <nav class="bg-white shadow-sm p-3" style="width: 240px;">
            <h4 class="mb-4 text-center"><i class="fa-solid fa-bars"></i> Menú</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="?contenido=departamento/listar.php" class="nav-link text-dark">
                        <i class="fa-solid fa-building"></i> Departamentos
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="?contenido=empleado/listar.php" class="nav-link text-dark">
                        <i class="fa-solid fa-users"></i> Empleados
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="?contenido=rol/listar.php" class="nav-link text-dark">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Roles de Pago
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="?contenido=documento/listar.php" class="nav-link text-dark">
                        <i class="fa-solid fa-file-lines"></i> Documentos
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->

        <main class="flex-fill">
            <?php
                // Solo permitir rutas válidas dentro de /view/
                $contenido = isset($_GET['contenido']) ? $_GET['contenido'] : 'bienvenida.php';
                $ruta = realpath(__DIR__ . '/../' . $contenido);

                // Seguridad: solo incluir archivos dentro de la carpeta /view/
                $viewDir = realpath(__DIR__ . '/..');
                if ($ruta && strpos($ruta, $viewDir) === 0 && file_exists($ruta)) {
                    include $ruta;
                } else {
                    echo "<div class='alert alert-warning'>Archivo no encontrado.</div>";
                }
            ?>
        </main>
    </div>
</body>
</html>