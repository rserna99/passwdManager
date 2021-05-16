<?php

require_once "Modelo\conexion.php";

class ModeloGrupos
{

    static public function mdlCrearGrupo($datos) {

        $fecha = date('Y-m-d H:i:s');
        $token = strval(md5($fecha));
        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO grupos(token, nombre, descripcion) VALUES (:token, :nombre, :descripcion)"
        );

        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);


        if ($consulta->execute())
        {
            echo "ok";
            return "ok";
        }
        else {
            echo $consulta->errorInfo();
            $consulta->close();
            $consulta = null;
            return "error:No se ha podido guardar el grupo";
        }
    }

    static public function mdlObtenerGrupos(){

        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM grupos"
        );

        $consulta->execute();
        $resultado = $consulta->fetch();

        return $resultado;

        $consulta->close();
        $consulta = null;
    }

    public static function mdlObtenerGruposPaginados($registroInicio, $numeroRegistros)
    {

        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM grupos LIMIT :registroInicio , :numeroRegistros"
        );
        $consulta->bindParam(":registroInicio", $registroInicio, PDO::PARAM_INT);
        $consulta->bindParam(":numeroRegistros", $numeroRegistros, PDO::PARAM_INT);

        $consulta->execute();

        $resultado = $consulta->fetchAll();

        return $resultado;
    }

    public static function mdlActualizarGrupo($datos)
    {

        $consulta = Conexion::conectar()->prepare(
            "UPDATE grupos SET nombre = :nombre, descripcion = :descripcion  WHERE token = :token"
        );

        $date = date('Y-m-d H:i:s');

        $consulta->bindParam(":nombre", $datos["nombre"]);
        $consulta->bindParam(":descripcion", $datos["descripcion"]);
        $consulta->bindParam(":token", $datos["token"]);


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

    public static function mdlBorrarGrupo($token)
    {
        $consulta = Conexion::conectar()->prepare(
            "DELETE FROM grupos WHERE token = :token"
        );

        $consulta->bindParam(":token", $token);

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