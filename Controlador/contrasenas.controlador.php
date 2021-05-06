<?php

class ControladorContrasenas{

    public static function ctrCrearContrasena(){

        if (isset($_POST["nombre"])) {
            $datos = array(
                "servicio" => $_POST["servicio"],
                "url" => $_POST["url"],
                "usuario" => $_POST["usuario"],
                "contrasena" => $_POST["contrasena"]
            );

            print_r("CTR: " . $datos);

            $respuesta = contrasenasModelo::mdlCrearContrasena($datos);

            return $respuesta;
        }

    }

    public static function ctrListarContrasenas($idUsuario){

    }
}
