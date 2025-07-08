<?php
require_once '../models/Vacaciones.php';
$vacaciones = new Vacaciones();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    /* $usuarios->eliminarUsuario($_GET['id']);
    header('Location: ../view/login/dashboard2.php?contenido=vacaciones/listar.php&success=2');
    exit; */
}

// Crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'id' => $_POST['id'] ?? null,
        'ci_empleado' => $_POST['ci_empleado'] ?? null,
        'fecha_inicio' => $_POST['fecha_inicio'] ?? null,
        'fecha_fin' => $_POST['fecha_fin'] ?? null,
        'dias' => $_POST['dias'] ?? null,
        'aprobado' => $_POST['aprobado'] ?? null,
        'observaciones' => $_POST['motivo'] ?? '',];

     // Validar que el campo id no esté vacío    
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar') {
        // Actualizar
        /* $usuarios->actualizarUsuario($_POST); */
    } elseif (isset($_POST['accion']) && $_POST['accion'] === 'crear') {
        // Validar que el usuario no exista
        /* if ($usuarios->existeUsuario($_POST['usuario'])) {
            // Redirigir con mensaje de error si el usuario ya existe
            header('Location: ../view/login/dashboard2.php?contenido=usuarios/formulario.php&error=usuario_existente');
            exit; */
        
        // Crear
        $vacaciones->nuevaSolicitud($data);
    } else {
        // Redirigir si no se especifica acción
        header('Location: ../view/login/dashboard2.php?contenido=vacaciones/listar.php&error=1');
        exit;
    }
    header('Location: ../view/login/dashboard2.php?contenido=vacaciones/listar.php&success=1');
    exit;
}
