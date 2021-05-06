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

        $resultado = usuariosModelo::mdlObtenerUsuarios(null);

        return $resultado;
    }

    public function ctrIniciarSesion()
    {
        if (isset($_POST["email"])){
            $mail = $_POST["email"];
            $contrasena = $_POST["contrasena"];
            $usuario = usuariosModelo::mdlObtenerUsuarios($mail);

            if (isset($usuario["email"])){
                if ($usuario["email"] == $mail && $usuario["contrasena"] == $contrasena){

                    $_SESSION["usuarioIniciado"] = "ok";
                    $_SESSION["idUsuario"] = $usuario["id"];

                    echo '
                      <script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        
                        window.location = "index.php?pagina=contrasenas";
                      </script>';


                }

            }
            else {

                echo '
                      <script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                      </script>';

                echo '<div class="alert alert-danger text-center">El usuario es incorrecto</div>';

            }


        }
    }
}

