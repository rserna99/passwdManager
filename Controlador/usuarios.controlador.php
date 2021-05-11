<?php

require "Modelo/usuarios.modelo.php";
require "Controlador/seguridad.controlador.php";

class ControladorUsuarios{

    public static function ctrRegistrarUsuario(){

        if (!(isset($_POST["nombreRegistro"]) && $_POST["nombreRegistro"] != null)){
            return;
        }

        $validarNombre = ControladorSeguridad::ctrValidarNombreUsuario($_POST["nombreRegistro"]);
        $validarEmail = ControladorSeguridad::ctrValidarEmail($_POST["emailRegistro"]);
        $validarContrasena = ControladorSeguridad::ctrValidarContrasena($_POST["contrasenaRegistro"]);

        if ($validarNombre != "ok") {
            return $validarNombre;
        }
        if ($validarEmail != "ok") {
            return $validarEmail;
        }
        if ($validarContrasena != "ok") {
            return $validarContrasena;
        }

        $datos = array(
            "nombre" => $_POST["nombreRegistro"],
            "email" => $_POST["emailRegistro"],
            "contrasena" => $_POST["contrasenaRegistro"]
        );

        $respuesta = ModeloUsuarios::mdlRegistoUsuario($datos);

        return $respuesta;
    }

    public static function ctrListarUsuarios(){

        $resultado = ModeloUsuarios::mdlObtenerUsuarios(null);

        return $resultado;
    }

    public function ctrIniciarSesion()
    {
        if (isset($_POST["email"])){
            $mail = $_POST["email"];
            $contrasena = $_POST["contrasena"];
            $usuario = ModeloUsuarios::mdlObtenerUsuarios($mail);

            if (isset($usuario["email"])){
                if ($usuario["email"] == $mail && $usuario["contrasena"] == $contrasena){

                    $_SESSION["usuarioIniciado"] = "ok";
                    $_SESSION["idUsuario"] = $usuario["id"];
                    $_SESSION["tokenUsuario"] = $usuario["token"];

                    echo '
                      <script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        
                        window.location = "index.php?pagina=contrasenas";
                      </script>';
                }
                else {

                    if ($usuario["intentos_fallidos"] < 3){

                    }
                    // Actualizar numero de intentos fallidos
                    $fallos = $usuario["intentos_fallidos"]+1;
                    $actualizarFallos = ModeloUsuarios::mdlActualizarIntentosFallidos($fallos, $usuario["token"]);

                    if ($actualizarFallos){
                        echo "<div class=\"alert alert-danger text-center\">Intentos restantes: " . (3-$fallos) . " </div>";
                    }
                }
            }
            else {


                echo '
                      <script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                      </script>';

                echo "<div class=\"alert alert-danger text-center\">Usuario o contraseña incorrecto </div>";

            }
        }
    }

    // Funcion para validar si un usuario ha iniciado sesion y puede acceder a una paginaadmin
    public static function ctrUsuarioIniciado(){
        if (isset($_SESSION["usuarioIniciado"])) {
            if ($_SESSION["usuarioIniciado"] != "ok"){
                echo '<script>window.location = "index.php?pagina=iniciar_sesion";</script>';
            }
        }
        else{
            echo '<script>window.location = "index.php?pagina=iniciar_sesion";</script>';
        }
    }
}

