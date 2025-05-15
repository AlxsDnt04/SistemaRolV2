<?php
require_once '../../models/Departamento.php';
$departamento = new Departamento();
$departamento = $departamento->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Listado de Departamentos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px 0;
    }

    .container {
      max-width: 1000px;
    }

    .card {
      background-color: #2c2c2c;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .card-header {
      background-color: #4CAF50;
      color: white;
      font-weight: bold;
      border-radius: 12px 12px 0 0;
      padding: 15px;
    }

    .table {
      background-color: #1f1f1f;
    }

    .table th {
      background-color: #333;
      color: #00ff88;
    }

    .table tbody tr:nth-child(even) {
      background-color: #2a2a2a;
    }

    .table td {
      color: #ddd;
    }

    .btn-warning {
      background-color: #f0ad4e;
      border: none;
    }

    .btn-warning:hover {
      background-color: #ec971f;
    }

    .btn-danger {
      background-color: #d9534f;
      border: none;
    }

    .btn-danger:hover {
      background-color: #c9302c;
    }

    .btn-outline-light {
      border-color: #fff;
      color: #fff;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #000;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Departamentos</h5>
        <a href="formulario.php" class="btn btn-outline-light btn-sm">Nuevo Departamento</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ubicación</th>
              <th>Área</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($departamento)) : ?>
              <?php foreach ($departamento as $dep) : ?>
                <tr>
                  <td><?= htmlspecialchars($dep['id_departamento']) ?></td>
                  <td><?= htmlspecialchars($dep['nombre']) ?></td>
                  <td><?= htmlspecialchars($dep['ubicacion']) ?></td>
                  <td><?= htmlspecialchars($dep['area']) ?></td>
                  <td class="text-center">
                    <a href="formulario.php?id=<?= $dep['id_departamento'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="text-center text-warning">No hay departamentos registrados.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>