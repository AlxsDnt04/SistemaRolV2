<?php
require_once '../../models/Empleado.php';
require_once '../../models/Vacaciones.php';


$usuarioRol = $_SESSION['rol'] ?? '';
$usuarioCi = $_SESSION['ci_empleado'] ?? '';

if ($usuarioRol === 'empleado') {
  $vacacionesModel = new Vacaciones();
  $yaSolicito = $vacacionesModel->tieneSolicitud($usuarioCi);
  if ($yaSolicito) {
    echo "<script>
            alert('Usted ya realizó su solicitud de vacaciones');
            window.location.href = 'dashboard2.php?contenido=vacaciones/listar.php';
        </script>";
    exit;
  }
}

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
          <div class="col-md-6 mb-3">
            <label for="ci_empleado" class="form-label">Empleado</label>
            <?php
            $usuarioRol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
            $usuarioCi = isset($_SESSION['ci_empleado']) ? $_SESSION['ci_empleado'] : '';
            ?>

            <?php if ($usuarioRol === 'empleado'): ?>
              <input type="hidden" name="ci_empleado" value="<?= htmlspecialchars($usuarioCi) ?>">
              <input type="text" class="form-control" value="<?php foreach ($empleados as $d) {
                                                                if ($d['ci_empleado'] == $usuarioCi) {
                                                                  echo htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']);
                                                                  break;
                                                                }
                                                              }
                                                              ?>" readonly>
            <?php else: ?>
              <select class="form-select" name="ci_empleado" required>
                <option value="">Seleccione un empleado</option>
                <?php foreach ($empleados as $d): ?>
                  <option value="<?= $d['ci_empleado'] ?>" <?= ($data['ci_empleado'] == $d['ci_empleado']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            <?php endif; ?>
          </div>
          <div class="col-md-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?= htmlspecialchars($data['fecha_inicio']) ?>" min="<?= date('Y-m-d') ?>" required>
          </div>
          <div class="col-md-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input
              type="date"
              class="form-control"
              id="fecha_fin"
              name="fecha_fin"
              value="<?= htmlspecialchars($data['fecha_fin']) ?>"
              required readonly>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const fechaInicio = document.getElementById('fecha_inicio');
                const fechaFin = document.getElementById('fecha_fin');

                function sumarDias(fecha, dias) {
                  const f = new Date(fecha);
                  f.setDate(f.getDate() + dias);
                  // Ajuste para formato yyyy-mm-dd
                  const year = f.getFullYear();
                  const month = String(f.getMonth() + 1).padStart(2, '0');
                  const day = String(f.getDate()).padStart(2, '0');
                  return `${year}-${month}-${day}`;
                }

                fechaInicio.addEventListener('change', function() {
                  if (this.value) {
                    fechaFin.value = sumarDias(this.value, 15);
                  } else {
                    fechaFin.value = '';
                  }
                });

                // Si ya hay fecha_inicio al cargar, autocompletar fecha_fin si está vacío
                if (fechaInicio.value && !fechaFin.value) {
                  fechaFin.value = sumarDias(fechaInicio.value, 15);
                }
              });
            </script>
          </div>
          <div class="col-md-6">
            <label for="motivo" class="form-label">Motivo (opcional)</label>
            <textarea
              class="form-control"
              id="motivo"
              name="motivo"
              maxlength="100"
              rows="3"
              placeholder="Ingrese el motivo de la solicitud (opcional)"
              style="resize: none; min-height: 80px; max-height: 80px;"><?= htmlspecialchars($data['motivo'] ?? '') ?></textarea>
          </div>
          <div class="col-md-3">
            <label for="dias" class="form-label">Días</label>
            <input
              type="number"
              class="form-control"
              id="dias"
              name="dias"
              value="<?= htmlspecialchars($data['dias']) ?>"
              min="1"
              max="30"
              required
              readonly>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const fechaInicio = document.getElementById('fecha_inicio');
                const fechaFin = document.getElementById('fecha_fin');
                const diasInput = document.getElementById('dias');

                function calcularDias(inicio, fin) {
                  if (!inicio || !fin) return '';
                  const f1 = new Date(inicio);
                  const f2 = new Date(fin);
                  const diff = (f2 - f1) / (1000 * 60 * 60 * 24) + 1;
                  return diff > 0 ? diff : '';
                }

                function actualizarDias() {
                  diasInput.value = calcularDias(fechaInicio.value, fechaFin.value);
                }

                fechaInicio.addEventListener('change', actualizarDias);
                fechaFin.addEventListener('change', actualizarDias);

                // Inicializar al cargar
                actualizarDias();
              });
            </script>
            
              <div class="col-md-5">
                <label for="aprobado" class="form-label">Estado</label>
                <?php if ($usuarioRol === 'empleado'): ?>
                  <input type="hidden" name="aprobado" value="Pendiente">
                  <input type="text" class="form-control" value="Pendiente" readonly>
                <?php else: ?>
                  <select class="form-select" id="aprobado" name="aprobado" required>
                    <option value="Pendiente" <?= ($data['aprobado'] === 'Pendiente' || empty($data['aprobado'])) ? 'selected' : '' ?>>Pendiente</option>
                    <option value="Sí" <?= ($data['aprobado'] === 'Sí') ? 'selected' : '' ?>>Sí</option>
                    <option value="No" <?= ($data['aprobado'] === 'No') ? 'selected' : '' ?>>No</option>
                  </select>
                <?php endif; ?>
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