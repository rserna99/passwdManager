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
            //ControladorPlantilla::ctrActualizarPagina();
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
                if ($usuarioGrupo["token_rol"] == $datos["token_rol"])
                    return;

                else {
                    echo '<script>alert("Actualizar rol del usuario")</script>';
                    UsuarioGrupoModelo::actualizarUsuarioGrupo($datos);
                    //ControladorUtilidades::ctrActualizarPagina();
                }
            }
            // Crear
            else
            {
                echo '<script>alert("Añadir usuario al grupo")</script>';
                UsuarioGrupoModelo::anadirUsuarioGrupo($datos);
                //ControladorUtilidades::ctrActualizarPagina();
            }
        }




    }

    static public function ctrObtenerRolGrupo($token_grupo, $token_usuario){
        $datos = array(
            "token_usuario" => $token_usuario,
            "token_grupo" => $token_grupo,
        );

        $usuarioGrupo = UsuarioGrupoModelo::obtenerUsuaioGrupo($datos);

        return $usuarioGrupo;
    }

    static public function ctrObtenerUsuariosDelGrupo($token_grupo){
        $usuariosDelGrupo = UsuarioGrupoModelo::mdlObtenerUsuariosDelGrupo($token_grupo);

        return $usuariosDelGrupo;
    }

}