<h2>Registrar usuario</h2>
<hr style="width: 98%;"><br>

<form method="post">

    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_nombre"><i class="fas fa-user"></i></span>
        </div>
        <input type="text" placeholder="Introducir nombre" class="form-control" aria-describedby="icono_nombre" name="nombreRegistro" id="nombre" required>
    </div>
    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_email"><i class="fas fa-at"></i></span>
        </div>
        <input type="email" placeholder="Introducir email" class="form-control" aria-describedby="icono_email" name="emailRegistro" id="email" required>
    </div>
    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_contrasena"><i class="fas fa-key"></i></span>
        </div>
        <input type="password" placeholder="Introducir contraseña" class="form-control" aria-describedby="icono_contrasena" name="contrasenaRegistro" id="contrasena" required>
    </div>

    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Enviar</button>
    </div>
</form>
<br>



<?php

require "Controlador/usuarios.controlador.php";


$registro = ControladorUsuarios::ctrRegistrarUsuario();

if ($registro == "ok"){
    echo "<script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>";
    echo '<div class="alert alert-success" role="alert">Usuario registrado</div>';

    echo '<script>
            setTimeout(function() {
              window.location = "iniciar-sesion";
            },800);
          </script>';
}
else if (str_contains($registro, "error")) {
    echo '<div class="alert alert-danger" role="alert">' . str_replace("error:", "", $registro) .'</div>';
}

