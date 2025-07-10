<?php
require_once '../../models/Vacaciones.php';
require_once '../../models/Empleado.php';

$vacacionesModel = new Vacaciones();
$empleadoModel = new Empleado();

$rol = $_SESSION['rol'];
$ci_empleado = $_SESSION['ci_empleado'] ?? null;

if ($rol === 'admin') {
  $solicitudes = $vacacionesModel->obtenerTodas();
} else {
  $solicitudes = $vacacionesModel->consultarSolicitudporid($ci_empleado);
}
?>
<div class="container mt-3">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fa-solid fa-umbrella-beach"></i> Solicitudes de Vacaciones</h5>
      <?php if ($rol === 'empleado'): ?>
        <a href="../login/dashboard2.php?contenido=vacaciones/formulario.php" class="btn btn-light btn-sm">
          <i class="fa-solid fa-plus"></i> Solicitar Vacaciones</a>
      <?php endif; ?>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th>Empleado</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Días</th>
            <th>Fecha Emisión</th>
            <th>Motivo</th>
            <th>Estado</th>
            <?php if($rol !=='empleado'):?>
            <th>Acciones</th>
            <?php endif;?>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($solicitudes)) : ?>
            <?php foreach ($solicitudes as $sol) : ?>
              <tr>
                <td><?= htmlspecialchars($sol['ci_empleado']) ?></td>
                <td><?= htmlspecialchars($sol['fecha_inicio']) ?></td>
                <td><?= htmlspecialchars($sol['fecha_fin']) ?></td>
                <td><?= htmlspecialchars($sol['dias']) ?></td>
                <td><?= htmlspecialchars($sol['fecha_emision']) ?></td>
                <td><?= htmlspecialchars($sol['observaciones']) ?></td>
                <!-- cambiar el color de la celda dependiendo de la palabra -->
                <td class="text-center">
                  <?php if ($sol['aprobado'] === 'Sí'): ?>
                    <span class="badge bg-success">Aprobado</span>
                  <?php elseif ($sol['aprobado'] === 'No'): ?>
                    <span class="badge bg-danger">Rechazado</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">Pendiente</span>
                  <?php endif; ?>
                </td>
                <?php if($rol !=='empleado'):?>
                <td class="btn-group text-center">
                  <a href="dashboard2.php?contenido=vacaciones/formulario.php&id=<?= $sol['ci_empleado'] ?>" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                  <a href="../../controllers/VacacionesController.php?accion=eliminar&id=<?= $sol['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar solicitud?');">
                    <i class="fa-solid fa-trash"></i> Eliminar</a>
                </td>
                <?php endif;?>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="8" class="text-center text-warning">No hay solicitudes registradas.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- alertas -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../assets/javascript/alertas.js"></script>
<?php
  if (isset($_GET['success'])): ?>
    <script>
      mostrarAlertaSwal('<?= htmlspecialchars($_GET['success']) ?>');
    </script>
    <!-- capturar error -->
  <?php elseif (isset($_GET['error'])): ?>
    <script>
      mostrarAlertaSwal('<?= htmlspecialchars($_GET['error']) ?>');
    </script>
  <?php endif; ?>

  