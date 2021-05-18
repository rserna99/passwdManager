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

        //print_r($datos);
        $usuarioGrupo = UsuarioGrupoModelo::obtenerUsuaioGrupo($datos);

        print_r($usuarioGrupo);

        // Actualizar
        if ($usuarioGrupo != null){

            // Si ya esta registrado con el mismo rol no hacemos nada
            if ($usuarioGrupo["token_rol"] == $datos["token_rol"])
                return;

            // En el caso contrario actualizar el rol
            else {
                UsuarioGrupoModelo::actualizarUsuarioGrupo($datos);
            }

            // Opcion de borrar
            // si la consulta devuelve un resultado pero en el post no hay datos borrar
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