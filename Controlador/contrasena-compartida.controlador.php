<?php

require_once "Modelo/contrasena-compartida.modelo.php";

class ControladorContrasenaCompartida
{

    static public function ctrCompartirContrasena($tokenContrasena, $tokensUsuarios, $tokensGrupos){
        if ($tokensUsuarios != null){
            foreach ($tokensUsuarios as $token){
                ModeloContrasenaCompartida::mdlCompartirContrasena($tokenContrasena, $token, null);
            }
        }
        elseif ($tokensGrupos != null){
            foreach ($tokensGrupos as $token){
                ModeloContrasenaCompartida::mdlCompartirContrasena($tokenContrasena, null, $token);
            }
        }
    }
}