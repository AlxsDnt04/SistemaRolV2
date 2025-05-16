<?php
require_once '../../models/Empleado.php';
$empleado = new Empleado();

if (isset($_GET['id'])) {
  $data = $empleado->obtenerPorId($_GET['id']);
} else {
  $data = ['id_empleado' => '', 'ci_empleado' => '', 'nombre' => '', 'apellido' => '', 'telefono' => '', 'direccion' => '', 'correo' => '', 'id_departamento' => ''];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Insertar Empleado</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/insertarDep.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <h4 class="mb-0"><i class="fa-solid fa-user-plus"></i> Insertar Empleado </h4>
      <a href="listar.php" class="btn btn-light btn-sm"><i class="fa-solid fa-users"></i> Ver Empleados </a>
    </div>

    <form action="../../controllers/EmpleadoController.php" method="POST">
      <div class="row">
        <div class="col-md-6">
          <label for="cedula" class="form-label">Cedula</label>
          <input type="text" class="form-control" id="cedula" name="ci_empleado" maxlength="10" value="<?= htmlspecialchars($data['ci_empleado']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30" value="<?= htmlspecialchars($data['nombre']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" id="apellido" name="apellido" maxlength="30" value="<?= htmlspecialchars($data['apellido']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="telefono" class="form-label">Teléfono</label>
          <input type="text" class="form-control" id="telefono" name="telefono" maxlength="10" value="<?= htmlspecialchars($data['telefono']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion" maxlength="120" value="<?= htmlspecialchars($data['direccion']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" class="form-control" id="correo" name="correo" maxlength="50" value="<?= htmlspecialchars($data['correo']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="departamento" class="form-label">Departamento</label>
          <!-- obtener departamentos y mostrar en lista de opciones -->
          <select class="form-select" id="departamento" name="id_departamento" required>
            <option value="" disabled <?= empty($data['id_departamento']) ? 'selected' : '' ?>>Seleccione un departamento</option>
            <?php
            require_once '../../models/Departamento.php';
            $departamento = new Departamento();
            $departamentos = $departamento->obtenerTodos();
            foreach ($departamentos as $dep) {
              $selected = ($data['id_departamento'] == $dep['id_departamento']) ? 'selected' : '';
              echo "<option value=\"{$dep['id_departamento']}\" $selected>" . htmlspecialchars($dep['nombre']) . "</option>";
            }
            ?>
        </div>
      </div>


      <!-- Campo oculto para identificar si es creación, edición o eliminación -->
      <input type="hidden" name="accion" value="<?= isset($_GET['id']) ? 'editar' : 'crear' ?>">
      <input type="hidden" name="ci_empleado" value="<?= htmlspecialchars($data['ci_empleado']) ?>">



      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success px-5"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
      </div>
    </form>
  </div>
</body>

</html>