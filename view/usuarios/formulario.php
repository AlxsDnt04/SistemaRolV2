<?php
require_once '../../models/Empleado.php';
require_once '../../models/Usuarios.php';
$emp = new Empleado();
$usr = new Usuarios();
$empleado = $emp->obtenerTodos();

if (isset($_GET['id'])) {
  $esEdicion = true;
  $data = $usr->obtenerUsuarioPorId($_GET['id']);
} else {
  $esEdicion = false;
  $data = [
    'id' => '',
    'usuario' => '',
    'contrasena' => '',
    'rol' => '',
    'empleado' => ''
  ];
}
?>

  <div class="container mt-3">
    <div class="card shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fa-solid fa-plus"></i> Registrar Usuario</h4>
        <a href="dashboard2.php?contenido=usuarios/listar.php" class="btn btn-light btn-sm">
          <i class="fa-solid fa-list"></i> Ver Usuarios</a>
      </div>
      <div class="card-body">
        <form action="../../controllers/UsuariosController.php" method="POST">
          <?php if ($esEdicion): ?>
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
          <?php else: ?>
            <input type="hidden" name="accion" value="crear">
          <?php endif; ?>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="usuario" class="form-label">Nombre de usuario</label>
              <input type="text" class="form-control" id="user" name="usuario" maxlength="30" required
                value="<?= isset($data['usuario']) ? htmlspecialchars($data['usuario']) : '' ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label for="contrasena" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="contrasena" name="contrasena" maxlength="50" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="rol" class="form-label">Rol del Usuario</label>
              <select class="form-select" id="rol" name="rol" required>
                <option value="" disabled <?= empty($data['rol']) ? 'selected' : '' ?>>Seleccione un rol</option>
                <option value="admin" <?= (isset($data['rol']) && $data['rol'] === 'admin') ? 'selected' : '' ?>>Administrador</option>
                <option value="empleado" <?= (isset($data['rol']) && $data['rol'] === 'empleado') ? 'selected' : '' ?>>Usuario</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="empleado" class="form-label">Empleado</label>
              <select class="form-select" id="ci_empleado" name="ci_empleado">
                <option value="" disabled <?= empty($data['ci_empleado']) ? 'selected' : '' ?>>Seleccione un empleado</option>
                <?php foreach ($empleado as $e): ?>
                  <option value="<?= htmlspecialchars($e['ci_empleado']) ?>"
                    <?= (isset($data['ci_empleado']) && $data['ci_empleado'] == $e['ci_empleado']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e['ci_empleado'] . ' - ' . $e['nombre'] . ' ' . $e['apellido']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success px-5">
              <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            <button type="reset" class="btn btn-secondary px-5">
              <i class="fa-solid fa-eraser"></i> Limpiar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ciEmpleadoSelect = document.getElementById('ci_empleado');
      var usuarioInput = document.getElementById('user');
      if (ciEmpleadoSelect && usuarioInput) {
        ciEmpleadoSelect.addEventListener('change', function() {
          usuarioInput.value = this.value;
        });
      }
    });
  </script>
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

  
  
