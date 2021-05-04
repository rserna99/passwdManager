<?php

class Conexion {

    static public function conectar(){
        
        # DATOS DE CONEXION
        $host = "127.0.0.1";
        $database = "gestor_contrasenas";
        $usuario = "root";
        $passwd = "";

        $conexion = new PDO("mysql:host=$host;dbname=$database", $usuario, $passwd);
        $conexion->exec("set names utf8");

        return $conexion;
    }
}

?>