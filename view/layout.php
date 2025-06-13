<?php
// Puedes agregar aquí la lógica para obtener el rol del usuario y mostrar opciones según corresponda
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Sistema de Roles' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/layout.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white p-3" style="min-width:220px; min-height:100vh;">
            <h5 class="mb-4"><i class="fa-solid fa-user-shield"></i> Menú</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white dropdown-toggle menu-anim" href="#" id="departamentosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-building"></i> Departamentos
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="departamentosDropdown">
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="formulario.php">Registrar</a></li>
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="listar copy.php">Lista</a></li>
                    </ul>
                    <a class="nav-link text-white dropdown-toggle menu-anim" href="#" id="usuariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-users"></i> Usuarios 
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="usuariosDropdown">
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="#">Registrar</a></li>
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="#">Lista</a></li>
                    </ul>
                    <a class="nav-link text-white dropdown-toggle menu-anim" href="#" id="rolDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-shield-halved"></i> Roles 
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="rolDropdown">
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="#">Registrar</a></li>
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="#">Lista</a></li>
                    </ul>
                    <a class="nav-link text-white dropdown-toggle menu-anim" href="#" id="docsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-file-alt"></i> Documentación 
                    </a>
                    <ul class="dropdown-menu bg-dark animate__animated animate__slideInDown" aria-labelledby="docsDropdown" style="border-radius: 10px; transition: all 0.3s;">
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="#" style="border-radius: 10px;">Registrar</a></li>
                        <li><a class="dropdown-item text-dark bg-white menu-anim" href="#" style="border-radius: 10px;">Lista</a></li>
                    </ul>
                </li>
                <style>
                    .menu-anim {
                        transition: transform 0.2s, box-shadow 0.2s;
                    }
                    .menu-anim:hover, .menu-anim:focus {
                        transform: translateX(8px) scale(1.05);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                        background: #f8f9fa !important;
                        color: #212529 !important;
                    }
                </style>

            </ul>
        </nav>
        <!-- Contenido principal -->
        <main class="flex-fill p-4">
            <?php if (isset($content)) echo $content; ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>