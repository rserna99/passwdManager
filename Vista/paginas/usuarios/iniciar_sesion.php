<h2>Iniciar sesión</h2>
<hr style="width: 98%;"><br>

<form method="post">
    <div class="row">
        <label class="col-sm-4" for="email">Correo electrónico: </label>
        <input class="col-sm-8" type="email" name="email" id="email">
    </div>
    <br>
    <div class="row">
        <label class="col-sm-4" for="contrasena">Contraseña: </label>
        <input class="col-sm-8" type="password" name="contrasena" id="contrasena">
    </div>
    <br>
    <div class="row">
        <input class="col-1" type="checkbox" name="recordar" id="recordar">
        <label class="col-4" for="recordar">Recordar usuario </label>
    </div>
    <br>

    <?php

    require "Controlador/usuarios.controlador.php";

    $inicioSesion = new ControladorUsuarios();
    $inicioSesion -> ctrIniciarSesion();
    ?>

    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit">Iniciar sesión</button>
    </div>
</form>