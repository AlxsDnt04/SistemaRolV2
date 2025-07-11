<?php
require_once '../../config/validacionInicioSesion.php';
require_once '../../models/Departamento.php';
$departamento = new Departamento();
$departamento = $departamento->obtenerTodos();
?>

  <div class="container mt-3">
    <div class="card shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-building"></i> Listado de Departamentos</h5>
        <a href="../login/dashboard2.php?contenido=departamento/formulario.php" class="btn btn-light btn-sm">
            <i class="fa-solid fa-plus"></i> <span>Nuevo Departamento</span></a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped table-responsive aling-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>Nombre</th>
              <th>Ubicación</th>
              <th>Área</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($departamento)) : ?>
              <?php foreach ($departamento as $dep) : ?>
                <tr class="align-middle text-center">
                  <td class="fw-bold"><?= htmlspecialchars($dep['nombre']) ?></td>
                  <td><?= htmlspecialchars($dep['ubicacion']) ?></td>
                  <td><?= htmlspecialchars($dep['area']) ?></td>
                  <td class="btn-group" role="group">
                    <a href="../login/dashboard2.php?contenido=departamento/formulario.php&id=<?= $dep['id_departamento'] ?>" class="btn btn-warning btn-sm">
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

