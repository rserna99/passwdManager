<h2><i class="fas fa-user-plus"></i> Crear grupo</h2>
<hr style="width: 98%;"><br>

<form method="post" class="was-validated">

    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_nombre"><i class="fas fa-user"></i></span>
        </div>
        <input type="text" placeholder="Introducir nombre" class="form-control" aria-describedby="icono_nombre" name="nombre" id="nombre" required>
    </div>
    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_email"><i class="fas fa-at"></i></span>
        </div>
        <input type="text" placeholder="Introducir descripcion" class="form-control" aria-describedby="icono_email" name="descripcion" id="descripcion" required>
    </div>

    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit" id="btnEnvio">Registrar usuario</button>
    </div>
</form>
<br>



<?php

require "Controlador/grupos.controlador.php";


$registro = ControladorGrupos::ctrCrearGrupo();

if ($registro == "ok"){
    echo "<script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>";
    echo '<div class="alert alert-success" role="alert">Grupo creado</div>';

    echo '<script>
            setTimeout(function() {
              window.location = "administrar-grupos";
            },800);
          </script>';
}
else if (str_contains($registro, "error")) {
    echo '<div class="alert alert-danger" role="alert">' . str_replace("error:", "", $registro) .'</div>';
}
else{
    print_r($registro);
}

