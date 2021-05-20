<?php

require "Controlador/usuarios.controlador.php";
require "Controlador/grupos.controlador.php";
require "Controlador/usuario-grupo.controlador.php";


$grupo = ControladorGrupos::ctrListarGrupos($_GET["token"]);

$usuarios = ControladorUsuarios::ctrListarUsuarios();

?>


<h2><i class="fas fa-pencil-alt"></i> Editar grupo</h2>
<hr style="width: 98%;"><br>

<form method="post" class="was-validated">

    <div class="row">
        <div class="col-12">
            <label for="nombre">Nombre: </label>
            <br>
            <input type="text" value="<?php echo $grupo["nombre"]; ?>" placeholder="Introducir nombre" class="form-control" aria-describedby="icono_nombre" name="nombre" id="nombre" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <br>
            <label for="descripcion">Descripción: </label>
            <br>
            <textarea class="form-control" rows="8" name="descripcion" id="descripcion" required><?php echo $grupo["descripcion"]; ?></textarea>
        </div>
        <div class="col-lg-6 col-sm-12">
            <br>
            <h4>Gestionar usuarios</h4>
            <table class="table w-100 table-striped">
                <thead>
                <th>Nombre</th>
                <th>Miembro</th>
                <th>Administrador</th>
                <th>Acciones</th>
                </thead>
                <tbody>
                <?php foreach ($usuarios as $key => $usuario): ?>

                <?php

                $rolUsuario = UsuarioGrupoControlador::ctrObtenerRolGrupo($grupo["token"], $usuario["token"]);
                $admin = ModeloRoles::mdlObtenerRoles(2);
                $miembro = ModeloRoles::mdlObtenerRoles(3);

                ?>


                <tr>
                    <td><?php echo $usuario["nombre"]; ?></td>
                    <form method="post">
                        <input type="hidden" name="token_usuario" value="<?php echo $usuario["token"]; ?>">
                        <input type="hidden" name="token_grupo" value="<?php echo $grupo["token"]; ?>">
                        <td>
                            <input type="checkbox" name="miembro"
                                <?php echo ((isset($rolUsuario["token_rol"]) && isset($miembro)) && isset($rolUsuario) && $rolUsuario["token_rol"] == $miembro["token"])? "checked" : ""; ?>>
                        </td>
                        <td>
                            <input type="checkbox" name="admin" <?php echo ((isset($rolUsuario["token_rol"]) && isset($admin))
                                && $rolUsuario["token_rol"] == $admin["token"])?
                                "checked" :
                                ""; ?>>
                        </td>
                        <td>
                            <button class="btn btn-primary">Actualizar</button>
                        </td>
                    </form>

                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Editar grupo</button>
    </div>
</form>
<br>



<?php


UsuarioGrupoControlador::actializarUsuarioGrupo();

$registro = ControladorGrupos::ctrActualizarGrupo();

if ($registro){

    echo '<div class="alert alert-success" role="alert">Grupo actualizado</div>';

    ControladorPlantilla::ctrCambiarPagina("administrar-grupos", 800);

}
else if (str_contains($registro, "error")) {
    echo '<div class="alert alert-danger" role="alert">' . str_replace("error:", "", $registro) .'</div>';
}

ControladorPlantilla::crtLimpiarDatosNavegador();

?>
<br>
