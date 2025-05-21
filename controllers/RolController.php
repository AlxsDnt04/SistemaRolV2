<?php
require_once '../models/Rol.php';
// Instanciar el rol
$rol = new Rol();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'empleadoInfo' => $_POST['empleadoInfo'],
        'mes' => $_POST['mes'],
        'bonos' => $_POST['bonos'],
        'sueldo' => $_POST['sueldo'],
        'multas' => $_POST['multas'],
        'atrasos' => $_POST['atrasos'],
        'alimentacion' => $_POST['alimentacion'],
        'anticipo' => $_POST['anticipo'],
        'otros' => $_POST['otros']
    ];
}
