<?php  

require_once "Modelo\conexion.php"; 

Class ModeloUsuarios{

    static public function mdlRegistoUsuario($datos) {

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO usuarios(nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)"
        );
        
        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $consulta->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);

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
