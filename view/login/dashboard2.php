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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Sistema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                // Mostrar opciones de gestión solo si el rol es 'Administrador'
                if ($rol === 'admin'):
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestionar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="dashboard2.php?contenido=usuarios/listar.php">Usuarios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="dashboard2.php?contenido=vacaciones/listar.php">Vacaciones</a></li>
                        </ul>
                    </li>
                </ul>
                <?php endif; ?>
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
                  
        <nav class="bg-white shadow-sm p-3 rounded-3" style="width: 240px;">
            <h4 class="mb-4 text-center"><i class="fa-solid fa-bars"></i> Menú</h4>
            <ul class="nav flex-column">
                <?php if ($rol === 'admin'): ?>
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
                <?php elseif ($rol === 'empleado'): ?>
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
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link text-dark">
                            <i class="fa-solid fa-umbrella-beach"></i> Solicitud de Vacaciones
                        </a>
                    </li>
                    
                <?php endif; ?>
            </ul>
        </nav>
        <!-- Main Content -->

        <main class="flex-fill">
            <?php
                // Solo permitir rutas válidas dentro de /view/
                $contenido = isset($_GET['contenido']) ? $_GET['contenido'] : '../view/login/bienvenida.php';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>