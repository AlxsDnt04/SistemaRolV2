<?php
require_once '../../models/Rol.php';
$rol = new Rol();
$consultaRol = $rol->consultaRolInnerJoin();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Lista de Roles</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/listado.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-building"></i> Listado de Roles</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm">
          <i class="fa-solid fa-plus"></i> Nuevo registro de rol</a>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <input type="text" id="busquedaUsuario" class="form-control" placeholder="Buscar por cédula o usuario...">
        </div>
        <div class="tabla-scroll">
          <table class="table table-bordered table-hover">
            <h1 id="titulo-tabla">Roles registrados</h1>
            <thead>
              <tr>
                <th>Usuario</th>
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
                <th>ID</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($consultaRol)) : ?>
                <?php foreach ($consultaRol as $dep) : ?>
                  <tr>
                    <td><?= htmlspecialchars($dep['ci_empleado'] . ' - ' . $dep['nombre'] . ' ' . $dep['apellido']) ?></td>
                    <td><?= htmlspecialchars($dep['mes']) ?></td>
                    <td><?= htmlspecialchars($dep['hora25']) ?></td>
                    <td><?= htmlspecialchars($dep['hora50']) ?></td>
                    <td><?= htmlspecialchars($dep['hora100']) ?></td>
                    <td><?= htmlspecialchars($dep['bonos']) ?></td>
                    <td><?= htmlspecialchars($dep['sueldo']) ?></td>
                    <td><?= htmlspecialchars($dep['iess']) ?></td>
                    <td><?= htmlspecialchars($dep['multas']) ?></td>
                    <td><?= htmlspecialchars($dep['atrasos']) ?></td>
                    <td><?= htmlspecialchars($dep['alimentacion']) ?></td>
                    <td><?= htmlspecialchars($dep['anticipos']) ?></td>
                    <td><?= htmlspecialchars($dep['otros']) ?></td>
                    <td><?= htmlspecialchars($dep['totalIngreso']) ?></td>
                    <td><?= htmlspecialchars($dep['totalEgreso']) ?></td>
                    <td><?= htmlspecialchars($dep['totalPagar']) ?></td>
                    <td><?= htmlspecialchars($dep['fecha_registro']) ?></td>
                    <td><?= htmlspecialchars($dep['id_rol']) ?></td>
                    <td class="text-center acciones">
                      <a href="formulario.php?id=<?= $dep['id_rol'] ?>" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                      <!-- ELIMINAR -->
                      <a href="../../controllers/RolController.php?accion=eliminar&id=<?= $dep['id_rol'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este departamento?');">
                        <i class="fa-solid fa-trash"></i> Eliminar</a>
                      <!-- pdf -->
                      <a href="../../controllers/ReporteRol.php?id=<?=$dep['id_rol'] ?>" class="btn btn-info btn-sm">
                        <i class="fa-solid fa-file-pdf"></i> PDF</a>
            
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="19" class="text-center text-warning">No hay departamentos registrados.</td>
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