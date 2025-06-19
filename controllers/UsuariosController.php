<?php
require_once '../models/Usuarios.php';
$usuarios = new Usuarios();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    $usuarios->eliminarUsuario($_GET['id']);
    header('Location: ../view/usuarios/listar.php?success=2');
    exit;
}

// Crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Validar que el campo id no esté vacío    
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar') {
        // Actualizar
        $usuarios->actualizarUsuario($_POST);
    } elseif (isset($_POST['accion']) && $_POST['accion'] === 'crear') {
        // Crear
        $usuarios->crearUsuario($_POST['usuario'], $_POST['contrasena'], $_POST['rol'], $_POST['ci_empleado']);
    } else {
        // Redirigir si no se especifica acción
        header('Location: ../view/usuarios/listar.php?error=1');
        exit;
    }
    header('Location: ../view/usuarios/listar.php?success=1');
    exit;
}
