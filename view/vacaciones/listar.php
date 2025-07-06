<?php
//require_once '../../models/Vacaciones.php';
require_once '../../models/Empleado.php';

//$vacacionesModel = new Vacaciones();
$empleadoModel = new Empleado();

$rol = $_SESSION['rol'];
$ci_empleado = $_SESSION['ci_empleado'] ?? null;

/* if ($rol === 'admin') {
    $solicitudes = $vacacionesModel->obtenerTodas();
} else {
    $solicitudes = $vacacionesModel->obtenerPorEmpleado($ci_empleado);
} */
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
            <th>Pago</th>
            <th>Fecha Emisión</th>
            <th>Aprobado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($solicitudes)) : ?>
            <?php foreach ($solicitudes as $sol) : ?>
              <tr>
                <td><?= htmlspecialchars($sol['nombre'].' '.$sol['apellido']) ?></td>
                <td><?= htmlspecialchars($sol['fecha_inicio']) ?></td>
                <td><?= htmlspecialchars($sol['fecha_fin']) ?></td>
                <td><?= htmlspecialchars($sol['dias']) ?></td>
                <td>$<?= number_format($sol['pago'], 2) ?></td>
                <td><?= htmlspecialchars($sol['fecha_emision']) ?></td>
                <td><?= htmlspecialchars($sol['aprobado']) ?></td>
                <td>
                  <a href="formulario.php?id=<?= $sol['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                  <?php if ($rol === 'admin'): ?>
                    <a href="../../controllers/VacacionesController.php?accion=eliminar&id=<?= $sol['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar solicitud?');">
                      <i class="fa-solid fa-trash"></i> Eliminar</a>
                  <?php endif; ?>
                </td>
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