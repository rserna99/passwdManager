<?php

require "Controlador/contrasenas.controlador.php";
require "Controlador/usuarios.controlador.php";

ControladorUsuarios::ctrUsuarioIniciado();

$servicios = ControladorUsuarios::ctrObtenerServicios();

//$contrasenas = ControladorContrasenas::ctrListarContrasenas(null);

$actualizar = ControladorContrasenas::ctrModificarContrasena();


if (isset($_GET["servicio"]))
{
    if ($_GET["servicio"] == "todos")
    {
        $contrasenas = ControladorContrasenas::ctrListarContrasenas(null);
    }
    else{
        $contrasenas = ControladorContrasenas::ctrListarContrasenasServicio($_GET["servicio"]);
    }
}
else {

    $contrasenas = ControladorContrasenas::ctrListarContrasenas(null);
}

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

    function filtrarServicio(){

        var servicio =document.getElementById("filtrar-servicio").value;

        window.location = "index.php?pagina=contrasenas&servicio=" + servicio;

    }

    function paginarNumeroContrasenas() {
        var numeroContrasenas =document.getElementById("num-contrasenas").value;

        alert("Numero de contraseñas por pagina: " + numeroContrasenas);


    }


</script>

<h2>Listado de contraseñas</h2>
<hr style="width: 98%">
<br>


<div class="row">
    <div class="col-4">
        <a class="btn btn-primary" title="Añadir contraseña" href="nueva-contrasena"><i class="fas fa-plus"></i> Añadir contraseña</a>
    </div>

    <div class="col-4 offset-4">

        <div class="row">
            <div class="px-2">
                <label for="num-contrasenas">Mostrar:</label>
                <select onchange="paginarNumeroContrasenas()" name="num-contrasenas" id="num-contrasenas">
                    <option value="4">4</option>
                    <option value="8" selected>8</option>
                    <option value="16">16</option>
                    <option value="todas">Todas</option>
                </select>
            </div>

            <div class="px-2">
                <label for="filtrar-servicio">Servicio</label>
                <select onchange="filtrarServicio()" onselect="filtrarServicio()" name="servicio" id="filtrar-servicio">
                    <option value="todos">Todos</option>
                    <?php foreach ($servicios as $key => $value):?>
                        <option value="<?php echo $value["servicio"]; ?>"
                            <?php
                            if (isset($_GET["servicio"]) && $_GET["servicio"] == $value["servicio"]) {
                                echo "selected";
                            }
                            ?>
                        ><?php echo $value["servicio"]; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
</div>

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
                <td>
                    <?php echo $value["servicio"]; ?>
                </td>
                <td>
                    <?php echo $value["url"]; ?>
                    <a href="<?php echo $value["url"]; ?>" target="_blank"><i class="fas fa-link"></i></a>
                </td>
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
<nav aria-label="Seleccionar pagina">
    <ul class="pagination justify-content-end">
        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>

        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>

        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
    </ul>
</nav>
<br>