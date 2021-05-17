<?php

require_once "Modelo/conexion.php";

Class UsuarioGrupoModelo{

    static public function anadirUsuarioGrupo($datos){
        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO `usuario-grupo` (token_usuario, token_grupo, token_rol) VALUES (:token_usuario, :token_grupo, :token_rol)"
        );

        $consulta->bindParam(":token_usuario", $datos["token_usuario"]);
        $consulta->bindParam(":token_grupo", $datos["token_grupo"]);
        $consulta->bindParam(":token_rol", $datos["token_rol"]);


        if ($consulta->execute())
        {
            return true;
        }
        else {

            $consulta->close();
            $consulta = null;
            return Conexion::conectar()->errorInfo();
        }
    }

    static public function obtenerUsuaioGrupo($datos){
        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM `usuario-grupo` WHERE token_usuario = :token_usuario AND token_grupo = :token_grupo"
        );

        $consulta->bindParam(":token_usuario", $datos["token_usuario"]);
        $consulta->bindParam(":token_grupo", $datos["token_grupo"]);


        if ($consulta->execute())
        {
            return $consulta->fetchAll();
        }
        else {

            $consulta->close();
            $consulta = null;
            return null;
        }
    }

    static public function actualizarUsuarioGrupo(){

    }

    static public function borrarUsuarioGrupo(){

    }

}
