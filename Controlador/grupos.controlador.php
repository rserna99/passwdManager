<?php

require "Modelo/grupos.modelo.php";

class ControladorGrupos
{

    public static function ctrCrearGrupo(){

        if (!(isset($_POST["nombre"]) && $_POST["descripcion"] != null))
            return null;

        $datos = array(
            "nombre" => $_POST["nombre"],
            "descripcion" => $_POST["descripcion"]
        );

        $respuesta = ModeloGrupos::mdlCrearGrupo($datos);

        return $respuesta;
    }

    public static function ctrActualizarGrupo(){


        if (!isset($_POST["nombre"]) && !isset($_POST["descripcion"]))
            return null;

        $token = (isset($_GET["token"]))?
            $_GET["token"]:
            $_SESSION["tokenUsuario"];

        $datos = array(
                "nombre" => $_POST["nombre"],
                "descripcion" => $_POST["descripcion"],
                "token" => $token
            );

        ModeloGrupos::mdlActualizarGrupo($datos);

        return true;
    }

    public static function ctrBorrarGrupo()
    {
        if (isset($_POST["borrarGrupoId"])) {

            $respuesta = ModeloGrupos::mdlBorrarGrupo($_POST["borrarGrupoId"]);

            if ($respuesta){

                ControladorPlantilla::crtLimpiarDatosNavegador();
                ControladorPlantilla::ctrCambiarPagina("administrar-grupos", null);

            }
            return $respuesta;
        }
        return false;
    }

    public static function ctrListarGrupos($token){

        $resultado = ModeloGrupos::mdlObtenerGrupos($token);

        return $resultado;
    }

    public static function ctrListarUsuariosPaginados($usuariosPorPagina, $pagina)
    {
        $registroInicio = 0;
        $numeroRegistros = $usuariosPorPagina;

        for ($i = 1; $i < $pagina; $i++){
            $registroInicio = $registroInicio + $usuariosPorPagina;

        }


        $respuesta = ModeloGrupos::mdlObtenerGruposPaginados($registroInicio, $numeroRegistros);

        return $respuesta;
    }

}