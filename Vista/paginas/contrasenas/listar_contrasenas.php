<?php

require "Controlador/usuarios.controlador.php";
ControladorUsuarios::ctrUsuarioIniciado();

require "Controlador/contrasenas.controlador.php";

$contrasenas = ControladorContrasenas::ctrListarContrasenas(null);

$actualizar = ControladorContrasenas::ctrModificarContrasena();

?>

<script>
    function mostrarContrasena($token) {

        var btnMostrar = document.getElementById("mostrar_contrasena-" + $token);
        var contrasena  = document.getElementById("contrasena-" + $token);


        if (contrasena.type === "password") {
            contrasena.type = "text";
            btnMostrar.setAttribute("class", "fas fa-eye-slash");
        }
        else {
            contrasena.type = "password";
            btnMostrar.setAttribute("class", "fas fa-eye");
        }
    }

    function copiarContrasena(token) {

        var inputContrasena  = document.getElementById("contrasena-" + token);

        copiarPortapapeles(inputContrasena.value);

        alert("Contraseña copiada al portapapeles");
    }

    function copiarUsuario(token) {

        var inputUsuario  = document.getElementById("usuario-" + token);

        copiarPortapapeles(inputUsuario.value);

        alert("Usuario copiado al portapapeles");

    }

    function copiarPortapapeles(string) {
        const temp = document.createElement('textarea');
        temp.value = string;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
    }


</script>

<h2>Listado de contraseñas</h2>
<hr style="width: 98%">
<br>

<a class="btn btn-primary" title="Añadir contraseña" href="nueva-contrasena"><i class="fas fa-plus"></i></a>
<br>
<br>
<div class="table-responsive">
    <table class="table table-striped ">
        <thead>
        <tr>
            <th class="text-center">Servicio</th>
            <th class="text-center">URL</th>
            <th class="text-center">Usuario</th>
            <th class="text-center">Contraseña</th>
            <th class="text-center">Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($contrasenas as $key => $value):?>
            <tr>
                <td><?php echo $value["servicio"]; ?></td>
                <td><?php echo $value["url"]; ?></td>
                <td>
                    <div class="input-group">
                        <input type="text" disabled value="<?php echo $value["usuario"]; ?>" class="form-control" id="usuario-<?php echo $value["token"]?>">
                        <div class="input-group-append">
                            <div class="px-1">
                                <button title="Copiar al portapapeles" onclick='copiarUsuario(<?php echo '"' . $value["token"] . '"'; ?>)' id="copiar_usuario-<?php echo $value["token"]; ?>" class="btn btn-outline-primary"><i class="fas fa-clipboard"></i></button>
                            </div>
                        </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="password" disabled value="<?php echo $value["contrasena"]; ?>" class="form-control" id="contrasena-<?php echo $value["token"]?>">
                        <div class="input-group-append">
                            <div class="px-1">
                                <button title="Mostrar contraseña" onclick='mostrarContrasena(<?php echo '"' . $value["token"] . '"'; ?>)' class="btn btn-outline-secondary"><i id="mostrar_contrasena-<?php echo $value["token"]; ?>" class="fas fa-eye"></i></button>
                            </div>
                            <div class="px-1">
                                <button title="Copiar al portapapeles" onclick='copiarContrasena(<?php echo '"' . $value["token"] . '"'; ?>)' id="copiar_contrasena-<?php echo $value["token"]; ?>" class="btn btn-outline-primary"><i class="fas fa-clipboard"></i></button>
                            </div>
                        </div>
                </td>
                <td>
                    <div class="btn-group">
                        <div class="px-1">
                            <a title="Editar contraseña" href="index.php?pagina=editar-contrasena&id=<?php echo $value["token"]?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        </div>
                        <form method="post">
                            <input type="hidden" value="<?php echo $value["token"]?>" name="borrarContrasenaId">
                            <button title="Borrar contraseña" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

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