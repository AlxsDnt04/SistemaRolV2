<?php
require_once '../../models/Empleado.php';
require_once '../../models/Departamento.php';
$empleado = new Empleado();
$departamento = new Departamento();
$empleados = $empleado->obtenerTodos();
?>

  <div class="container mt-3">
    <div class="card shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-users"></i> Listado de Empleados</h5>
        <a href="../login/dashboard2.php?contenido=empleado/formulario.php" class="btn btn-light btn-sm"><i class="fa-solid fa-user-plus"></i> Nuevo Empleado</a>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <input type="text" id="busquedaUsuario" class="form-control" placeholder="Ingrese el nombre o CI del empleado para buscar..." onkeyup="buscarUsuario()">
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark text-center">
              <tr>
                <th>Empleado</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Departamento</th>
                <th>Area</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($empleados)) : ?>
                <?php foreach ($empleados as $emp) : ?>
                  <tr class="text-center align-middle">
                    <td class="fw-bold"><?= htmlspecialchars($emp['ci_empleado'].' - '.$emp['nombre'].' '.$emp['apellido']) ?></td>
                    <td><?= htmlspecialchars($emp['correo']) ?></td>
                    <td><?= htmlspecialchars($emp['direccion']) ?></td>
                    <td><?= htmlspecialchars($emp['telefono']) ?></td>
                    <td><?= htmlspecialchars($emp['departamento_nombre']) ?></td>
                    <td><?= htmlspecialchars($emp['area']) ?></td>
                    
                    <td class="btn-group" role="group">
                      <a href="../login/dashboard2.php?contenido=empleado/formulario.php&id=<?= $emp['ci_empleado'] ?>" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                      </a>
                      <!-- ELIMINAR -->
                      <a href="../../controllers/EmpleadoController.php?accion=eliminar&id=<?= $emp['ci_empleado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                        <i class="fa-solid fa-trash"></i> Eliminar
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>            
                <tr>
                  <td colspan="9" class="text-center text-warning">No hay empleados registrados.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/javascript/busquedaUsuario.js"></script>
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
