<?php

require "Controlador/usuarios.controlador.php";

$controladorUsuarios = new ControladorUsuarios();
$usuarios = $controladorUsuarios::ctrListarUsuarios();

//print_r($usuarios);
$numeroUsuarios = count($usuarios);

//echo "<pre>Hay " . $numeroUsuarios . " usuarios</pre>"

?>


<h2>Administrar usuarios</h2>
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
    <?php foreach ($usuarios as $key => $usuario): ?>
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
