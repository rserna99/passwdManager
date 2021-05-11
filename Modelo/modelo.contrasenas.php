<?php

require_once "Modelo\conexion.php";

Class ModeloContrasenas{

    static public function mdlCrearContrasena($datos){

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO contrasenas(token, id_usuario, servicio, url, usuario, contrasena, fecha_creacion) VALUES (:token, :id_usuario,:servicio,:url,:usuario,:contrasena, :fecha_creacion)"
        );

        $fecha = date('Y-m-d H:i:s');
        $token = strval(md5($fecha));

        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":id_usuario", $_SESSION["idUsuario"]);
        $consulta->bindParam(":servicio", $datos["servicio"]);
        $consulta->bindParam(":url", $datos["url"]);
        $consulta->bindParam(":usuario", $datos["usuario"]);
        $consulta->bindParam(":contrasena", $datos["contrasena"]);
        $consulta->bindParam(":fecha_creacion", $fecha);

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

    static public function mdlObtenerContrasenas($idContrasena){

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

    public static function mdlModificarContrasena(array $datos)
    {
        $consulta = Conexion::conectar()->prepare(
            "UPDATE contrasenas SET servicio= :servicio ,url= :url ,usuario= :usuario ,contrasena= :contrasena WHERE id = :id"
        );

        $consulta->bindParam(":id", $datos["id"]);
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

    public static function mdlBorrarContrasena($idContrasena)
    {
        $consulta = Conexion::conectar()->prepare(
            "DELETE FROM `contrasenas` WHERE id = :id"
        );

        $consulta->bindParam(":id", $idContrasena);

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
}