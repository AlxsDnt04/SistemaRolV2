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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #343a40;
            color: white;
        }

        .sidebar h4 {
            padding: 20px;
            margin: 0;
        }

        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark" style="background: linear-gradient(to right, #0b8793, #360033);">
        <a class="navbar-brand" href="#"></a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-current="page">Inicio <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="dropdownId"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Action 1</a>
                        <a class="dropdown-item" href="#">Action 2</a>
                    </div>
                </li>
            </ul>
            <form class="d-flex my-2 my-lg-0">
                <input
                    class="form-control me-sm-2"
                    type="text"
                    placeholder="Search" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    Search
                </button>
            </form>

            <a href="logout.php" class="btn btn-danger ms-3">Cerrar sesión</a>
        </div>
    </nav>



    <div class="sidebar">
        <h4>Panel de Opciones</h4>
        <?php
        if ($rol == 'admin'):
        ?>
            <a href="../departamento/listar.php">Gestión Departamentos</a>
            <a href="../Empleados/listar.php">Gestión Empleado</a>
            <a href="../rol/listar.php">Gestión Roles</a>
            <a href="../documento/listar.php">Gestión Documentos</a>
            <a href="../usuarios/listar.php">Gestión Usuarios</a>
        <?php else: ?>
            <a href="../documento/listar.php">Gestión Documentos</a>
            <a href="../documento/listar.php">Gestión de Roles</a>
        <?php endif; ?>
    </div>

    <div class="content">
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?> 👋</h2>
        <p>Tu rol actual es: <strong><?= $_SESSION['rol'] ?></strong></p>
    </div>

</body>

</html>