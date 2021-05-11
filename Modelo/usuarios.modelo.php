<?php  

require_once "Modelo\conexion.php"; 

Class ModeloUsuarios{

    static public function mdlRegistoUsuario($datos) {

        $fecha = date('Y-m-d H:i:s');
        $token = strval(md5($fecha));
        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO usuarios(token, nombre, email, contrasena, fecha_registro) VALUES (:token, :nombre, :email, :contrasena, :fecha_registro)"
        );

        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $consulta->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
        $consulta->bindParam(":fecha_registro", $fecha);

        if ($consulta->execute()) 
        {
            return "ok";
        }
        else {
            $consulta->close();
            $consulta = null;
            return "error:No se ha podido guardar el usuario";
        }
    }



    static public function mdlObtenerUsuarios($email = null){

        if ($email == null) {
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM usuarios"
            );

            $consulta->execute();
            $resultado = $consulta->fetchAll();

            return $resultado;
        }
        else {
            $consulta = Conexion::conectar()->prepare(
                "SELECT * FROM usuarios WHERE email = :email"
            );

            $consulta->bindParam(":email", $email);

            $consulta->execute();
            $resultado = $consulta->fetch();

            return $resultado;
        }

        $consulta->close();
        $consulta = null;
    }

}
