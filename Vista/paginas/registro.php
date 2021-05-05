<h2>Registrar usuario</h2>
<hr style="width: 98%;"><br>

<form method="post">
    <div class="row">
        <label class="col-sm-4" for="nombre">Nombre: </label>
        <input class="col-sm-8" type="text" name="nombreRegistro" id="nombre" onblur="">
    </div>
    <br>
    <div class="row">
        <label class="col-sm-4" for="email">Correo electrónico: </label>
        <input class="col-sm-8" type="email" name="emailRegistro" id="email">
    </div>
    <br>
    <div class="row">
        <label class="col-sm-4" for="contrasena">Contraseña: </label>
        <input class="col-sm-8" type="password" name="contrasenaRegistro" id="contrasena">
    </div>
    <br>
    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5 disabled" type="submit" id="btnEnvio">Enviar</button>
    </div>
</form>
<br>



<?php

require "Controlador/usuarios.controlador.php";

$registro = ControladorUsuarios::ctrRegistrarUsuario();

if ($registro){
    echo "<script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>";
    echo '<div class="alert alert-success" role="alert">Usuario registrado</div>';
}


?>