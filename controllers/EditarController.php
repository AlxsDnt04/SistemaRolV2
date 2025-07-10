<?php
require_once '../models/Usuarios.php';
$usuarios = new Usuarios();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto'];

        // Validar extensión
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $extensionesPermitidas)) {
            header('Location: ../view/login/dashboard2.php?contenido=perfil/editar.php&error=tipo_archivo');
            exit;
        }

        // Generar nombre único y mover archivo
        $nombreNuevo = uniqid('foto_', true) . '.' . $extension;
        $rutaDestino = '../uploads/profilePictures/' . $nombreNuevo;

        if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
            $idUsuario = $_POST['id'] ?? null;
            $usuarios->actualizarFoto($idUsuario, $rutaDestino);
            header('Location: ../view/login/dashboard2.php?contenido=perfil/editar.php&success=1');
            exit;
        } else {
            header('Location: ../view/login/dashboard2.php?contenido=perfil/editar.php&error=subida');
            exit;
        }
    } else {
        header('Location: ../view/login/dashboard2.php?contenido=perfil/editar.php&error=1');
        exit;
    }
}

