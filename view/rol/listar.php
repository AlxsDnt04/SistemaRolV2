<?php
require_once '../../models/Rol.php';
$rol = new Rol();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Lista de Roles</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/listado.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-building"></i> Listado de Roles</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm">
          <i class="fa-solid fa-plus"></i> Nuevo registro de rol</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ubicación</th>
              <th>Área</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($departamento)) : ?>
              <?php foreach ($departamento as $dep) : ?>
                <tr>
                  <td><?= htmlspecialchars($dep['id_departamento']) ?></td>
                  <td><?= htmlspecialchars($dep['nombre']) ?></td>
                  <td><?= htmlspecialchars($dep['ubicacion']) ?></td>
                  <td><?= htmlspecialchars($dep['area']) ?></td>
                  <td class="text-center">
                    <a href="formulario.php?id=<?= $dep['id_departamento'] ?>" class="btn btn-warning btn-sm">
                      <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                    <!-- ELIMINAR -->
                    <a href="../../controllers/DepartamentoController.php?accion=eliminar&id=<?= $dep['id_departamento'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este departamento?');">
                      <i class="fa-solid fa-trash"></i> Eliminar</a>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center text-warning">No hay departamentos registrados.</td>
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