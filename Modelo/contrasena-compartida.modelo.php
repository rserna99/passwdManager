<?php

require_once "conexion.php";

class ModeloContrasenaCompartida
{

    static public function mdlCompartirContrasena($tokenContrasena, $tokenUsuario, $tokenGrupo){
        if ($tokenUsuario != null){
            $consulta = Conexion::conectar()->prepare(
                "INSERT INTO `contrasena-compartida` (token_contrasena, token_usuario) VALUES(:token_contrasena, :token_usuario)"
            );

            $consulta->bindParam(":token_contrasena", $tokenContrasena, PDO::PARAM_STR);
            $consulta->bindParam(":token_usuario", $tokenUsuario, PDO::PARAM_STR);
        }
        elseif ($tokenGrupo != null){
            $consulta = Conexion::conectar()->prepare(
                "INSERT INTO `contrasena-compartida` (token_contrasena, token_grupo) VALUES(:token_contrasena, :token_grupo)"
            );

            $consulta->bindParam(":token_contrasena", $tokenContrasena, PDO::PARAM_STR);
            $consulta->bindParam(":token_grupo", $tokenGrupo, PDO::PARAM_STR);
        }
        else {
            return null;
        }

        return $consulta->execute();
    }

}