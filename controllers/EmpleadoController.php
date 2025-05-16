<?php
require_once '../models/Empleado.php';

$empleado = new Empleado();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    $empleado->eliminar($_GET['id']);
    header('Location: ../view/empleado/listar.php');
    exit;
}

// Crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar que el campo id_departamento no esté vacío    
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        // Actualizar
        $empleado->actualizar($_POST);
    } else {
        // crear
        $empleado->crear($_POST);
    }
    header('Location: ../view/empleado/listar.php');
    exit;
}
