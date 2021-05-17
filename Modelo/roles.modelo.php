<?php

require_once "Modelo\conexion.php";

Class ModeloRoles{

    static public function mdlCrearRol($datos) {

        $fecha = date('Y-m-d H:i:s');
        $token = strval(md5($fecha));
        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO roles(token, nombre, descripcion) VALUES (:token, :nombre, :descripcion)"
        );

        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);


        if ($consulta->execute())
        {
            return "ok";
        }
        else {
            $consulta->close();
            $consulta = null;
            return "error:No se ha podido guardar el rol";
        }
    }

    static public function mdlObtenerRoles($id){
        if ($id != null){
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM roles WHERE id = :id"
            );

            $consulta->bindParam(":id", $id);

            if ($consulta->execute())
            {
                return $consulta->fetch();
            }
            else {
                $consulta->close();
                $consulta = null;
                return "error:No se ha podido guardar el rol";
            }
        }
        else {
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM roles"
            );

            if ($consulta->execute())
            {
                return $consulta->fetchAll();
            }
            else {
                $consulta->close();
                $consulta = null;
                return "error:No se ha podido guardar el rol";
            }
        }
    }
}