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

require "Controlador/contrasenas.controlador.php";


if (isset($_GET["id"])){
    $contrasena = ControladorContrasenas::ctrListarContrasenas($_GET["id"]);
}

?>

    <h2>Modificar contraseña</h2>
    <hr style="width: 98%">
    <br>
    <form method="post">
        <div class="row">
            <label class="col-sm-4" for="servicio">Servicio: </label>
            <input class="col-sm-8" type="text" value="<?php echo $contrasena[0]["servicio"]; ?>" name="servicio" id="servicio">
        </div>
        <br>
        <div class="row">
            <label class="col-sm-4" for="url">URL: </label>
            <input class="col-sm-8" type="text" value="<?php echo $contrasena[0]["url"]; ?>" name="url" id="url">
        </div>
        <br>
        <div class="row">
            <label class="col-sm-4" for="usuario">Usuario: </label>
            <input class="col-sm-8" type="text" value="<?php echo $contrasena[0]["usuario"]; ?>" name="usuario" id="usuario">
        </div>
        <br>
        <div class="row">
            <label class="col-sm-4" for="contrasena">Contraseña: </label>
            <input class="col-sm-8" type="password" value="<?php echo $contrasena[0]["contrasena"]; ?>" name="contrasena" id="contrasena">
        </div>
        <br>
        <div class="row">
            <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Actualizar contraseña</button>
        </div>
    </form>
    <br>
