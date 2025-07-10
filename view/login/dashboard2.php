<?php
//inicio de sesion
require_once '../../config/validacionInicioSesion.php';
require_once '../../models/Empleado.php';
$empleadoModel = new Empleado();
$rol = $_SESSION['rol'];
$usuario = $_SESSION['usuario'];

$nombreCompleto= 'Usuario';

if ($usuario) {
    $consultaUsuario = $empleadoModel->obtenerPorId($usuario);
    if ($consultaUsuario && isset($consultaUsuario['nombre'], $consultaUsuario['apellido'])) {
        $nombreCompleto = $consultaUsuario['nombre'] . ' ' . $consultaUsuario['apellido'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú de Navegación</title>
    <link rel="icon" href="../../assets/img/iconnav.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<link rel="stylesheet" href="../../assets/css/menu.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="../login/dashboard2.php?contenido=login/bienvenida.php">Sistema</a>
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
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="dashboard2.php?contenido=vacaciones/listar.php">Vacaciones</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="d-flex align-items-center ms-3">
                <span class="text-white me-3">
                    <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($nombreCompleto); ?>
                </span>
                <div class="dropdown me-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i> Perfil
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="?contenido=perfil/editar.php">Editar Perfil</a></li>
                        <li><a class="dropdown-item disabled" href="?contenido=perfil/cambiar_contrasena.php">Cambiar Contraseña</a></li>
                    </ul>
                </div>
                <a href="logout.php" class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                </a>
            </div>
        </div>
    </nav>
    <!-- menu lateral -->
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->

        <nav class=" shadow-sm p-3 rounded-3 glassefect" style="width: 240px;">
            <h4 class="mb-4 text-center text-white"><i class="fa-solid fa-bars text-white"></i> Menú</h4>
            <ul class="nav flex-column">
                <?php if ($rol === 'admin'): ?>
                    <li class="nav-item mb-2">
                        <a href="?contenido=departamento/listar.php" class="nav-link text-white">
                            <i class="fa-solid fa-building"></i> Departamentos
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="?contenido=empleado/listar.php" class="nav-link text-white">
                            <i class="fa-solid fa-users"></i> Empleados
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="?contenido=rol/listar.php" class="nav-link text-white">
                            <i class="fa-solid fa-file-invoice-dollar"></i> Roles de Pago
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="?contenido=documento/listar.php" class="nav-link text-white">
                            <i class="fa-solid fa-file-lines"></i> Documentos
                        </a>
                    </li>
                <?php elseif ($rol === 'empleado'): ?>
                    <li class="nav-item mb-2">
                        <a href="?contenido=rol/listar.php" class="nav-link text-white">
                            <i class="fa-solid fa-file-invoice-dollar"></i> Roles de Pago
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="?contenido=documento/listar.php" class="nav-link text-white">
                            <i class="fa-solid fa-file-lines"></i> Documentos
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="?contenido=vacaciones/listar.php" class="nav-link text-white">
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