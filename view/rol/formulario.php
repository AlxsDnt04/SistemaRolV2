<?php
require_once '../../models/Rol.php';
require_once '../../models/Empleado.php';
$empleadoModel = new Empleado(); // instancia modelo empleado
$rolModel = new Rol(); // instancia modelo rol
$empleado = $empleadoModel->obtenerTodos(); // funcion para obtener todos los empleados

if (isset($_GET['id'])) {
  // Si se pasa un ID, se asume que es una edición
  $rolData = $rolModel->obtenerRolPorId($_GET['id']); // funcion para obtener rol por id
  if ($rolData) {
    // Si se encuentra el rol, se asigna a las variables del formulario
    $data = [
      'empleadoInfo' => $rolData['ci_empleado'],
      'meses' => $rolData['mes'],
      'bonos' => $rolData['bonos'],
      'sueldo' => $rolData['sueldo'],
      'hora25' => $rolData['hora25'],
      'hora50' => $rolData['hora50'],
      'hora100' => $rolData['hora100'],
      'multas' => $rolData['multas'],
      'atrasos' => $rolData['atrasos'],
      'alimentacion' => $rolData['alimentacion'],
      'anticipo' => $rolData['anticipos'],
      'otros' => $rolData['otros'],
    ];
  } else {
    // Si no se encuentra el rol, redirigir o mostrar un error
    echo "<div class='alert alert-danger'>Rol no encontrado. <a href='../login/dashboard2.php?contenido=rol/listar.php'>Volver al listado</a></div>";
    return;
  }
} else {
  // Si no hay ID, es una creación nueva
  $data = [
    'empleadoInfo' => '',
    'hora25' => '',
    'hora50' => '',
    'hora100' => '',
    'meses' => '',
    'bonos' => '',
    'sueldo' => '',
    'multas' => '',
    'atrasos' => '',
    'alimentacion' => '',
    'anticipo' => '',
    'otros' => '',
  ];
}
?>


