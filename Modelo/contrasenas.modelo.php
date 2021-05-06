<?php

require_once "Modelo\conexion.php";

Class contrasenasModelo{

    static public function mdlCrearContrasena($datos){

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO contrasenas(id_usuario, servicio, url, usuario, contrasena) VALUES (:id_usuario,:servicio,:url,:usuario,:contrasena)"
        );

        $consulta->bindParam(":id_usuario", $_SESSION["idUsuario"]);
        $consulta->bindParam(":servicio", $datos["servicio"]);
        $consulta->bindParam(":url", $datos["url"]);
        $consulta->bindParam(":usuario", $datos["usuario"]);
        $consulta->bindParam(":contrasena", $datos["contrasena"]);

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

    static public function mdlObtenerContrasenas($idUsuario, $idContrasena = null){

    }
}