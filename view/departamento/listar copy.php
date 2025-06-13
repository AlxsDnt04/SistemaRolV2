<?php
require_once '../../models/Departamento.php';
$departamento = new Departamento();
$departamento = $departamento->obtenerTodos();
ob_start();
?>
<link rel="stylesheet" href="../../assets/css/listado.css">

  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-building"></i> Listado de Departamentos</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm">
          <i class="fa-solid fa-plus"></i> Nuevo Departamento</a>
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
                <!-- php endforeach para cerrar el foreach -->
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

<?php
$content = ob_get_clean();
$title = 'Listado de Departamentos';
require_once '../layout.php';
?>