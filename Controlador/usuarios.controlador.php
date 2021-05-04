<?php   

require "Modelo/usuarios.modelo.php";

class ControladorUsuarios{
    
    public static function ctrRegistrarUsuario(){

        if (isset($_POST["nombreRegistro"])) {
            $datos = array(
                "nombre" => $_POST["nombreRegistro"],
                "email" => $_POST["emailRegistro"],
                "contrasena" => $_POST["contrasenaRegistro"]
            );

            $respuesta = usuariosModelo::mdlRegistoUsuario($datos);

            return $respuesta;
        }


    }

    public static function ctrObtenerUsuarios(){

        $resultado = usuariosModelo::mdlObtenerUsuarios();

        return $resultado;
    }
}