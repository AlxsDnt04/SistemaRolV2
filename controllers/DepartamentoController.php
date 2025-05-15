<?php
require_once '../models/Departamento.php';

$departamento = new Departamento();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // metodo1
    /* actualizar */
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar') {
        $departamento->actualizar($_POST);
        exit;
    }
    /* eliminar */
    elseif (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
            $departamento->eliminar($id);
        
        // Redirigir al listado después de eliminar
        header('Location: ../../view/departamento/listar.php');
        exit;
    } else {
        $departamento->crear($_POST);
        header('Location: ../view/departamento/listar.php');
    }

    // metodo2
    /*  $accion = $_POST['accion'];

    if ($accion === 'crear') {
        // Crear un nuevo departamento
        $departamento->crear([
            'nombre' => $_POST['nombre'],
            'ubicacion' => $_POST['ubicacion'],
            'area' => $_POST['area']
        ]);
    } elseif ($accion === 'editar') {
        // Editar un departamento existente
        $departamento->actualizar([
            'id_departamento' => $_POST['id_departamento'],
            'nombre' => $_POST['nombre'],
            'ubicacion' => $_POST['ubicacion'],
            'area' => $_POST['area']
        ]);
    }
 */
    // Redirigir al listado después de guardar
    header('Location: ../view/departamento/listar.php');
    exit;
}
