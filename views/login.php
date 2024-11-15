<?php
    if(isset($_SESSION['usuario'])){
        header("location:inicio");
        exit();
    }
    include 'navegacion.php';

?>

<link rel="stylesheet" href="<?=CSS.'login.css'?>">
<link rel="stylesheet" href="<?=CSS.'nar.css'?>">


<form id="frm_login" class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-4 fondo">
            <div class="py-4">
                <h3 class="text-center">Login</h3>
                <img src="<?=IMG."logo.png"?>" class="mx-auto d-block rounded-circle" width="40%" alt="Login">
                <div class="form-floating mb-3">
                    <input class="form-control" id="usuario" name="usuario" type="text"
                        placeholder="<i class='fa-solid fa-envelope me-2'></i>e-mail">
                    <label class="text-primary" for="usuario"><i class="fa-solid fa-envelope me-2"></i>e-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input id="password" name="password" type="password" class="form-control"
                        placeholder="<i class='fa-solid fa-lock me-2'></i>Password">
                    <label class="text-primary" for="password"><i class="fa-solid fa-lock me-2"></i>Password</label>
                </div>
                <button class="btn btn-primary w-100 mb-3" type="button" id="btn_iniciar"><i
                        class="fa-solid fa-door-open me-2"></i>Iniciar sesion</button>
                <a href="registro" class="btn btn-danger w-100 mb-3"><i
                        class="fa-solid fa-chalkboard-user me-2"></i>Registro</a>
            </div>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./public/js/logeo.js"></script>