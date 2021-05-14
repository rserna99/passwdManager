<?php

require_once "Modelo\conexion.php";

Class ModeloContrasenas{

    static public function mdlCrearContrasena($datos){

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO contrasenas(token, token_usuario, id_usuario, servicio, url, usuario, contrasena, fecha_creacion) VALUES (:token, :token_usuario, :id_usuario,:servicio,:url,:usuario,:contrasena, :fecha_creacion)"
        );

        $fecha = date('Y-m-d H:i:s');
        $token = strval(md5($fecha));

        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);
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

    static public function mdlObtenerContrasenas($token){

        if ($token != null){


            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario AND token = :token"
            );
            $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);
            $consulta->bindParam(":token", $token);

            $consulta->execute();
            $resultado = $consulta->fetchAll();

            return $resultado;
        }
        else {

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario"
            );
            $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);

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
            "UPDATE contrasenas SET servicio= :servicio ,url= :url ,usuario= :usuario ,contrasena= :contrasena, fecha_modificacion = :fecha_modificacion WHERE token = :token"
        );

        $date = date('Y-m-d H:i:s');

        $consulta->bindParam(":token", $datos["token"]);
        $consulta->bindParam(":servicio", $datos["servicio"]);
        $consulta->bindParam(":url", $datos["url"]);
        $consulta->bindParam(":usuario", $datos["usuario"]);
        $consulta->bindParam(":contrasena", $datos["contrasena"]);
        $consulta->bindParam(":fecha_modificacion", $date);

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
            "DELETE FROM `contrasenas` WHERE token = :token"
        );

        $consulta->bindParam(":token", $idContrasena);

        if ($consulta->execute())
        {
            return true;
        }
        else {

            $consulta->close();
            $consulta = null;
            //return Conexion::conectar()->errorInfo();
            return ;
        }
    }

    public static function mdlObtenerContrasenasServicio($servicio)
    {
        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario AND servicio = :servicio"
        );
        $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);
        $consulta->bindParam(":servicio", $servicio);

        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public static function mdlObtenerContrasenasPaginadas($registroInicio, $registroFin)
    {
        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario LIMIT :inicio , :fin"
        );
        $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);
        $consulta->bindParam(":inicio", $registroInicio, PDO::PARAM_INT);
        $consulta->bindParam(":fin", $registroFin, PDO::PARAM_INT);

        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }
}