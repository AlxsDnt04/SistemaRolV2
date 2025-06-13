<?php
require_once '../models/Rol.php';
// Instanciar el rol
$rol = new Rol();

// Eliminar por GET directamente desde la id de URL
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    // llamar a la funcion eliminar
    $rol->eliminar($_GET['id']);
    header('Location: ../view/rol/listar.php?success=2');
    exit;
}

// crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validar campos requeridos antes de crear o actualizar
    $errores = [];
    if (empty($_POST['empleadoInfo']) || !is_numeric($_POST['empleadoInfo'])) {
        $errores[] = "El campo 'Empleado' es obligatorio y debe ser numérico.";
    }

    $data = [
      'mes' => $_POST['meses'] ?? null,
      'hora25' => $_POST['total25'] ?? null,
      'hora50' => $_POST['total50'] ?? null,
      'hora100' => $_POST['total100'] ?? null,
      'bonos' => $_POST['bonos'] ?? null,
      'totalIngreso' => $_POST['total_ingresos'] ?? null,
      'iess' => $_POST['iesst'] ?? null,
      'sueldo' => $_POST['sueldo'] ?? null,
      'multas' => $_POST['multas'] ?? null,
      'atrasos' => $_POST['atrasos'] ?? null,
      'alimentacion' => $_POST['alimentacion'] ?? null,
      'anticipo' => $_POST['anticipo'] ?? null,
      'otros' => $_POST['otros'] ?? null,
      'totalEgreso' => $_POST['totalEgres'] ?? null,
      'totalPagar' => $_POST['totalPagar'] ?? null,
      'empleadoInfo' => $_POST['empleadoInfo'] ?? null,
    ];

    if(isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        // Actualizar
        $rol->actualizarRol($data);
    } else {
        // Crear
        $rol->insertarRol($data);
    }
    header('Location: ../view/rol/listar.php?success=1');    
    exit;
}
