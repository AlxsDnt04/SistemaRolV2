<?php
require_once '../../models/Documento.php';
require_once '../../models/Empleado.php';
$documento = new Documento();
$rolModel = new Empleado();

$rol = $rolModel->obtenerTodos();
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

<div class="container mt-3">
  <div class="card shadow">
    <div class="card-header header">
      <h4 class="mb-0"><i class="fa-solid fa-plus"></i> Insertar Documento</h4>
      <a href="../login/dashboard2.php?contenido=documento/listar.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-list"></i> Ver Documentos</a>
    </div>
    <div class="card-body">

      <form action="../../controllers/DocumentoController.php" method="POST" enctype="multipart/form-data">
        <?php if ($esEdicion): ?>
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <?php else: ?>
          <input type="hidden" name="accion" value="crear">
        <?php endif; ?>
        <div class="row">
          <div class="col-md-6">
            <label for="meses" class="form-label">Mes</label>
            <select name="mes" class="form-select" required>
              <option value="" disabled <?= empty($data['mes']) ? 'selected' : '' ?>>Seleccione un mes</option>
              <?php
              $meses = [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
              ];
              foreach ($meses as $mes) {
                $selected = ($data['mes'] === $mes) ? 'selected' : '';
                echo "<option value=\"$mes\" $selected>$mes</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3" maxlength="100" required style="resize: none;"><?= htmlspecialchars($data['descripcion']) ?></textarea>
          </div>
          <div class="col-md-6 mt-3">
            <label for="archivo" class="form-label">Seleccion el archivo</label>
            <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.txt">
          </div>
          <div class="col-md-6 mt-3">
            <label for="empleado" class="form-label">Seleccion el empleado</label>
            <?php
            $usuarioRol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
            $usuarioCi = isset($_SESSION['ci_empleado']) ? $_SESSION['ci_empleado'] : '';
            ?>

            <?php if ($usuarioRol === 'empleado'): ?>
              <input type="hidden" name="ci_empleado" value="<?= htmlspecialchars($usuarioCi) ?>">
              <input type="text" class="form-control" value="<?php
                                                              foreach ($rol as $d) {
                                                                if ($d['ci_empleado'] == $usuarioCi) {
                                                                  echo htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']);
                                                                  break;
                                                                }
                                                              }
                                                              ?>" readonly>
            <?php else: ?>
              <select class="form-select" name="ci_empleado" required>
                <option value="">Seleccione un empleado</option>
                <?php foreach ($rol as $d): ?>
                  <option value="<?= $d['ci_empleado'] ?>" <?= ($data['ci_empleado'] == $d['ci_empleado']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            <?php endif; ?>
          </div>
        </div>
        <!-- enviar -->
        <div class="mt-4 text-center">
          <button type="submit" class="btn btn-success px-5" <?= $esEdicion ? 'name="actualizar"' : 'name="crear"' ?>>
            <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </div>
    </div>
  </div>
  </form>
</div>