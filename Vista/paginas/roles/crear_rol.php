
<h2>Crear rol</h2>

<form  method="post">
    <div class="mb-3">
        <label class="form-label" for="nombre">Nombre: </label>
        <input class="form-control" type="text" name="nombre">
    </div>

    <div class="mb-3">
        <label class="form-label" for="descripcion">Descripcion: </label>
        <textarea class="form-control" name="descripcion" id="descripcion" rows="10"></textarea>
    </div>

    <button class="btn btn-primary" type="submit">Crear rol</button>
</form>
<br>

<?php

require "Controlador/roles.controlador.php";

$registro = ControladorRoles::ctrCrearRol();

if ($registro == "ok"){

    ControladorPlantilla::crtLimpiarDatosNavegador();

    echo '<div class="alert alert-success" role="alert">Rol Creado</div>';

    ControladorPlantilla::ctrCambiarPagina("contrasenas", 800);

}
else if (str_contains($registro, "error")) {
    echo '<div class="alert alert-danger" role="alert">' . str_replace("error:", "", $registro) .'</div>';
}

