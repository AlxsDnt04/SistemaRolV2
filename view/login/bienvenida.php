<?php
// Asegúrate de que la sesión esté iniciada en dashboard2.php
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h2 class="mb-3"><i class="fa-solid fa-house-chimney"></i> ¡Bienvenido/a, <span class="text-primary"><?= htmlspecialchars($usuario) ?></span>!</h2>
                    <p class="lead mb-4">
                        Has iniciado sesión como <strong><?= htmlspecialchars($rol) ?></strong>.<br>
                        Desde este panel puedes gestionar departamentos, empleados, roles de pago y documentos.
                    </p>
                    <hr>
                    <div class="row justify-content-center">
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
                    <p class="text-muted mt-4">
                        Si tienes dudas, contacta al administrador del sistema.<br>
                        ¡Que tengas un excelente día!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>