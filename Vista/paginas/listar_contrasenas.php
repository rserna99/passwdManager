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

$contrasenas = ControladorContrasenas::ctrListarContrasenas($_SESSION["idUsuario"]);

$actualizar = ControladorContrasenas::ctrModificarContrasena();

?>

<h2>Listado de contraseñas</h2>
<hr style="width: 98%">
<br>

<a class="btn btn-primary" href="index.php?pagina=nueva_contrasena">Crear nueva contraseña</a>
<br>
<br>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Servicio</th>
        <th>URL</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($contrasenas as $key => $value):?>
        <tr>
            <td><?php echo $value["servicio"]; ?></td>
            <td><?php echo $value["url"]; ?></td>
            <td>
                <?php echo $value["usuario"]; ?>
                <button class="btn btn-primary btn-sm"><i class="fas fa-clipboard"></i></button>
            </td>
            <td>
                <?php echo $value["contrasena"]; ?>
                <button class="btn btn-primary btn-sm"><i class="fas fa-clipboard"></i></button>
            </td>
            <td>
                <div class="btn-group">
                    <a href="index.php?pagina=editar_contrasena&id=<?php echo $value["id"]?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="index.php?pagina=borrar_contrasena&id=<?php echo $value["id"]?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach ?>

    </tbody>
</table>