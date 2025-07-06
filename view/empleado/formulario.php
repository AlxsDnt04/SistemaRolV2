<?php
require_once '../../models/Empleado.php';
$empleado = new Empleado();

// Verificar si se está editando un empleado y bloquear el campo de cédula
if (isset($_GET['id'])) {
  // Obtener el empleado por ID
  $data = $empleado->obtenerPorId($_GET['id']);
} else {
  // Si no se está editando, inicializar un array vacío
  $data = [
    'ci_empleado' => '',
    'nombre' => '',
    'apellido' => '',
    'telefono' => '',
    'direccion' => '',
    'correo' => '',
    'id_departamento' => ''
  ];
}
?>
  <div class="container mt-3">
    <div class="card mt-4 shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fa-solid fa-user-plus"></i> Insertar Empleado </h4>
        <a href="../login/dashboard2.php?contenido=empleado/listar.php" class="btn btn-light btn-sm"><i class="fa-solid fa-users"></i> Ver Empleados </a>
      </div>
      <div class="card-body">
        <form action="../../controllers/EmpleadoController.php" method="POST">
          <div class="row">
            <div class="col-md-6">
              <label for="cedula" class="form-label">Cedula</label>
              <input type="text" class="form-control" id="cedula" name="ci_empleado" maxlength="10" value="<?= htmlspecialchars($data['ci_empleado']) ?>" required pattern="\d*" title="Solo se permiten números" oninput="this.value = this.value.replace(/[^0-9]/g, ''); " <?= isset($_GET['id']) ? 'readonly' : '' ?>>
            </div>
            <div class="col-md-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30" value="<?= htmlspecialchars($data['nombre']) ?>" required>
            </div>
            <div class="col-md-6">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="apellido" name="apellido" maxlength="30" value="<?= htmlspecialchars($data['apellido']) ?>" required>
            </div>
            <div class="col-md-6">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="telefono" maxlength="10" value="<?= htmlspecialchars($data['telefono']) ?>" required pattern="\d*" title="Solo se permiten números" oninput="this.value = this.value.replace(/[^0-9]/g, '');" >
            </div>
            <div class="col-md-6">
              <label for="direccion" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="direccion" name="direccion" maxlength="120" value="<?= htmlspecialchars($data['direccion']) ?>" required>
            </div>
            <div class="col-md-6">
              <label for="correo" class="form-label">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" maxlength="50" value="<?= htmlspecialchars($data['correo']) ?>" required>
            </div>
            <div class="col-md-6">
              <label for="id_departamento" class="form-label">Departamento</label>
              <select class="form-select" id="id_departamento" name="id_departamento" required>
                <option value="" disabled <?= empty($data['id_departamento']) ? 'selected' : '' ?>>Seleccione un departamento</option>
                <?php
                require_once '../../models/Departamento.php';
                $departamento = new Departamento();
                $departamentos = $departamento->obtenerTodos();
                foreach ($departamentos as $dep) {
                  $selected = ($data['id_departamento'] == $dep['id_departamento']) ? 'selected' : '';
                  echo "<option value=\"{$dep['id_departamento']}\" $selected>" . htmlspecialchars($dep['nombre']) . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="accion" value="<?= isset($_GET['id']) ? 'editar' : 'crear' ?>">
          <?php if (isset($_GET['id'])) : ?>
            <input type="hidden" name="id_empleado" value="<?= htmlspecialchars($_GET['id']) ?>">
          <?php endif; ?>
          <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success px-5"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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

