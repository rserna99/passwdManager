<?php

require_once "Modelo\conexion.php";

class ModeloGrupos
{

    static public function mdlCrearGrupo($datos) {

        $token = strval(md5(date('Y-m-d H:i:s')));

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO grupos(token, nombre, descripcion) VALUES (:token, :nombre, :descripcion)"
        );

        $consulta->bindParam(":token", $token, PDO::PARAM_STR);
        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        return $consulta->execute();
    }

    static public function mdlObtenerGrupos($token = null){

        if ($token == null){

            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM grupos"
            );
            $consulta->execute();

            return $consulta->fetchAll();
        }
        else {
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM grupos WHERE token = :token"
            );
            $consulta->bindParam(":token", $token, PDO::PARAM_STR);

            $consulta->execute();

            return $consulta->fetch();
        }
    }

    public static function mdlObtenerGruposPaginados($registroInicio, $numeroRegistros)
    {

        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM grupos LIMIT :registroInicio , :numeroRegistros"
        );
        $consulta->bindParam(":registroInicio", $registroInicio, PDO::PARAM_INT);
        $consulta->bindParam(":numeroRegistros", $numeroRegistros, PDO::PARAM_INT);

        $consulta->execute();

        return $consulta->fetchAll();
    }

    public static function mdlActualizarGrupo($datos)
    {

        $consulta = Conexion::conectar()->prepare(
            "UPDATE grupos SET nombre = :nombre, descripcion = :descripcion  WHERE token = :token"
        );

        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $consulta->bindParam(":token", $datos["token"], PDO::PARAM_STR);

        return $consulta->execute();
    }

    public static function mdlBorrarGrupo($token)
    {
        $consulta = Conexion::conectar()->prepare(
            "DELETE FROM grupos WHERE token = :token"
        );

        $consulta->bindParam(":token", $token, PDO::PARAM_STR);

        return $consulta->execute();
    }

}