<?php

require_once "Controlador/usuarios.controlador.php";
require_once "Controlador/grupos.controlador.php";
require_once "Controlador/contrasena-compartida.controlador.php";

$usuarios = ControladorUsuarios::ctrListarUsuarios();
$grupos = ControladorGrupos::ctrListarGrupos(null);


$target =(isset($_POST["tipo"]))? $_POST["tipo"] : null;
$tokens = Array();
$tokenContrasena = $_GET["id"];

foreach ($_POST as $key=>$dato){
    if ($key != "tipo")
        array_push($tokens, $dato);
}

// Compartir contrasenas
if ($target != null && $target == "usuarios"){
    ControladorContrasenaCompartida::ctrCompartirContrasena($tokenContrasena, $tokens, null);
}
elseif ($target != null && $target == "grupos") {
    ControladorContrasenaCompartida::ctrCompartirContrasena($tokenContrasena, null, $tokens);
}

?>

<h2 ><i class="fas fa-share-alt"></i> Compartir contraseña</h2>
<br>
<div class="row">
    <div class="col-md-6">
        <h3>Usuarios</h3>
        <form method="post">
            <input type="hidden" name="tipo" value="usuarios">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-center">Usuario</th>
                <th class="text-center">Compartir</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($usuarios as $key=>$usuario) : ?>
            <tr>
                <td><?php echo $usuario["nombre"]; ?></td>
                <td><input name="compartir-usuario-<?php echo $key; ?>" value="<?php echo $usuario["token"]; ?>" type="checkbox"></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            <br>
            <button class="btn btn-info  col-sm-3 offset-sm-4" type="submit">Actualizar</button>
        </form>
    </div>
    <div class="col-md-6">
        <h3>Grupos</h3>
        <form method="post">
            <input type="hidden" name="tipo" value="grupos">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Grupo</th>
                    <th class="text-center">Compartir</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($grupos as $key=>$grupo) : ?>
                    <tr>
                        <td><?php echo $grupo["nombre"]; ?></td>
                        <td><input name="compartir-grupo-<?php echo $key; ?>" value="<?php echo $grupo["token"]; ?>" type="checkbox"></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <button class="btn btn-info col-sm-3 offset-sm-4" type="submit">Actualizar</button>
        </form>
    </div>
</div>

<br>
<div class="row">
    <a class="btn btn-secondary col-sm-2 offset-sm-5" href="contrasenas">Volver</a>
</div>
<br>
