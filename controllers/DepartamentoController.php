<?php
require_once __DIR__ . '/../models/Departamento.php';
$departamento = new Departamento();
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $departamento->crear($_POST);
    header("Location:../views/departamento/listar.php");
}
