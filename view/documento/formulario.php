<?php
require_once '../../models/Documento.php';
require_once '../../models/Rol.php';
$documento = new Documento();
$rolModel = new Rol();

$rol = $rolModel->obtenerEmpleados();
$esEdicion = false;
if (isset($_GET['id'])) {
  $data = $documento->obtenerPorIddocumento($_GET['id']);
  $esEdicion = true;
} else {
  $data = [
    'mes' => '',
    'descripcion' => '',
    'ci_empleado' => ''
  ];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Nuevo Documento</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/insertar.css">

</head>

<body>
  <div class="container">
    <div class="header">
      <h4 class="mb-0"><i class="fa-solid fa-plus"></i> Insertar Documento</h4>
      <a href="listar.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-list"></i> Ver Documentos</a>
    </div>

    <form action="../../controllers/DocumentoController.php" method="POST" enctype="multipart/form-data">
      <?php if ($esEdicion): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
      <?php endif; ?>
      <div class="row">
        <div class="col-md-6">
            <label for="meses" class="form-label">Mes</label>
            <select name="mes" class="form-select" required>
              <option value="" disabled selected>Seleccione un mes</option>
              <option value="Enero">Enero</option>
              <option value="Febrero">Febrero</option>
              <option value="Marzo">Marzo</option>
              <option value="Abril">Abril</option>
              <option value="Mayo">Mayo</option>
              <option value="Junio">Junio</option>
              <option value="Julio">Julio</option>
              <option value="Agosto">Agosto</option>
              <option value="Septiembre">Septiembre</option>
              <option value="Octubre">Octubre</option>
              <option value="Noviembre">Noviembre</option>
              <option value="Diciembre">Diciembre</option>
            </select>
          </div>
        <div class="col-md-6">
          <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3" maxlength="100" required style="resize: none;"><?= htmlspecialchars($data['descripcion']) ?></textarea>
        </div>
        <div class="col-md-6 mt-3">
          <label for="archivo" class="form-label">Seleccion el archivo</label>
          <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.txt" required>
        </div>
        <div class="col-md-6 mt-3">
          <label for="empleado" class="form-label">Seleccion el empleado</label>
          <select class="form-select" name="ci_empleado" required>
            <option value="">Seleccione un empleado</option>
            <?php foreach ($rol as $d): ?>
              <option value="<?= $d['ci_empleado'] ?>">
                <?= htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <!-- enviar -->
      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success px-5" <?= $esEdicion ? 'name="actualizar"' : 'name="crear"' ?>>
          <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
      </div>
    </form>
  </div>
</body>

</html>