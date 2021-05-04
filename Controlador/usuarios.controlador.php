<?php   

class ControladorUsuarios{
    
    public static function ctrRegistrarUsuario(){
        $datos = array(
            "nombre" => $_POST["usrNombre"],
            "email" => $_POST["usrEmail"],
            "contrasena" => $_POST["usrContrasena"]
        );

        $respuesta = usuariosModelo::mdlRegistoUsuario($datos);

        return $respuesta;
    }

    public static function ctrObtenerUsuarios(){

        $resultado = usuariosModelo::mdlObtenerUsuarios();

        return $resultado;
    }
}