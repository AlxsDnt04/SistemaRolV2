<?php
require_once '../models/Documento.php';
$documento = new Documento();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    $documento->eliminar($_GET['id']);
    header('Location: ../view/documento/listar.php?success=2');
    exit;
}

// Crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha subido un archivo
    $archivo = null; //
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['archivo']['name']);
        $rutaArchivo = '../uploads/' . $nombreArchivo; // Ruta donde se guardará el archivo
        move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo); // Mover el archivo a la ruta deseada
        $archivo = $rutaArchivo; // Asignar la ruta del archivo a la variable

    }

    // Validar que el campo id_departamento no esté vacío    
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        // Actualizar
        $documento->actualizar($_POST, $archivo);
        
    } else {
        // crear
        $documento->crearDocumento($_POST, $archivo);

    }
    header('Location: ../view/documento/listar.php?success=1');
    exit;
}
