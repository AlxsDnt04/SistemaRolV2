<?php
require_once '../../models/Empleado.php';
$emp = new Empleado();
$empleados = $emp->obtenerTodos();

$esEdicion = isset($data['id']); // $data debe ser definido por el controlador según si es edición o creación

// Valores por defecto para creación
$data = $data ?? [
    'id' => '',
    'ci_empleado' => '',
    'fecha_inicio' => '',
    'fecha_fin' => '',
    'dias' => '',
    'pago' => '',
    'fecha_emision' => date('Y-m-d'),
    'aprobado' => '',
];
?>

<div class="container mt-3">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fa-solid fa-umbrella-beach"></i> Solicitud de Vacaciones</h5>
      <a href="dashboard2.php?contenido=vacaciones/listar.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-list"></i> Ver Solicitudes</a>
    </div>
    <div class="card-body">
      <form action="../../controllers/VacacionesController.php" method="POST">
        <?php if ($esEdicion): ?>
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        <?php else: ?>
          <input type="hidden" name="accion" value="crear">
        <?php endif; ?>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="ci_empleado" class="form-label">Empleado</label>
            <select class="form-select" id="ci_empleado" name="ci_empleado" required>
              <option value="" disabled <?= empty($data['ci_empleado']) ? 'selected' : '' ?>>Seleccione un empleado</option>
              <?php foreach ($empleados as $e): ?>
                <option value="<?= htmlspecialchars($e['ci_empleado']) ?>"
                  <?= ($data['ci_empleado'] == $e['ci_empleado']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($e['ci_empleado'] . ' - ' . $e['nombre'] . ' ' . $e['apellido']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required value="<?= htmlspecialchars($data['fecha_inicio']) ?>">
          </div>
          <div class="col-md-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required value="<?= htmlspecialchars($data['fecha_fin']) ?>">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-3">
            <label for="dias" class="form-label">Días</label>
            <input type="number" class="form-control" id="dias" name="dias" min="1" required value="<?= htmlspecialchars($data['dias']) ?>">
          </div>
          <div class="col-md-3">
            <label for="pago" class="form-label">Pago</label>
            <input type="number" step="0.01" class="form-control" id="pago" name="pago" required value="<?= htmlspecialchars($data['pago']) ?>">
          </div>
          <div class="col-md-3">
            <label for="fecha_emision" class="form-label">Fecha Emisión</label>
            <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" required value="<?= htmlspecialchars($data['fecha_emision']) ?>">
          </div>
          <div class="col-md-3">
            <label for="aprobado" class="form-label">Aprobado</label>
            <select class="form-select" id="aprobado" name="aprobado" required>
              <option value="" disabled <?= empty($data['aprobado']) ? 'selected' : '' ?>>Seleccione</option>
              <option value="Sí" <?= ($data['aprobado'] === 'Sí') ? 'selected' : '' ?>>Sí</option>
              <option value="No" <?= ($data['aprobado'] === 'No') ? 'selected' : '' ?>>No</option>
              <option value="Pendiente" <?= ($data['aprobado'] === 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
            </select>
          </div>
        </div>

        <div class="mt-4 text-center">
          <button type="submit" class="btn btn-success px-5">
            <i class="fa-solid fa-floppy-disk"></i> Guardar
          </button>
          <button type="reset" class="btn btn-secondary px-5">
            <i class="fa-solid fa-eraser"></i> Limpiar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>