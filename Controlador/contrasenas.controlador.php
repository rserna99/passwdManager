<?php

require "Modelo/modelo.contrasenas.php";

class ControladorContrasenas{

    public static function ctrCrearContrasena(){

        if (isset($_POST["servicio"])) {
            $datos = array(
                "servicio" => $_POST["servicio"],
                "url" => $_POST["url"],
                "usuario" => $_POST["usuario"],
                "contrasena" => $_POST["contrasena"]
            );

            $respuesta = ModeloContrasenas::mdlCrearContrasena($datos);

            return $respuesta;
        }
    }

    public static function ctrListarContrasenas($idContrasena){

        $resultado = ModeloContrasenas::mdlObtenerContrasenas($idContrasena);

        return $resultado;

    }

    public static function ctrModificarContrasena()
    {
        if (isset($_POST["servicio"])) {
            $datos = array(
                "id" => $_POST["idContrasena"],
                "servicio" => $_POST["servicio"],
                "url" => $_POST["url"],
                "usuario" => $_POST["usuario"],
                "contrasena" => $_POST["contrasena"]
            );

            $respuesta = ModeloContrasenas::mdlModificarContrasena($datos);

            return $respuesta;
        }
    }

    public static function ctrBorrarContrasena()
    {
        if (isset($_POST["borrarContrasenaId"])) {

            $respuesta = ModeloContrasenas::mdlBorrarContrasena($_POST["borrarContrasenaId"]);

            if ($respuesta){
                echo "<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                       </script>";

                echo '<script>window.location = "index.php?pagina=contrasenas";</script>';
            }
            return $respuesta;
        }
    }
}
