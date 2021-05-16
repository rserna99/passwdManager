<?php

require "Controlador/usuarios.controlador.php";
ControladorUsuarios::ctrUsuarioIniciado();


require "Controlador/contrasenas.controlador.php";

if (isset($_GET["id"])){
    $contrasena = ControladorContrasenas::ctrListarContrasenas($_GET["id"]);
}

?>

    <h2><i class="fas fa-edit"></i> Modificar contraseña</h2>
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
        <input type="hidden" value="<?php echo $contrasena[0]["token"]; ?>" name="idContrasena">
        <br>
        <div class="row">
            <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Actualizar contraseña</button>
        </div>
    </form>
    <br>
<?php

$contrasenas = ControladorContrasenas::ctrListarContrasenas($_SESSION["idUsuario"]);

$actualizar = ControladorContrasenas::ctrModificarContrasena();

if ($actualizar){
    echo "<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                       </script>";

    echo '<div class="alert alert-success" role="alert">Contraseña actualizada correctamente</div>';

    echo '<script>
            setTimeout(function() {
              window.location = "contrasenas";
            },800);
          </script>';

}
