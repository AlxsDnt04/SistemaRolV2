<?php
require_once '../models/Rol.php';
// Instanciar el rol
$rol = new Rol();



// crear o actualizar por POST desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validar campos requeridos antes de crear o actualizar
    $errores = [];
    if (empty($_POST['empleadoInfo']) || !is_numeric($_POST['empleadoInfo'])) {
        $errores[] = "El campo 'Empleado' es obligatorio y debe ser numérico.";
    }

    $data = [
      'mes' => $_POST['mes'],
      'hora25' => $_POST['total25'],
      'hora50' => $_POST['total50'],
      'hora100' => $_POST['total100'],
      'bonos' => $_POST['bonos'],
      'totalIngreso' => $_POST['total_ingresos'],
      'iess' => $_POST['iesst'],
      'sueldo' => $_POST['sueldo'],
      'multas' => $_POST['multas'],
      'atrasos' => $_POST['atrasos'],
      'alimentacion' => $_POST['alimentacion'],
      'anticipo' => $_POST['anticipo'],
      'otros' => $_POST['otros'],
      'totalEgreso' => $_POST['totalEgres'],
      'totalPagar' => $_POST['total_a_pagar'],
      'empleadoInfo' => $_POST['empleadoInfo'],
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
