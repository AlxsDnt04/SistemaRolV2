<?php
session_start();
require_once __DIR__ . '/../models/Usuarios.php';
$usuarioModel = new Usuarios();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $user = $usuarioModel->autenticarUsuario($usuario,$clave);

    if ($user) {
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['ci_empleado'] = $user['ci_empleado'];
        header('Location: ../view/usuarios/listar.php');
    }else {
        header('Location: ../view/login/login.php?error=1');
    }
}