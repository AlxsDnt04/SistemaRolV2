<?php
require_once '../models/Empleado.php';

$empleado = new Empleado();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    $empleado->eliminar($_GET['id']);
    header('Location: ../view/login/dashboard2.php?contenido=empleado/listar.php&success=2');
    exit;
}

// Crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar campos requeridos antes de crear o actualizar
    $errores = [];
    if (empty($_POST['ci_empleado']) || !is_numeric($_POST['ci_empleado'])) {
        $errores[] = "El campo 'CI Empleado' es obligatorio y debe ser numérico.";
    }
    if (empty($_POST['id_departamento']) || !is_numeric($_POST['id_departamento'])) {
        $errores[] = "El campo 'Departamento' es obligatorio y debe ser numérico.";
    }

    if (!empty($errores)) {
        // Aquí puedes redirigir o mostrar errores 
        die(implode('<br>', $errores));
    }

    if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        // Actualizar
        $empleado->actualizar($_POST);
    } elseif (isset($_POST['accion']) && $_POST['accion'] === 'crear') {
        // crear
        $empleado->crear($_POST);
    } else {
        // Redirigir si no se especifica acción
        header('Location: ../view/login/dashboard2.php?contenido=empleado/listar.php&error=1');
    }
    header('Location: ../view/login/dashboard2.php?contenido=empleado/listar.php&success=1');
    exit;
}
