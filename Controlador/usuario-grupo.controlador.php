<?php

require "Modelo/usuario-grupo.modelo.php";
require "Modelo/roles.modelo.php";

Class UsuarioGrupoControlador{


    static public function actializarUsuarioGrupo(){

        if (!isset($_POST["token_usuario"]) && !isset($_POST["token_grupo"]))
            return;

        //Borrar
        if (!isset($_POST["miembro"]) && !isset($_POST["admin"])){

            $datos = array(
                "token_usuario" => $_POST["token_usuario"],
                "token_grupo" => $_POST["token_grupo"]
            );

            UsuarioGrupoModelo::borrarUsuarioGrupo($datos);
            echo '<script>alert("borrar usuario del grupo")</script>';
        }
        else {
            $rol = ModeloRoles::mdlObtenerRoles((isset($_POST["admin"]))? 2 : 3);
            $datos = array(
                "token_usuario" => $_POST["token_usuario"],
                "token_grupo" => $_POST["token_grupo"],
                "token_rol" => $rol["token"]
            );

            $usuarioGrupo = UsuarioGrupoModelo::obtenerUsuaioGrupo($datos);

            // Actualizar
            if ($usuarioGrupo != null){
                // Si ya esta registrado con el mismo rol no hacemos nada
                if ($usuarioGrupo["token_rol"] == $datos["token_rol"])
                    return;

                // En el caso contrario actualizar el rol
                else {
                    echo '<script>alert("Actualizar rol del usuario")</script>';
                    UsuarioGrupoModelo::actualizarUsuarioGrupo($datos);
                }
            }
            // Crear
            else
            {
                echo '<script>alert("Añadir usuario al grupo")</script>';
                UsuarioGrupoModelo::anadirUsuarioGrupo($datos);
            }
        }


        echo "<script>
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
        </script>";

    }

}