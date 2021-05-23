<?php

require_once "conexion.php";

class ModeloContrasenaCompartida
{

    static public function mdlCompartirContrasena($datos){
        if ($datos["tipo"] == "usuario"){
            $consulta = Conexion::conectar()->prepare(
                "INSERT INTO `contrasena-compartida` (token_contrasena, token_usuario) VALUES(:token_contrasena, :token_usuario)"
            );

            $consulta->bindParam(":token_contrasena", $datos["tokenContrasena"], PDO::PARAM_STR);
            $consulta->bindParam(":token_usuario", $datos["tokenUsuario"], PDO::PARAM_STR);
        }
        elseif ($datos["tipo"] == "grupo"){
            $consulta = Conexion::conectar()->prepare(
                "INSERT INTO `contrasena-compartida` (token_contrasena, token_grupo) VALUES(:token_contrasena, :token_grupo)"
            );

            $consulta->bindParam(":token_contrasena", $datos["tokenContrasena"], PDO::PARAM_STR);
            $consulta->bindParam(":token_grupo", $datos["tokenGrupo"], PDO::PARAM_STR);
        }
        else {
            return null;
        }

        return $consulta->execute();
    }

    static public function mdlBorrarContrasenaCompartida($datos){
        if ($datos["tipo"] == "usuario"){
            $consulta = Conexion::conectar()->prepare(
                "DELETE FROM `contrasena-compartida` WHERE token_contrasena = :token_contrasena AND token_usuario = :token_usuario"
            );

            $consulta->bindParam(":token_contrasena", $datos["tokenContrasena"], PDO::PARAM_STR);
            $consulta->bindParam(":token_usuario", $datos["tokenUsuario"], PDO::PARAM_STR);
        }
        elseif ($datos["tipo"] == "grupo"){
            $consulta = Conexion::conectar()->prepare(
                "DELETE FROM `contrasena-compartida` WHERE token_contrasena = :token_contrasena AND token_grupo = :token_grupo;"
            );

            $consulta->bindParam(":token_contrasena", $datos["tokenContrasena"], PDO::PARAM_STR);
            $consulta->bindParam(":token_grupo", $datos["tokenGrupo"], PDO::PARAM_STR);
        }
        else {
            return null;
        }

        return $consulta->execute();
    }

    static public function mdlObtenerContrasenaCompartida($datos){

        if ($datos["tipo"] == "usuario"){

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM `contrasena-compartida` WHERE token_contrasena = :token_contrasena AND token_usuario = :token_usuario"
            );

            $consulta->bindParam(":token_contrasena", $datos["tokenContrasena"], PDO::PARAM_STR);
            $consulta->bindParam(":token_usuario", $datos["tokenUsuario"], PDO::PARAM_STR);

            $consulta->execute();
            return $consulta->fetch();
        }
        elseif ($datos["tipo"] == "grupo"){

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM `contrasena-compartida` WHERE token_contrasena = :token_contrasena AND token_grupo = :token_grupo;"
            );

            $consulta->bindParam(":token_contrasena", $datos["tokenContrasena"], PDO::PARAM_STR);
            $consulta->bindParam(":token_grupo", $datos["tokenGrupo"], PDO::PARAM_STR);

            $consulta->execute();
            return $consulta->fetch();
        }
        else {
            return null;
        }
    }

}