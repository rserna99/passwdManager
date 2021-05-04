<?php  

require_once "Modelo\conexion.php"; 

Class usuariosModelo{

    
    // $datos es un diccionario con el nombre, email y la contraseña
    static public function mdlRegistoUsuario($datos) {

        $consulta = Conexion::conectar()->prepare(
            "INSERT INTO usuarios(nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)"
        );
        
        
        $consulta->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $consulta->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $consulta->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
        // Se usa bindParam para evitar ataques de SQLinjection

        //$retVal = ($consulta->execute()) ? true : print_r(Conexion::conectar()->errorInfo()) ;

        if ($consulta->execute()) 
        {
            
            return true;
        }
        else {
            
            print_r(Conexion::conectar()->errorInfo());
            $consulta->close();
            $consulta = null;
        }

    }



    static public function mdlObtenerUsuarios(){

        $consulta = Conexion::conectar()->prepare(
            "SELECT * FROM usuarios"
        );

        $consulta->execute();
        
        return $consulta->fechAll();

        $consulta->close();
        $consulta = null;

    }

}
