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

    static public function mdlObtenerContrasenas($idContrasena = null){

        // Contraseña en concreto
        if ($idContrasena != null){

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE id_usuario = :id_usuario AND id = :id_contrasena"
            );
            $consulta->bindParam(":id_usuario", $_SESSION["idUsuario"]);
            $consulta->bindParam(":id_contrasena", $idContrasena);

            $consulta->execute();

            $resultado = $consulta->fetchAll();

            return $resultado;

        }
        // Todas las contraseñas del usuario
        else {
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE id_usuario = :id_usuario"
            );
            $consulta->bindParam(":id_usuario", $_SESSION["idUsuario"]);

            $consulta->execute();

            $resultado = $consulta->fetchAll();

            return $resultado;

        }

        $consulta->close();
        $consulta = null;

    }
}