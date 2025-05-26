<?php
require_once '../../models/Empleado.php';
require_once '../../models/Departamento.php';
$empleado = new Empleado();
$departamento = new Departamento();
$empleados = $empleado->obtenerTodos();



?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Listado de empleados</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/listado.css">

</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-users"></i> Listado de Empleados</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-user-plus"></i> Nuevo Empleado</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead>
              <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Departamento</th>
                <th>Area</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($empleados)) : ?>
                <?php foreach ($empleados as $emp) : ?>
                  <tr>
                    <td><?= htmlspecialchars($emp['ci_empleado']) ?></td>
                    <td><?= htmlspecialchars($emp['nombre']) ?></td>
                    <td><?= htmlspecialchars($emp['apellido']) ?></td>
                    <td><?= htmlspecialchars($emp['correo']) ?></td>
                    <td><?= htmlspecialchars($emp['direccion']) ?></td>
                    <td><?= htmlspecialchars($emp['telefono']) ?></td>
                    <td><?= htmlspecialchars($emp['departamento_nombre']) ?></td>
                    <td><?= htmlspecialchars($emp['area']) ?></td>
                    
                    <td class="text-center">
                      <a href="formulario.php?id=<?= $emp['ci_empleado'] ?>" class="btn btn-warning btn-sm">
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
<!-- alertas -->
<?php
  if (isset($_GET['success'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/javascript/alertas.js"></script>
    <script>
      mostrarAlertaSwal('<?= htmlspecialchars($_GET['success']) ?>');
    </script>
  <?php endif; ?>

</body>

</html>