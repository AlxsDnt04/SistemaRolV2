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
  <title>Formulario Departamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1e1e2f;
      color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px 0;
    }

    .container {
      max-width: 800px;
      background-color: #2e2e3f;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .header {
      background-color: #4CAF50;
      color: #fff;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .form-label {
      font-weight: 600;
      color: #ccc;
    }

    .form-control {
      background-color: #444;
      border: 1px solid #666;
      color: #fff;
      border-radius: 6px;
    }

    .form-control:focus {
      background-color: #555;
      border-color: #00ff88;
      color: #fff;
    }

    .btn-success {
      background-color: #00c16e;
      border: none;
    }

    .btn-success:hover {
      background-color: #00a85a;
    }

    .row>.col-md-6 {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h4 class="mb-0">Formulario Departamento</h4>
      <a href="listar.php" class="btn btn-light btn-sm">Ver Departamentos</a>
    </div>

    <form action="../../controllers/DepartamentoController.php" method="POST">
      <div class="row">
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre del Departamento</label>
          <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30" value="<?= $data['nombre'] ?>" required>
        </div>
        <div class="col-md-6">
          <label for="ubicacion" class="form-label">Ubicación</label>
          <input type="text" class="form-control" id="ubicacion" name="ubicacion" maxlength="120" value="<?= $data['ubicacion'] ?>" required>
        </div>
        <div class="col-md-6">
          <label for="area" class="form-label">Área</label>
          <input type="text" class="form-control" id="area" name="area" maxlength="30" value="<?= $data['area'] ?>" required>
        </div>
      </div>

      <input type="hidden" name="accion" value="crear">
      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success px-5">Guardar</button>
      </div>
    </form>
  </div>
</body>

</html>