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

            $respuesta = contrasenasModelo::mdlModificarContrasena($datos);

            if ($respuesta){
                echo "<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                       </script>";

                echo '<script>window.location = "index.php?pagina=contrasenas"; </script>';

                //echo '<div class="alert alert-success" role="alert">Contraseña actualizada correctamente</div>';
            }

            return $respuesta;
        }
    }
}
