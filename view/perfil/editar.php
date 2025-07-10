<div class="card">
    <img class="card-img-top" src="holder.js/100x180/" alt="">
    <div class="card-body">
        <h4 class="card-title">Perfil de usuario</h4>
        <form method="POST" action="../../controllers/EditarController.php" enctype="multipart/form-data">
            <!-- foto de perfil -->
             <div class="mb-3">
                <img src="<?= htmlspecialchars($consultaUsuario['foto'] ?? 'default.jpg') ?>" alt="Foto de Perfil" class="img-thumbnail mb-3" style="max-width: 150px;">
             </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" readonly id="nombre" name="nombre" value="<?= htmlspecialchars($consultaUsuario['nombre'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" readonly id="apellido" name="apellido" value="<?= htmlspecialchars($consultaUsuario['apellido'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
    </div>
</div>