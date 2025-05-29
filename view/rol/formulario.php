<?php
require_once '../../models/Rol.php';
// Instancia de la clase Rol en modelo
$rolModel = new Rol();
$rol = $rolModel->obtenerEmpleados();

if (isset($_GET['id'])) {
    // Si se pasa un ID, se asume que es una edición
    $rolData = $rolModel->obtenerTodoslosRoles($_GET['id']);
    if ($rolData) {
        // Si se encuentra el rol, se asigna a las variables del formulario
        $data = [
            'empleadoInfo' => $rolData['ci_empleado'],
            'meses' => $rolData['mes'],
            'bonos' => $rolData['bonos'],
            'sueldo' => $rolData['sueldo'],
            'multas' => $rolData['multas'],
            'atrasos' => $rolData['atrasos'],
            'alimentacion' => $rolData['alimentacion'],
            'anticipo' => $rolData['anticipo'],
            'otros' => $rolData['otros'],
        ];
    } else {
        // Si no se encuentra el rol, redirigir o mostrar un error
        header('Location: listar.php?error=Rol no encontrado');
        exit;
    }
} else {
    // Si no hay ID, es una creación nueva
    $data = [
        'empleadoInfo' => '',
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

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cálculo de rol de pagos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/css/insertar.css">

</head>

<body>

  <div class="container mt-5 p-4 shadow rounded bg-light">
    <div class="header">
      <h4 class="mb-0"><i class="fa-solid fa-money-bill-wave"></i> Ingresos y Egresos</h4>
      <a href="listar.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-list"></i> Ver Registro de Roles</a>
    </div>
    <form id="rolPagos"  action="../../controllers/RolController.php" method="POST" >
      <!-- Datos personales -->
      <div class="mb-4">
        <div>
          <label>Empleado</label>
          <select class="form-select" name="empleadoInfo" id="empleadoInfo" required>
            <option value="">Seleccione un empleado</option>
            <?php foreach ($rol as $d): ?>
              <option value="<?= $d['ci_empleado'] ?>">
                <?= htmlspecialchars($d['ci_empleado'] . ' - ' . $d['nombre'] . ' ' . $d['apellido']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <!-- Ingresos y Egresos en dos columnas -->
      <div class="row">
        <!-- Ingresos -->
        <div class="col-md-6">
          <h3 class="mb-3 border-bottom pb-2">Ingresos</h3>
          <div class="mb-3">
            <label for="meses" class="form-label">Mes</label>
            <select name="meses" class="form-select" required>
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
          <div class="mb-3">
            <label for="sueldo" class="form-label">Sueldo</label>
            <input type="number" step="0.01" class="form-control" id="sueldo" name="sueldo" placeholder="Ingrese su sueldo" required>
          </div>
          <div class="mb-3">
            <label for="hora25" class="form-label">Hora 25%</label>
            <input type="number" class="form-control" id="hora25" name="hora25" placeholder="Valor hora 25%" value="0">
          </div>
          <div class="mb-3">
            <label for="hora50" class="form-label">Hora 50%</label>
            <input type="number" class="form-control" id="hora50" name="hora50" placeholder="Valor hora 50%" value="0">
          </div>
          <div class="mb-3">
            <label for="hora100" class="form-label">Hora 100%</label>
            <input type="number" class="form-control" id="hora100" name="hora100" placeholder="Valor hora 100%" value="0">
          </div>
          <div class="mb-3">
            <label for="bonos" class="form-label">Bonos</label>
            <input type="number" class="form-control" id="bonos" name="bonos" placeholder="Valor bonos" value="0">
          </div>
          <!-- Campos ocultos para cálculos -->
          <input type="hidden" id="temp_total_25" name="total25">
          <input type="hidden" id="temp_total_50" name="total50">
          <input type="hidden" id="temp_total_100" name="total100">
          <input type="hidden" id="temp_total_ingresos" name="total_ingresos">
        </div>

        <!-- Egresos -->
        <div class="col-md-6">
          <h3 class="mb-3 border-bottom pb-2">Egresos</h3>
          <div class="mb-3">
            <label for="iess" class="form-label">IESS</label>
            <input type="number" class="form-control" id="iess" name="iesst" readonly placeholder="No se ingresa ningún valor">
          </div>
          <div class="mb-3">
            <label for="multas" class="form-label">Multas</label>
            <input type="number" class="form-control" id="multas" name="multas" placeholder="Valor de multas">
          </div>
          <div class="mb-3">
            <label for="atrasos" class="form-label">Atrasos</label>
            <input type="number" class="form-control" id="atrasos" name="atrasos" placeholder="Valor de atrasos">
          </div>
          <div class="mb-3">
            <label for="alimentacion" class="form-label">Alimentación</label>
            <input type="number" class="form-control" id="alimentacion" name="alimentacion" placeholder="Valor de alimentación">
          </div>
          <div class="mb-3">
            <label for="anticipo" class="form-label">Anticipo</label>
            <input type="number" class="form-control" id="anticipo" name="anticipo" placeholder="Valor de anticipo">
          </div>
          <div class="mb-3">
            <label for="otros" class="form-label">Otros</label>
            <input type="number" class="form-control" id="otros" name="otros" placeholder="Otros egresos">
          </div>
          <!-- Campos ocultos para cálculos -->
          <input type="hidden" class="form-control" id="totalEgresos" name="totalEgres" readonly>
        </div>
      </div>

      <!-- Total a pagar -->
      <div class="mb-4 mt-4">
        <label for="totalPagar" class="form-label">Total a Pagar</label>
        <input type="hidden" class="form-control" id="total_a_pagar" name="totalPagar" readonly>
      </div>


      <!-- Campo oculto para identificar si es creación, edición -->
      <input type="hidden" name="accion" value="<?= isset($_GET['id']) ? 'editar' : 'crear' ?>">
      <!-- Campo oculto para el ID del rol -->
      <?php if (isset($_GET['id'])) : ?>
        <input type="hidden" name="id_rol" value="<?= htmlspecialchars($_GET['id']) ?>">
      <?php endif; ?>


      <!-- Botones -->
      <div class="text-center">
        <button type="submit" class="btn btn-success me-2">Calcular</button>
        <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
      </div>
    </form>
  </div>

  <script src="js/main.js"></script>
</body>

</html>