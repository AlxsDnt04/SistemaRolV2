<?php
require_once '../../models/Empleado.php';
$empleadoModel = new Empleado();

// Asegúrate de que la sesión esté iniciada en dashboard2.php
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';

$nombreCompleto= 'Administrador';

if ($usuario) {
    $consultaUsuario = $empleadoModel->obtenerPorId($usuario);
    if ($consultaUsuario && isset($consultaUsuario['nombre'], $consultaUsuario['apellido'])) {
        $nombreCompleto = $consultaUsuario['nombre'] . ' ' . $consultaUsuario['apellido'];
    }
}

?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <h2 class="mb-3"><i class="fa-solid fa-house-chimney"></i> Bienvenido/a, <span class="text-primary"><?= htmlspecialchars($nombreCompleto) ?></span></h2>
                    <p class="lead mb-4">
                        Has iniciado sesión como <strong><?= htmlspecialchars($rol) ?></strong>.<br>
                        Desde este panel puedes gestionar <?php if ($rol === 'empleado') { echo 'tus documentos y consultar tu información personal.'; } else { echo 'los departamentos, empleados, roles de pago y documentos del sistema.'; } ?>
                    </p>
                    <hr>
                    <div class="row justify-content-center">
                        <?php if ($rol !== 'empleado'): ?>
                        <div class="col-auto">
                            <a href="?contenido=departamento/listar.php" class="btn btn-outline-primary m-1">
                                <i class="fa-solid fa-building"></i> Departamentos
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="?contenido=empleado/listar.php" class="btn btn-outline-success m-1">
                                <i class="fa-solid fa-users"></i> Empleados
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="col-auto">
                            <a href="?contenido=rol/listar.php" class="btn btn-outline-warning m-1">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Roles de Pago
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="?contenido=documento/listar.php" class="btn btn-outline-info m-1">
                                <i class="fa-solid fa-file-lines"></i> Documentos
                            </a>
                        </div>
                    </div>
                    <hr>
                    <?php if ($rol === 'empleado'): ?>
                    <p class="text-muted mt-4">
                        Si tienes dudas, contacta al administrador del sistema.<br>
                        ¡Que tengas un excelente día!
                    </p>
                    <?php else: ?>
                    <p class="text-muted mt-4">
                        Si tienes dudas, contacta a tu supervisor o al departamento de recursos humanos.<br>
                        ¡Que tengas un excelente día!
                    </p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>