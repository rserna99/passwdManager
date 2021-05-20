<?php

require_once "Modelo\conexion.php";

Class ModeloContrasenas{

    static public function mdlCrearContrasena($datos){

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO contrasenas(token, token_usuario, id_usuario, servicio, url, usuario, contrasena, fecha_creacion) VALUES (:token, :token_usuario, :id_usuario,:servicio,:url,:usuario,:contrasena, :fecha_creacion)"
        );

        $fecha = date('Y-m-d H:i:s');
        $token = strval(md5($fecha));

        $consulta->bindParam(":token", $token, PDO::PARAM_STR);
        $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"], PDO::PARAM_STR);
        $consulta->bindParam(":id_usuario", $_SESSION["idUsuario"], PDO::PARAM_INT);
        $consulta->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
        $consulta->bindParam(":url", $datos["url"], PDO::PARAM_STR);
        $consulta->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $consulta->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
        $consulta->bindParam(":fecha_creacion", $fecha, PDO::PARAM_STR);

        return $consulta->execute();
    }

    static public function mdlObtenerContrasenas($token){

        if ($token != null){

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario AND token = :token"
            );
            $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"], PDO::PARAM_STR);
            $consulta->bindParam(":token", $token, PDO::PARAM_STR);

            $consulta->execute();

            return $consulta->fetchAll();
        }
        else {

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario"
            );
            $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);

            $consulta->execute();

            return $consulta->fetchAll();
        }
    }

    public static function mdlModificarContrasena(array $datos)
    {
        $consulta = Conexion::conectar()->prepare(
            "UPDATE contrasenas SET servicio= :servicio ,url= :url ,usuario= :usuario ,contrasena= :contrasena, fecha_modificacion = :fecha_modificacion WHERE token = :token"
        );

        $date = date('Y-m-d H:i:s');

        $consulta->bindParam(":token", $datos["token"], PDO::PARAM_STR);
        $consulta->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
        $consulta->bindParam(":url", $datos["url"], PDO::PARAM_STR);
        $consulta->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $consulta->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
        $consulta->bindParam(":fecha_modificacion", $date, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function mdlBorrarContrasena($idContrasena)
    {
        $consulta = Conexion::conectar()->prepare(
            "DELETE FROM `contrasenas` WHERE token = :token"
        );

        $consulta->bindParam(":token", $idContrasena, PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function mdlObtenerContrasenasServicio($servicio)
    {
        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario AND servicio = :servicio"
        );
        $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"]);
        $consulta->bindParam(":servicio", $servicio);

        $consulta->execute();

        return $consulta->fetchAll();
    }

    public static function mdlObtenerContrasenasPaginadas($registroInicio, $numeroRegistros, $servicio)
    {
        if ($servicio  == null){
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario  LIMIT :registroInicio , :numeroRegistros"
            );
            $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"], PDO::PARAM_STR);
            $consulta->bindParam(":registroInicio", $registroInicio, PDO::PARAM_INT);
            $consulta->bindParam(":numeroRegistros", $numeroRegistros, PDO::PARAM_INT);


            $consulta->execute();

            return $consulta->fetchAll();
        }
        else {
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM contrasenas WHERE token_usuario = :token_usuario AND servicio = :servicio LIMIT :registroInicio , :numeroRegistros"
            );
            $consulta->bindParam(":token_usuario", $_SESSION["tokenUsuario"], PDO::PARAM_STR);
            $consulta->bindParam(":registroInicio", $registroInicio, PDO::PARAM_INT);
            $consulta->bindParam(":servicio", $servicio, PDO::PARAM_STR);
            $consulta->bindParam(":numeroRegistros", $numeroRegistros, PDO::PARAM_INT);

            $consulta->execute();

            return $consulta->fetchAll();
        }
    }
}