<?php

require "Controlador/usuarios.controlador.php";
ControladorUsuarios::ctrUsuarioIniciado();

require "Controlador/contrasenas.controlador.php";

$contrasenas = ControladorContrasenas::ctrListarContrasenas(null);

$actualizar = ControladorContrasenas::ctrModificarContrasena();

?>

<h2>Listado de contraseñas</h2>
<hr style="width: 98%">
<br>

<a class="btn btn-primary" href="index.php?pagina=nueva_contrasena">Crear nueva contraseña</a>
<br>
<br>
<div class="table-responsive">
    <table class="table table-striped ">
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

                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-primary btn-sm"><i class="fas fa-clipboard"></i></button>
                        </div>
                    </div>


                </td>
                <td>
                    <div class="btn-group">
                        <div class="px-1">
                            <a href="index.php?pagina=editar_contrasena&id=<?php echo $value["token"]?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        </div>
                        <form method="post">
                            <input type="hidden" value="<?php echo $value["token"]?>" name="borrarContrasenaId">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

                            <?php
                            $eliminar = ControladorContrasenas::ctrBorrarContrasena();

                            ?>

                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>