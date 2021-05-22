<?php

require "Controlador/contrasenas.controlador.php";
require "Controlador/usuarios.controlador.php";

ControladorUsuarios::ctrValidarUsuarioIniciado();

$servicios = ControladorUsuarios::ctrObtenerServicios();
$actualizar = ControladorContrasenas::ctrModificarContrasena();


$contrasenas = (isset($_GET["servicio"]) && $_GET["servicio"] != "todos") ?
    ControladorContrasenas::ctrListarContrasenasServicio($_GET["servicio"]) :
    ControladorContrasenas::ctrListarContrasenas(null);

$contrasenasPorPagina = (isset($_POST["contrasenasPorPagina"])) ?
    $_POST["contrasenasPorPagina"] :
    8;


$numeroContrasenas = count($contrasenas);
$numeroPaginas = ceil($numeroContrasenas / $contrasenasPorPagina);


$paginaNumero = (isset($_GET["pagina-numero"])) ?
    $_GET["pagina-numero"] :
    1;

$servicio = (isset($_GET["servicio"])) ?
    $_GET["servicio"]:
    "todos";

$contrasenasPaginadas = ControladorContrasenas::ctrListarContrasenasPaginadas($contrasenasPorPagina, $paginaNumero, $servicio);

?>



<h2><i class="fas fa-key"></i> Listado de contraseñas</h2>
<hr style="width: 98%">
<br>


<div class="row">
    <div class="col-10">
        <a class="btn btn-primary" title="Añadir contraseña" href="nueva-contrasena"><i class="fas fa-plus"></i> Añadir contraseña</a>
    </div>

    <div class="col align-self-end">

        <div class="row">
            <div class="px-2">
                <label class="" for="filtrar-servicio">Servicio</label>
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
<div>
    <table class="table table-responsive w-100 d-block d-md-table table-striped">
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

        <?php foreach ($contrasenasPaginadas as $key => $value):?>
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
                        <div class="px-1">
                            <a title="Compartir contraseña" href="index.php?pagina=compartir-contrasena&id=<?php echo $value["token"]?>" class="btn btn-primary"><i class="fas fa-share-alt"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

<?php

if ($numeroPaginas > 1){
    echo '<nav aria-label="Seleccionar pagina" >';
    echo '<ul class="pagination pagination-sm justify-content-end">';


    if (isset($_GET["pagina-numero"]))
    {
        $numeroPaginaSiguiente = ($_GET["pagina-numero"] === 1) ?
            2:
            $_GET["pagina-numero"]+1;

        $numeroPaginaAnterior = ($_GET["pagina-numero"] ===  $numeroPaginas) ?
            $_GET["pagina-numero"]:
            $_GET["pagina-numero"]-1;
    }
    else {
        $numeroPaginaAnterior = 1;
        $numeroPaginaSiguiente = 2;
    }

    $urlParteServicio = (isset($_GET["servicio"])) ?
        '&servicio=' . $_GET["servicio"] :
        '';


    $urlPagina = "index.php?pagina=contrasenas" . $urlParteServicio . '&pagina-numero=';
    $urlPaginaAnterior = $urlPagina . $numeroPaginaAnterior;
    $urlPaginaSiguiente = $urlPagina . $numeroPaginaSiguiente;

    $deshabilitarAnterior = ((isset($_GET["pagina-numero"]) && $_GET["pagina-numero"] == 1 ) || !isset($_GET["pagina-numero"])) ?
        'disabled' :
        '';
    $deshabilitarSiguiente = ((isset($_GET["pagina-numero"]) && $_GET["pagina-numero"] == $numeroPaginas ))?
        'disabled':
        '';


    echo '<li class="page-item ' . $deshabilitarAnterior .'"><a class="page-link" href="' . $urlPaginaAnterior . '">Anterior</a></li>';

    for ($i = 1; $i <= $numeroPaginas; $i++){
        $paginaActiva = ((isset($_GET["pagina-numero"]) && $_GET["pagina-numero"] == $i) || !isset($_GET["pagina-numero"]) && $i == 1) ? 'active': '';
        echo '<li class="page-item ' . $paginaActiva .'"><a class="page-link" href="' . $urlPagina . $i . '">' . $i . '</a></li>';
    }

    echo '<li class="page-item ' . $deshabilitarSiguiente .'"><a class="page-link" href="' . $urlPaginaSiguiente . '">Siguiente</a></li>';

    echo '</ul>';
    echo '</nav>';
}

?>

<br>