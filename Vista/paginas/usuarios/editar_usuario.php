<?php

require "Controlador/usuarios.controlador.php";
ControladorUsuarios::ctrValidarUsuarioIniciado();

if (isset($_GET["token"])){

    $usuario = ControladorUsuarios::ctrObtenerUsuario($_GET["token"]);

}

?>

    <h2><i class="fas fa-user-edit"></i> Editar usuario</h2>
    <hr style="width: 98%;"><br>

    <form method="post">

        <div class="input-group input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="icono_nombre"><i class="fas fa-user"></i></span>
            </div>
            <input value="<?php echo $usuario["nombre"]; ?>" type="text" placeholder="Introducir nombre" class="form-control" aria-describedby="icono_nombre" name="nombre" id="nombre">
        </div>
        <div class="input-group input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="icono_email"><i class="fas fa-at"></i></span>
            </div>
            <input value="<?php echo $usuario["email"]; ?>" type="email" placeholder="Introducir email" class="form-control" aria-describedby="icono_email" name="email" id="email">
        </div>
        <div class="input-group input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="icono_contrasena"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" placeholder="Introducir contraseña" class="form-control" aria-describedby="icono_contrasena" name="contrasena" id="contrasena">
            <div class="input-group-append">
                <button type="button" title="Mostrar contraseña" onclick='mostrarContrasena()' class="btn btn-outline-secondary"><i id="mostrar_contrasena" class="fas fa-eye"></i></button>
            </div>
            <input type="hidden" value="<?php echo $usuario["token"]; ?>" name="token">
        </div>

        <div class="row">
            <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Enviar</button>
        </div>
    </form>
    <br>



<?php


$registro = ControladorUsuarios::ctrActualizarUsuario();

if ($registro){

    ControladorPlantilla::crtLimpiarDatosNavegador();

    echo '<div class="alert alert-success" role="alert">Usuario actualizado</div>';

    $location = ($registro == $_SESSION["tokenUsuario"])?
        "contrasenas" :
        "administrar-usuarios";

    ControladorPlantilla::ctrCambiarPagina($location, 800);


}
else if (str_contains($registro, "error")) {
    echo '<div class="alert alert-danger" role="alert">' . str_replace("error:", "", $registro) .'</div>';
}

?>

<br>