<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center bg-light">
          <h4 class="mb-0"><i class="fa-solid fa-money-bill-wave"></i> Ingresos y Egresos</h4>
          <a href="../login/dashboard2.php?contenido=rol/listar.php" class="btn btn-light btn-sm">
            <i class="fa-solid fa-list"></i> Ver Registro de Roles
          </a>
        </div>

        <div class="card-body">
          <form id="rolPagos" action="../../controllers/RolController.php" method="POST">
            <!-- Datos personales -->
            <div class="mb-4">
              <label>Empleado</label>
              <select class="form-select" name="empleadoInfo" id="empleadoInfo" required>
                <option value="">Seleccione un empleado</option>
                <?php
                $usuarioRol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
                $usuarioCi = isset($_SESSION['ci_empleado']) ? $_SESSION['ci_empleado'] : '';
                ?>
                <?php foreach ($empleado as $d): ?>
                  <?php
                  // Si el usuario es empleado, solo muestra su opción y deshabilita el select
                  if ($usuarioRol === 'empleado') {
                    if ($d['ci_empleado'] == $usuarioCi) {
                      ?>
                      <option value="<?= $d['ci_empleado'] ?>" selected>
                        <?= htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']) ?>
                      </option>
                      <?php
                    }
                  } else {
                    // Si es admin, muestra todas las opciones y permite seleccionar
                    ?>
                    <option value="<?= $d['ci_empleado'] ?>" <?= ($data['empleadoInfo'] == $d['ci_empleado']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']) ?>
                    </option>
                    <?php
                  }
                  ?>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- Ingresos y Egresos en dos columnas -->
            <div class="row g-3">
              <!-- Ingresos -->
              <div class="col-12 col-md-6">
                <div class="border rounded p-3 h-100">
                  <h5 class="mb-3 border-bottom pb-2">Ingresos</h5>
                  <div class="mb-3">
                    <label for="meses" class="form-label">Mes</label>
                    <select name="meses" class="form-select" required>
                      <option value="" disabled <?= empty($data['meses']) ? 'selected' : '' ?>>Seleccione un mes</option>
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
                        $selected = ($data['meses'] == $mes) ? 'selected' : '';
                        echo "<option value=\"$mes\" $selected>$mes</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="sueldo" class="form-label">Sueldo</label>
                    <input type="number" step="0.01" class="form-control" id="sueldo" name="sueldo" placeholder="Ingrese su sueldo" required value="<?= htmlspecialchars($data['sueldo']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="hora25" class="form-label">Hora 25%</label>
                    <input type="number" class="form-control" id="hora25" name="hora25" placeholder="Valor hora 25%" value="<?= htmlspecialchars($data['hora25']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="hora50" class="form-label">Hora 50%</label>
                    <input type="number" class="form-control" id="hora50" name="hora50" placeholder="Valor hora 50%" value="<?= htmlspecialchars($data['hora50']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="hora100" class="form-label">Hora 100%</label>
                    <input type="number" class="form-control" id="hora100" name="hora100" placeholder="Valor hora 100%" value="<?= htmlspecialchars($data['hora100']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="bonos" class="form-label">Bonos</label>
                    <input type="number" class="form-control" id="bonos" name="bonos" placeholder="Valor bonos" value="<?= htmlspecialchars($data['bonos']) ?: '0' ?>">
                  </div>

                </div>
              </div>
              <!-- Egresos -->
              <div class="col-12 col-md-6">
                <div class="border rounded p-3 h-100">
                  <h5 class="mb-3 border-bottom pb-2">Egresos</h5>
                  <div class="mb-3">
                    <label for="iess" class="form-label">IESS</label>
                    <input type="number" class="form-control" id="iess" name="iesst" readonly placeholder="No se ingresa ningún valor">
                  </div>
                  <div class="mb-3">
                    <label for="multas" class="form-label">Multas</label>
                    <input type="number" class="form-control" id="multas" name="multas" placeholder="Valor de multas" value="<?= htmlspecialchars($data['multas']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="atrasos" class="form-label">Atrasos</label>
                    <input type="number" class="form-control" id="atrasos" name="atrasos" placeholder="Valor de atrasos" value="<?= htmlspecialchars($data['atrasos']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="alimentacion" class="form-label">Alimentación</label>
                    <input type="number" class="form-control" id="alimentacion" name="alimentacion" placeholder="Valor de alimentación" value="<?= htmlspecialchars($data['alimentacion']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="anticipo" class="form-label">Anticipo</label>
                    <input type="number" class="form-control" id="anticipo" name="anticipo" placeholder="Valor de anticipo" value="<?= htmlspecialchars($data['anticipo']) ?>">
                  </div>
                  <div class="mb-3">
                    <label for="otros" class="form-label">Otros</label>
                    <input type="number" class="form-control" id="otros" name="otros" placeholder="Otros egresos" value="<?= htmlspecialchars($data['otros']) ?>">
                  </div>

                </div>
              </div>
            </div>
            <!-- Totales -->
            <div class="mb-4 mt-4">
              <div class="row mb-3">
                <h5 class="mb-3 border-bottom pb-2">Totales</h5>
                <div class="col-md-4 mb-3 mb-md-0">
                  <label for="temp_total_25" class="form-label">Total 25%</label>
                  <input type="number" id="temp_total_25" name="total25" class="form-control" readonly placeholder="0.00">
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <label for="temp_total_50" class="form-label">Total 50%</label>
                  <input type="number" id="temp_total_50" name="total50" class="form-control" readonly placeholder="0.00">
                </div>
                <div class="col-md-4">
                  <label for="temp_total_100" class="form-label">Total 100%</label>
                  <input type="number" id="temp_total_100" name="total100" class="form-control" readonly placeholder="0.00">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label for="temp_total_ingresos" class="form-label">Total Ingresos</label>
                  <input type="number" id="temp_total_ingresos" name="total_ingresos" class="form-control" readonly placeholder="$ 0.00">
                </div>
                <div class="col-md-6">
                  <label for="totalEgresos" class="form-label">Total Egresos</label>
                  <input type="number" class="form-control" id="totalEgresos" name="totalEgres" readonly placeholder="$ 0.00">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <label for="total_a_pagar" class="form-label">Total a Pagar</label>
                  <input type="number" class="form-control text-center fw-bold" id="total_a_pagar" name="totalPagar" readonly placeholder="$ 0.00">
                </div>
              </div>
            </div>
            <!-- Campo oculto para identificar si es creación, edición -->
            <input type="hidden" name="accion" value="<?= isset($_GET['id']) ? 'editar' : 'crear' ?>">
            <!-- Campo oculto para el ID del rol -->
            <?php if (isset($_GET['id'])) : ?>
              <input type="hidden" name="id_rol" value="<?= htmlspecialchars($_GET['id']) ?>">
            <?php endif; ?>
            <!-- Botones -->
            <div class="text-center">
              <button type="button" id="btnCalcular" class="btn btn-primary me-2">Calcular</button>
              <button type="submit" class="btn btn-success me-2">Enviar</button>
              <button type="reset" class="btn btn-secondary">Limpiar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../../assets/javascript/main.js"></script>