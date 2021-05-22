<?php

require_once "Modelo/conexion.php";

Class UsuarioGrupoModelo{

    static public function anadirUsuarioGrupo($datos){
        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO `usuario-grupo` (token_usuario, token_grupo, token_rol) VALUES (:token_usuario, :token_grupo, :token_rol)"
        );

        $consulta->bindParam(":token_usuario", $datos["token_usuario"], PDO::PARAM_STR);
        $consulta->bindParam(":token_grupo", $datos["token_grupo"], PDO::PARAM_STR);
        $consulta->bindParam(":token_rol", $datos["token_rol"], PDO::PARAM_STR);

        return $consulta->execute();
    }

    static public function obtenerUsuaioGrupo($datos){
        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM `usuario-grupo` WHERE token_usuario = :token_usuario AND token_grupo = :token_grupo"
        );

        $consulta->bindParam(":token_usuario", $datos["token_usuario"], PDO::PARAM_STR);
        $consulta->bindParam(":token_grupo", $datos["token_grupo"], PDO::PARAM_STR);


        $consulta->execute();
        return $consulta->fetch();
    }

    static public function actualizarUsuarioGrupo($datos){

        $consulta = Conexion::conectar()->prepare(
            "UPDATE `usuario-grupo` SET token_rol = :token_rol  WHERE token_usuario = :token_usuario AND token_grupo = :token_grupo"
        );

        $consulta->bindParam(":token_usuario", $datos["token_usuario"], PDO::PARAM_STR);
        $consulta->bindParam(":token_grupo", $datos["token_grupo"], PDO::PARAM_STR);
        $consulta->bindParam(":token_rol", $datos["token_rol"], PDO::PARAM_STR);


        return $consulta->execute();

    }

    static public function borrarUsuarioGrupo($datos){
        $consulta = Conexion::conectar()->prepare(
            "DELETE FROM `usuario-grupo`WHERE token_usuario = :token_usuario AND token_grupo = :token_grupo"
        );

        $consulta->bindParam(":token_usuario", $datos["token_usuario"], PDO::PARAM_STR);
        $consulta->bindParam(":token_grupo", $datos["token_grupo"], PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function mdlObtenerUsuariosDelGrupo($token_grupo)
    {
        $consulta = Conexion::conectar()->prepare(
            "SELECT u.nombre FROM `usuario-grupo` AS ug INNER JOIN usuarios u ON u.token = ug.token_usuario WHERE ug.token_grupo = :token_grupo"
        );

        $consulta->bindParam(":token_grupo", $token_grupo, PDO::PARAM_STR);

        $consulta->execute();
        return $consulta->fetchAll();
    }

}
