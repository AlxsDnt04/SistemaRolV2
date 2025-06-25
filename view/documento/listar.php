<?php
require_once '../../models/Documento.php';
$documento = new Documento();
$consulta = $documento->obtenerDocumentosInnerJ();
?>

  
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa-solid fa-file-lines"></i> Listado de Documentos</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm">
            <i class="fa-solid fa-upload"></i> Subir documento</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-striped table-responsive align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Descripcion</th>
              <th>Mes</th>
              <th>Fecha de carga</th>
              <th>Archivo</th>
              <th>id - mes generado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($consulta)) : ?>
              <?php foreach ($consulta as $dep) : ?>
                <tr>
                    <td class="text-center align-middle"><?= htmlspecialchars($dep['id']) ?></td>
                  <td class="text-center align-middle"><?= htmlspecialchars($dep['ci_empleado']) ?></td>
                  <td class="text-center align-middle"><?= htmlspecialchars($dep['nombre']) ?></td>
                  <td class="text-center align-middle"><?= htmlspecialchars($dep['apellido']) ?></td>
                  <td class="text-center align-middle"><?= htmlspecialchars($dep['descripcion']) ?></td>
                  <td class="text-center align-middle"><?= htmlspecialchars($dep['mes']) ?></td>
                  <td class="text-center align-middle"><?= htmlspecialchars($dep['fecha_carga']) ?></td>
                  <!-- enlace para ver el archivo en el navegador -->
                 <td class="text-center align-middle">
                  <?= htmlspecialchars($dep['archivo']) ?>
                  <a href="../../<?= htmlspecialchars($dep['archivo']) ?>" target="_blank" class="btn btn-link btn-sm">
                    <i class="fa-solid fa-eye"></i> Ver</a>
                 </td>
                 <td class="text-center align-middle"><?= htmlspecialchars($dep['id_rol'] . ' - ' . $dep['mes_rol_generado']) ?></td>

                 <td class="text-center align-middle">
                    <!-- EDITAR -->
                    <a href="formulario.php?id=<?= $dep['id'] ?>" class="btn btn-warning btn-sm">
                      <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                    <!-- ELIMINAR -->
                    <a href="../../controllers/DocumentoController.php?accion=eliminar&id=<?= $dep['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                      <i class="fa-solid fa-trash"></i> Eliminar</a>
                  </td>
                </tr>
                <!-- php endforeach para cerrar el foreach -->
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="10" class="text-center text-warning">No hay documentos registrados.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
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

