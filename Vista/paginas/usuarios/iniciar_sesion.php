<script>
    function mostrarContrasena() {

        var btnMostrar = document.getElementById("mostrar_contrasena");
        var contrasena  = document.getElementById("contrasena");


        if (contrasena.type === "password") {
            contrasena.type = "text";
            btnMostrar.setAttribute("class", "fas fa-eye-slash");
        }
        else {
            contrasena.type = "password";
            btnMostrar.setAttribute("class", "fas fa-eye");
        }
    }
</script>


<h2>Iniciar sesión</h2>
<hr style="width: 98%;"><br>

<form method="post" class="was-validated">

    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_email"><i class="fas fa-at"></i></span>
        </div>
        <input type="email" placeholder="Introducir email" class="form-control" aria-describedby="icono_email" name="email" id="email" required>
    </div>
    <div class="input-group input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="icono_contrasena"><i class="fas fa-key"></i></i></span>
        </div>
        <input type="password" placeholder="Introducir contraseña" class="form-control" aria-describedby="icono_contrasena" name="contrasena" id="contrasena" required>
        <div class="input-group-append">
            <button type="button" title="Mostrar contraseña" onclick='mostrarContrasena()' class="btn btn-outline-secondary"><i id="mostrar_contrasena" class="fas fa-eye"></i></button>
        </div>
    </div>

    <br>

    <?php

    require "Controlador/usuarios.controlador.php";

    $inicioSesion = new ControladorUsuarios();
    $inicioSesion -> ctrIniciarSesion();
    ?>

    <div class="row">
        <button class="btn btn-primary col-sm-2 offset-sm-5" type="submit">Iniciar sesión</button>
    </div>
    <br>
</form>