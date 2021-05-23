<?php

require_once "Modelo/contrasena-compartida.modelo.php";

class ControladorContrasenaCompartida
{

    static public function ctrCompartirContrasena($tokenContrasena, $tokensUsuarios, $tokensGrupos){
        if ($tokensUsuarios != null){
            foreach ($tokensUsuarios as $token){
                $datos = array(
                  "tipo" => "usuario",
                  "tokenContrasena" => $tokenContrasena,
                  "tokenUsuario" => $token
                );
                ModeloContrasenaCompartida::mdlCompartirContrasena($datos);
            }
        }
        elseif ($tokensGrupos != null){
            foreach ($tokensGrupos as $token){
                $datos = array(
                    "tipo" => "grupo",
                    "tokenContrasena" => $tokenContrasena,
                    "tokenGrupo" => $token
                );
                ModeloContrasenaCompartida::mdlCompartirContrasena($datos);
            }
        }
    }


    static public function ctrBorrarContrasenaCompartida($tokenContrasena, $tokensUsuarios, $tokensGrupos){
        if ($tokensUsuarios != null){
            foreach ($tokensUsuarios as $token){
                $datos = array(
                    "tipo" => "usuario",
                    "tokenContrasena" => $tokenContrasena,
                    "tokenUsuario" => $token
                );
                ModeloContrasenaCompartida::mdlBorrarContrasenaCompartida($datos);
            }
        }
        elseif ($tokensGrupos != null){
            foreach ($tokensGrupos as $token){
                $datos = array(
                    "tipo" => "grupo",
                    "tokenContrasena" => $tokenContrasena,
                    "tokenGrupo" => $token
                );
                ModeloContrasenaCompartida::mdlBorrarContrasenaCompartida($datos);
            }
        }
    }


    static public function ctrObtenerContrasenaCompartida($tokenContrasena, $tokensUsuarios, $tokensGrupos){
        if ($tokensUsuarios != null){
            if (count(array($tokensUsuarios)) > 1){
                foreach ($tokensUsuarios as $token){
                    $datos = array(
                        "tipo" => "usuario",
                        "tokenContrasena" => $tokenContrasena,
                        "tokenUsuario" => $token
                    );
                    return ModeloContrasenaCompartida::mdlObtenerContrasenaCompartida($datos);
                }

            }
            else {
                $datos = array(
                    "tipo" => "usuario",
                    "tokenContrasena" => $tokenContrasena,
                    "tokenUsuario" => $tokensUsuarios
                );
                return ModeloContrasenaCompartida::mdlObtenerContrasenaCompartida($datos);
            }
        }
        elseif ($tokensGrupos != null){
            if (count(array($tokensGrupos)) > 1){
                foreach ($tokensGrupos as $token){
                    $datos = array(
                        "tipo" => "grupo",
                        "tokenContrasena" => $tokenContrasena,
                        "tokenGrupo" => $token
                    );
                    return ModeloContrasenaCompartida::mdlObtenerContrasenaCompartida($datos);
                }
            }
            else {
                $datos = array(
                    "tipo" => "grupo",
                    "tokenContrasena" => $tokenContrasena,
                    "tokenGrupo" => $tokensGrupos
                );
                return ModeloContrasenaCompartida::mdlObtenerContrasenaCompartida($datos);
            }

        }
    }
}