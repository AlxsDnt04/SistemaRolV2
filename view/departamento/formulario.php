<?php
require_once '../../models/Departamento.php';
$departamento = new Departamento();

if (isset($_GET['id'])) {
  $data = $departamento->obtenerPorId($_GET['id']);
} else {
  $data = ['id_departamento' => '', 'nombre' => '', 'ubicacion' => '', 'area' => ''];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Insertar Departamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/insertarDep.css"> 

</head>

<body>
  <div class="container">
    <div class="header">
      <h4 class="mb-0">Insertar Departamento</h4>
      <a href="listar.php" class="btn btn-light btn-sm">Ver Departamentos</a>
    </div>

    <form action="../../controllers/DepartamentoController.php" method="POST">
      <div class="row">
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre del Departamento</label>
          <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30" value="<?= htmlspecialchars($data['nombre']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="ubicacion" class="form-label">Ubicación</label>
          <input type="text" class="form-control" id="ubicacion" name="ubicacion" maxlength="120" value="<?= htmlspecialchars($data['ubicacion']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="area" class="form-label">Área</label>
          <input type="text" class="form-control" id="area" name="area" maxlength="30" value="<?= htmlspecialchars($data['area']) ?>" required>
        </div>
      </div>

      
      <!-- Campo oculto para identificar si es creación, edición o eliminación -->
      <input type="hidden" name="accion" value="<?= isset($_GET['id']) ? 'editar' : 'crear' ?>">
      <input type="hidden" name="id_departamento" value="<?= htmlspecialchars($data['id_departamento']) ?>">



      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success px-5">Guardar</button>
      </div>
    </form>
  </div>
</body>

</html>