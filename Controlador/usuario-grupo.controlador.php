<?php

require "Modelo/usuario-grupo.modelo.php";
require "Modelo/roles.modelo.php";

Class UsuarioGrupoControlador{


    static public function actializarUsuarioGrupo(){

        if (!isset($_POST["miembro"]) && !isset($_POST["admin"]))
            return;

        $rol = ModeloRoles::mdlObtenerRoles((isset($_POST["admin"]))? 2 : 3);

        $datos = array(
            "token_usuario" => $_POST["token_usuario"],
            "token_grupo" => $_POST["token_grupo"],
            "token_rol" => $rol["token"]
        );

        print_r($datos);
        $usuarioGrupo = UsuarioGrupoModelo::obtenerUsuaioGrupo($datos);

        // Actualizar
        if ($usuarioGrupo != null){
            UsuarioGrupoModelo::actualizarUsuarioGrupo();
            // Opcion de borrar
        }
        // Crear
        else
        {
            UsuarioGrupoModelo::anadirUsuarioGrupo($datos);
        }



        echo "<script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>";


        //print_r($_POST);
        // 1- Obtener el rol
        // 2- Comprobar si el usuario ya esta en el grupo
            // Si esta en el grupo con un rol distinto actualizarlo con un INSERT
            // Si  no esta anadirlo con el rol indicado

    }

}