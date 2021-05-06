<?php

require "Modelo/contrasenas.modelo.php";

class ControladorContrasenas{

    public static function ctrCrearContrasena(){

        if (isset($_POST["servicio"])) {
            $datos = array(
                "servicio" => $_POST["servicio"],
                "url" => $_POST["url"],
                "usuario" => $_POST["usuario"],
                "contrasena" => $_POST["contrasena"]
            );

            $respuesta = contrasenasModelo::mdlCrearContrasena($datos);

            return $respuesta;
        }
    }

    public static function ctrListarContrasenas($idContrasena = null){

        $resultado = contrasenasModelo::mdlObtenerContrasenas($idContrasena);

        return $resultado;

    }
}
