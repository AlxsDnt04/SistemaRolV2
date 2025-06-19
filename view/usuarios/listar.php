<?php
require_once '../../models/Usuarios.php';
$usuarios = new Usuarios();
$userQuery = $usuarios->obtenerTodosUsuarios();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Listado de Usuario</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/listado.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-users"></i> Listado de usuarios</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm">
          <i class="fa-solid fa-plus"></i> Agregar usuario</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Usuario</th>
              <th class="text-center">Rol de usuario</th>
              <th class="text-center">Empleado</th>
              <th class="text-center">Fecha de registro</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($userQuery)) : ?>
              <?php foreach ($userQuery as $UQ) : ?>
                <tr class="text-center">
                  <td><?= htmlspecialchars($UQ['id']) ?></td>
                  <td><?= htmlspecialchars($UQ['usuario']) ?></td>
                  <td><?= htmlspecialchars($UQ['rol']) ?></td>
                  <td><?= htmlspecialchars($UQ['ci_empleado'] . ' - ' . $UQ['nombre'].' '.$UQ['apellido']) ?></td>
                  <td><?= htmlspecialchars($UQ['fecha_user']) ?></td>
                  <td class="text-center">
                    <a href="formulario.php?id=<?= $UQ['id'] ?>" class="btn btn-warning btn-sm">
                      <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                    <!-- ELIMINAR -->
                    <a href="../../controllers/UsuariosController.php?accion=eliminar&id=<?= $UQ['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                      <i class="fa-solid fa-trash"></i> Eliminar</a>
                  </td>
                </tr>
                <!-- php endforeach para cerrar el foreach -->
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="6" class="text-center text-warning">No hay usurios registrados.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- alertas -->
  <?php
  if (isset($_GET['success'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/javascript/alertas.js"></script>
    <script>
      mostrarAlertaSwal('<?= htmlspecialchars($_GET['success']) ?>');
    </script>
  <?php endif; ?>


</body>

</html>