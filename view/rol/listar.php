<?php
require_once '../../models/Rol.php';
$rol = new Rol();

if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'empleado') {
  // Si el rol es empleado, obtener solo los documentos del usuario
  $consultaRol = $rol->obtenerRolPorCI();
} else {
  // Si el rol es administrador, obtener todos los documentos
  $consultaRol = $rol->consultaRolInnerJoin();
}

?>

  <div class="container mt-3">
    <div class="card shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-file-invoice-dollar"></i> Listado de Roles</h5>
        <a href="../login/dashboard2.php?contenido=rol/formulario.php" class="btn btn-light btn-sm">
          <i class="fa-solid fa-plus"></i> Nuevo registro de rol</a>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <input type="text" id="busquedaUsuario" class="form-control" placeholder="Buscar por cédula o usuario...">
        </div>
        <div class="tabla-scroll">
          <div class="tabla-scroll overflow-auto" style="max-width: 100%;">
            <table class="table table-bordered table-hover table-striped table-responsive align-middle">  
              <thead>
                <tr>
                  <th>Empleado</th>
                  <th>Mes</th>
                  <th>Hora 25%</th>
                  <th>Hora 50%</th>
                  <th>Hora 100%</th>
                  <th>Bonos</th>
                  <th>Sueldo</th>
                  <th>IESS</th>
                  <th>Multas</th>
                  <th>Atrasos</th>
                  <th>Alimentación</th>
                  <th>Anticipos</th>
                  <th>Otros</th>
                  <th>Total Ingresos</th>
                  <th>Total Egresos</th>
                  <th>Total a Pagar</th>
                  <th>Fecha de Registro</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($consultaRol)) : ?>
                  <?php foreach ($consultaRol as $dep) : ?>
                      <tr class="text-center align-middle">
                      <td class="align-middle"><?= htmlspecialchars($dep['ci_empleado'] . ' - ' . $dep['nombre'] . ' ' . $dep['apellido']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['mes']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['hora25']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['hora50']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['hora100']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['bonos']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['sueldo']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['iess']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['multas']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['atrasos']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['alimentacion']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['anticipos']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['otros']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['totalIngreso']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['totalEgreso']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['totalPagar']) ?></td>
                      <td class="align-middle"><?= htmlspecialchars($dep['fecha_registro']) ?></td>
                            <!-- acciones para el admin -->
                <?php if ($_SESSION['rol'] !== 'empleado') : ?>
                      <td class="text-center align-middle acciones">
                        <div class="d-flex justify-content-center gap-1">
                        <a href="../login/dashboard2.php?contenido=rol/formulario.php&id=<?= $dep['id_rol'] ?>" class="btn btn-warning btn-sm">
                          <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                        <a href="../../controllers/RolController.php?accion=eliminar&id=<?= $dep['id_rol'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este rol registrado?');">
                          <i class="fa-solid fa-trash"></i> Eliminar</a>
                        <a href="../../controllers/ReporteRol.php?id=<?= $dep['id_rol'] ?>" class="btn btn-info btn-sm" target="_blank">
                          <i class="fa-solid fa-file-pdf"></i> PDF</a>
                        </div>
                      </td>
                <?php else : ?>
                  <td class="text-center align-middle acciones">
                        <a href="../../controllers/ReporteRol.php?id=<?= $dep['id_rol'] ?>" class="btn btn-info btn-sm" target="_blank">
                          <i class="fa-solid fa-file-pdf"></i> Generar Reporte</a>
                        </div>
                      </td>
                <?php endif; ?>
                      </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="19" class="text-center text-warning">No hay roles registrados.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../assets/javascript/busquedaUsuario.js"></script>
  <!-- alertas -->
  <?php
  if (isset($_GET['success'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/javascript/alertas.js"></script>
    <script>
      mostrarAlertaSwal('<?= htmlspecialchars($_GET['success']) ?>');
    </script>
  <?php endif; ?>
