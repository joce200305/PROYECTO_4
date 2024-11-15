<?php
if (!isset($_SESSION['usuario'])) {
    echo "No hay sesión activa.";
    exit;
}
$datos_usuario = $_SESSION['usuario'];
    
include 'navegacion.php';
?>

<link rel="stylesheet" href="<?=CSS.'editar.css'?>">
<link rel="stylesheet" href="<?=CSS.'nar.css'?>">


<div class="fondo">
    <h3>Editar Usuario</h3>

    <form id="form_editar_usuario">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($datos_usuario['nombre']) ?>" placeholder="">
            <label for="nombre">Nombre</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($datos_usuario['apellido']) ?>" placeholder="">
            <label for="apellido">Apellido</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="usuario" name="usuario" value="<?= htmlspecialchars($datos_usuario['usuario']) ?>" placeholder="">
            <label for="usuario">Correo Electrónico</label>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./public/js/editar-usuario.js"></script>