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

?>

<h2>Listado de contraseñas</h2>
<hr style="width: 98%">
<br>

<a href="index.php?pagina=nueva_contrasena"><button class="btn btn-primary">Crear nueva contraseña</button></a>
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
    <tr>
        <td>gmail</td>
        <td>https://mail.google.com/</td>
        <td>
            pepe@gmail.com
            <button class="btn btn-primary btn-sm"><i class="fas fa-clipboard"></i></button>
        </td>
        <td>
            123456
            <button class="btn btn-primary btn-sm"><i class="fas fa-clipboard"></i></button>
        </td>
        <td>
            <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    </tbody>
</table>