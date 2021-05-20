<?php

require "Controlador/usuarios.controlador.php";

$controladorUsuarios = new ControladorUsuarios();
$usuarios = $controladorUsuarios::ctrListarUsuarios();


$numeroUsuarios = count($usuarios);

$usuariosPorPagina = (isset($_POST["usuariosPorPagina"])) ?
    $_POST["contrasenasPorPagina"] :
    8;
$numeroPaginas = ceil($numeroUsuarios / $usuariosPorPagina);

$paginaNumero = (isset($_GET["pagina-numero"])) ?
    $_GET["pagina-numero"] :
    1;

$usuariosPaginados = $controladorUsuarios::ctrListarUsuariosPaginados($usuariosPorPagina, $paginaNumero);



?>


<h2><i class="fas fa-user-cog"></i> Administrar usuarios</h2>
<hr style="width: 98%;"><br>
<br>

<div class="col-10">
    <a class="btn btn-primary" title="Añadir usuario" href="registro"><i class="fas fa-user-plus"></i> Añadir usuario </a>
</div>
<br>
<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th scope="col">Token</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">Fecha registro</th>
        <th scope="col">Fecha modificacion</th>
        <th scope="col">Acciones </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($usuariosPaginados as $key => $usuario): ?>
    <tr>
        <td><?php echo $usuario["token"]; ?></td>
        <td><?php echo $usuario["nombre"]; ?></td>
        <td><?php echo $usuario["email"]; ?></td>
        <td><?php echo $usuario["fecha_registro"]; ?></td>
        <td><?php echo $usuario["fecha_modificacion"]; ?></td>
        <td>
            <div class="btn-group">
                <div class="px-1">
                    <a title="Editar usuario" href="index.php?pagina=editar-usuario&token=<?php echo $usuario["token"]; ?>" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
                </div>
                <form method="post">
                    <input type="hidden" value="<?php echo $usuario["token"]; ?>" name="borrarUsuarioId">
                    <button title="Borrar usuario" type="submit" class="btn btn-danger"><i class="fas fa-user-minus"></i></i></button>

                    <?php
                    $eliminar = $controladorUsuarios::ctrBorrarUsuario();

                    ?>
                </form>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
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




    $urlPagina = "index.php?pagina=administrar-usuarios&pagina-numero=";
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