<?php
require_once '../models/Departamento.php';

$departamento = new Departamento();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    $departamento->eliminar($_GET['id']);
    header('Location: ../view/departamento/listar.php?success=2');
    exit;
}

// Crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar que el campo id_departamento no esté vacío    
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        // Actualizar
        $departamento->actualizar($_POST);
    } else {
        // crear
        $departamento->crear($_POST);
    }
    header('Location: ../view/departamento/listar.php?success=1');
    exit;
}
