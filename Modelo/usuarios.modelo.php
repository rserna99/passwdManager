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

    static public function mdlObtenerUsuarioToken($token){

        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM usuarios WHERE token = :token"
        );

        $consulta->bindParam(":token", $token);

        $consulta->execute();
        $resultado = $consulta->fetch();

        return $resultado;
    }

    static public function mdlActualizarIntentosFallidos($intentos, $token){
        $consulta = Conexion::conectar()->prepare(
            "UPDATE usuarios SET intentos_fallidos= :intentos WHERE token = :token"
        );


        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":intentos", $intentos);

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

    public static function mdlActualizarUsuario($datos)
    {

        if (isset($datos["contrrasena"]))
        { // Actualizar usuario con nueva contraseña
            $consulta = Conexion::conectar()->prepare(
                "UPDATE usuarios SET nombre = :nombre, email = :email, contrasena = :contrasena, fecha_modificacion = :fecha_modificacion  WHERE token = :token"
            );

            $date = date('Y-m-d H:i:s');

            $consulta->bindParam(":nombre", $datos["nombre"]);
            $consulta->bindParam(":email", $datos["email"]);
            $consulta->bindParam(":contrasena", $datos["contrasena"]);
            $consulta->bindParam(":fecha_modificacion", $date);
            $consulta->bindParam(":token", $_SESSION["tokenUsuario"]);


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
        else { // Actualizar usuario sin nueva contraseña
            $consulta = Conexion::conectar()->prepare(
                "UPDATE usuarios SET nombre = :nombre, email = :email, fecha_modificacion = :fecha_modificacion  WHERE token = :token"
            );

            $date = date('Y-m-d H:i:s');

            $consulta->bindParam(":nombre", $datos["nombre"]);
            $consulta->bindParam(":email", $datos["email"]);
            $consulta->bindParam(":fecha_modificacion", $date);
            $consulta->bindParam(":token", $_SESSION["tokenUsuario"]);


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

    public static function mdlObtenerServicios()
    {
        $consulta = Conexion::conectar()->prepare(
            "SELECT DISTINCT servicio FROM contrasenas WHERE token_usuario = :token"
        );

        $consulta->bindParam(":token", $_SESSION["tokenUsuario"]);


        if ($consulta->execute())
        {
            return $consulta->fetchAll();
        }
        else {

            $consulta->close();
            $consulta = null;
            return Conexion::conectar()->errorInfo();
        }
    }

    public static function mdlBorrarUsuarios($token)
    {
        $consulta = Conexion::conectar()->prepare(
            "DELETE FROM `usuarios` WHERE token = :token"
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
