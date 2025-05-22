<?php
require_once '../../models/Rol.php';
// Instancia de la clase Rol en modelo
$rolModel = new Rol();
$rol = $rolModel->obtenerEmpleados();
// Array para almacenar los datos del formulario
$data=[
  'empleadoInfo' => '',
  'mes' => '',
  'bonos' => '',
  'sueldo' => '',
  'multas' => '',
  'atrasos' => '',
  'alimentacion' => '',
  'anticipo' => '',
  'otros' => '',
];

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cálculo de rol de pagos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../assets/css/containerIngresosEgresos.css">
  <link rel="stylesheet" href="../../assets/css/fuentes.css">
  <link rel="stylesheet" href="../../assets/css/insertar.css">

</head>

<body>

  <div class="container mt-5 p-4 shadow rounded bg-light">
    <div class="header">
      <h4 class="mb-0"><i class="fa-solid fa-money-bill-wave"></i> Ingresos y Egresos</h4>
      <a href="listar.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-list"></i> Ver Ingresos y Egresos</a>
    </div>
    <form id="rolPagos">

      <!-- Datos personales -->
      <div class="mb-4">
        <!-- <h3 class="mb-3 border-bottom pb-2">Datos Personales</h3>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su cédula" maxlength="10">
          </div>
          <div class="col-md-3 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre">
          </div>
          <div class="col-md-3 mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese su apellido">
          </div>
          <div class="col-md-3 mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su teléfono">
          </div>
        </div> -->
        <div>
          <label>Empleado</label>
          <select class="form-select" name="id_departamento" id="empleadoInfo" required>
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
            <label for="mes" class="form-label">Mes</label>
            <select name="mes" id="mes" class="form-select">
              <option value="" disabled selected>Seleccione un mes</option>
              <option value="1">Enero</option>
              <option value="2">Febrero</option>
              <option value="3">Marzo</option>
              <option value="4">Abril</option>
              <option value="5">Mayo</option>
              <option value="6">Junio</option>
              <option value="7">Julio</option>
              <option value="8">Agosto</option>
              <option value="9">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="sueldo" class="form-label">Sueldo</label>
            <input type="number" class="form-control" id="sueldo" name="sueldo" placeholder="Ingrese su sueldo">
          </div>
          <div class="mb-3">
            <label for="hora25" class="form-label">Hora 25%</label>
            <input type="number" class="form-control" id="hora25" name="hora25" placeholder="Valor hora 25%">
          </div>
          <div class="mb-3">
            <label for="hora50" class="form-label">Hora 50%</label>
            <input type="number" class="form-control" id="hora50" name="hora50" placeholder="Valor hora 50%">
          </div>
          <div class="mb-3">
            <label for="hora100" class="form-label">Hora 100%</label>
            <input type="number" class="form-control" id="hora100" name="hora100" placeholder="Valor hora 100%">
          </div>
          <div class="mb-3">
            <label for="bonos" class="form-label">Bonos</label>
            <input type="number" class="form-control" id="bonos" name="bonos" placeholder="Valor bonos">
          </div>
          <!-- Campos ocultos para cálculos -->
          <input type="hidden" id="temp_total_25">
          <input type="hidden" id="temp_total_50">
          <input type="hidden" id="temp_total_100">
          <input type="hidden" id="temp_total_ingresos">
        </div>

        <!-- Egresos -->
        <div class="col-md-6">
          <h3 class="mb-3 border-bottom pb-2">Egresos</h3>
          <div class="mb-3">
            <label for="iess" class="form-label">IESS</label>
            <input type="number" class="form-control" id="iess" name="iess" readonly>
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
          <input type="hidden" class="form-control" id="totalEgresos" name="totalEgresos" readonly>
        </div>
      </div>

      <!-- Total a pagar -->
      <div class="mb-4 mt-4">
        <label for="totalPagar" class="form-label">Total a Pagar</label>
        <input type="hidden" class="form-control" id="total_a_pagar" name="totalPagar" readonly>
      </div>

      <!-- Botones -->
      <div class="text-center">
        <button type="submit" class="btn btn-success me-2">Calcular</button>
        <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
      </div>
    </form>
  </div>

</body>

</html>