<?php
require_once '../../models/Empleado.php';
$emp = new Empleado();
$empleado = $emp->obtenerTodos();

if (isset($_GET['id'])) {
  //$data = $departamento->obtenerPorId($_GET['id']);
} else {
  $data = [
    'usuario' => '',
    'contrasena' => '',
    'rol' => '',
    'empleado' => ''
  ];
}  
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Insertar Departamento</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/insertar.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <h4 class="mb-0"><i class="fa-solid fa-plus"></i> Registrar Usuario</h4>
      <a href="listar.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-list"></i> Ver Usuarios</a>
    </div>
    <form action="../../controllers/UsuarioController.php" method="POST">
      <div class="row">
        <div class="col-md-6">
          <label for="usuario" class="form-label">Nombre de usuario</label>
          <input type="text" class="form-control" id="user" name="usuario" maxlength="30" required>
        </div>
        <div class="col-md-6">
          <label for="contrasena" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="contrasena" name="contrasena" maxlength="50" required>
        </div>
        <div class="col-md-6">
          <label for="rol" class="form-label">Rol del Usuario</label>
          <select class="form-select" id="rol" name="rol" required>
            <option value="" disabled>Seleccione un rol</option>
            <option value="admin">Administrador</option>
            <option value="empleado">Usuario</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="empleado" class="form-label">Empleado</label>
          <select class="form-select" id="empleado" name="empleado" required>
            <option value="" disabled>Seleccione un empleado</option>
            <?php foreach ($empleado as $e): ?>
              <option value="<?= htmlspecialchars($e['ci_empleado']) ?>">
                <?= htmlspecialchars($e['nombre'] . ' ' . $e['apellido']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <!-- Campo oculto para identificar si es creación, edición o eliminación -->
      <input type="hidden" name="accion" value="<?= isset($_GET['id']) ? 'editar' : 'crear' ?>">
      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success px-5">
          <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        <button type="reset" class="btn btn-secondary px-5">
          <i class="fa-solid fa-eraser"></i> Limpiar</button>
      </div>
    </form>
  </div>
</body>

</html>