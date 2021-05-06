<?php

if (isset($_SESSION["usuarioIniciado"])) {
    if ($_SESSION["usuarioIniciado"] != "ok"){
        echo '<script>window.location = "index.php?pagina=iniciar_sesion";</script>';
        return;
    }
}
else{
    echo '<script>window.location = "index.php?pagina=iniciar_sesion";</script>';
    return;
}

?>

<h2>Crear contraseñas</h2>
<hr style="width: 98%">
<br>
<form method="post">
    <div class="row">
        <label class="col-sm-4" for="nombre">Servicio: </label>
        <input class="col-sm-8" type="text" name="servicio" id="servicio">
    </div>
    <br>
    <div class="row">
        <label class="col-sm-4" for="email">URL: </label>
        <input class="col-sm-8" type="text" name="url" id="url">
    </div>
    <br>
    <div class="row">
        <label class="col-sm-4" for="contrasena">Usuario: </label>
        <input class="col-sm-8" type="text" name="usuario" id="usuario">
    </div>
    <br>
    <div class="row">
        <label class="col-sm-4" for="contrasena">Contraseña: </label>
        <input class="col-sm-8" type="password" name="contrasena" id="contrasena">
    </div>
    <br>
    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Guardar contraseña</button>
    </div>
</form>


<?php

require "Controlador/contrasenas.controlador.php";

$registro = ControladorContrasenas::ctrCrearContrasena();

print_r($registro);

if ($registro){
    echo "<script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>";
    echo '<div class="alert alert-success" role="alert">Contraseña almacenada</div>';
}
else{
    echo '<div class="alert alert-danger" role="alert">
            <p>No se ha guardado la contraseña</p>
            <p>print_r($registro)</p>
          </div>';
}


?>