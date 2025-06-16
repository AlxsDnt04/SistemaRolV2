<?php
// filepath: c:/Users/LABE1-PC-19/Documents/VsCode/Programacion Web/SistemaRolV2/view/menu2.php
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
        <main class="flex-fill p-4 bg-light">
            <?php
                // Cambia el valor de $archivo según la lógica de tu aplicación
                $archivo = isset($_GET['contenido']) ? $_GET['contenido'] : 'bienvenida.php';
                $ruta = __DIR__ . '/' . $archivo;
                if (file_exists($ruta)) {
                    include $ruta;
                } else {
                    echo "<div class='alert alert-warning'>Archivo no encontrado.</div>";
                }
            ?>
        </main>
    </div>
</body>
</html>