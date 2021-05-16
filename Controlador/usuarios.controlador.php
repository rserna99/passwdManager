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

        $contrasenaEncriptada = crypt($_POST["contrasenaRegistro"], '$2a$07$ghfFdsOgfmdrQxdrtkLxp$');

        $datos = array(
            "nombre" => $_POST["nombreRegistro"],
            "email" => $_POST["emailRegistro"],
            "contrasena" => $contrasenaEncriptada
        );

        $respuesta = ModeloUsuarios::mdlRegistoUsuario($datos);

        return $respuesta;
    }

    public static function ctrActualizarUsuario(){

        if (!(isset($_POST["nombre"]) && $_POST["nombre"] != null) || !(isset($_POST["email"]) && $_POST["email"] != null)){
            return;
        }
        $datos = null;

        $token = (isset($_POST["token"]))?
            $_POST["token"]:
            $_SESSION["tokenUsuario"];

        if (isset($_POST["contrasena"]) && $_POST["contrasena"] != "")
        {
            $contrasenaEncriptada = crypt($_POST["contrasena"], '$2a$07$ghfFdsOgfmdrQxdrtkLxp$');

            $datos = array(
                "nombre" => $_POST["nombre"],
                "email" => $_POST["email"],
                "token" => $token,
                "contrasena" => $contrasenaEncriptada
            );
        }
        else {
            $datos = array(
                "nombre" => $_POST["nombre"],
                "email" => $_POST["email"],
                "token" => $token
            );
        }

        ModeloUsuarios::mdlActualizarUsuario($datos);

        return $token;

    }

    public static function ctrListarUsuarios(){

        $resultado = ModeloUsuarios::mdlObtenerUsuarios(null);

        return $resultado;
    }

    public static function ctrObtenerUsuario($token){

        $resultado = ModeloUsuarios::mdlObtenerUsuarioToken($token);

        return $resultado;
    }

    public static function ctrObtenerServicios()
    {
        $resultado = ModeloUsuarios::mdlObtenerServicios();

        return $resultado;
    }

    public static function ctrBorrarUsuario()
    {
        if (isset($_POST["borrarUsuarioId"])) {

            $respuesta = ModeloUsuarios::mdlBorrarUsuarios($_POST["borrarUsuarioId"]);

            if ($respuesta){
                echo "<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                       </script>";

                echo '<script>window.location = "administrar-usuarios";</script>';
            }
            return $respuesta;
        }
    }

    public static function ctrListarUsuariosPaginados($usuariosPorPagina, $pagina)
    {
        $registroInicio = 0;
        $numeroRegistros = $usuariosPorPagina;

        for ($i = 1; $i < $pagina; $i++){
            $registroInicio = $registroInicio + $usuariosPorPagina;

        }


        $respuesta = ModeloUsuarios::mdlObtenerUsuariosPaginados($registroInicio, $numeroRegistros);

        return $respuesta;
    }

    public function ctrIniciarSesion()
    {
        if (isset($_POST["email"])){
            $mail = $_POST["email"];
            $contrasena = $_POST["contrasena"];
            $usuario = ModeloUsuarios::mdlObtenerUsuarios($mail);

            if (isset($usuario["email"])){

                $contrasenaEncriptada = crypt($contrasena, '$2a$07$ghfFdsOgfmdrQxdrtkLxp$');

                if ($usuario["email"] == $mail && $usuario["contrasena"] == $contrasenaEncriptada){

                    ModeloUsuarios::mdlActualizarIntentosFallidos(0, $usuario["token"]);

                    $_SESSION["usuarioIniciado"] = "ok";
                    $_SESSION["idUsuario"] = $usuario["id"];
                    $_SESSION["tokenUsuario"] = $usuario["token"];

                    echo '
                      <script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        
                        window.location = "contrasenas";
                      </script>';
                }
                else {

                    echo "<div class=\"alert alert-danger text-center\">Contraseña erronea</div>";

                    // Actualizar numero de intentos fallidos
                    if ($usuario["intentos_fallidos"] < 3){
                        $fallos = $usuario["intentos_fallidos"]+1;
                        $actualizarFallos = ModeloUsuarios::mdlActualizarIntentosFallidos($fallos, $usuario["token"]);

                        if ($actualizarFallos){
                            echo "<div class='alert alert-danger text-center' role='alert'>Intentos restantes: " . (3-$fallos) . " </div>";
                        }
                    }
                    else {
                        echo "<div class='alert alert-warning text-center' role='alert'>RECAPTCHA Debes validar que no eres un robot </div>";
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

                echo "<div class=\"alert alert-danger text-center\">Usuario no encontrado </div>";

            }
        }
    }

    // Funcion para validar si un usuario ha iniciado sesion y puede acceder a una paginaadmin
    public static function ctrUsuarioIniciado(){
        if (isset($_SESSION["usuarioIniciado"])) {
            if ($_SESSION["usuarioIniciado"] != "ok"){
                echo '<script>window.location = "iniciar-sesion";</script>';
            }
        }
        else{
            echo '<script>window.location = "iniciar-sesion";</script>';
        }
    }
}

