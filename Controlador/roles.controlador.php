<?php

require "Modelo/roles.modelo.php";

Class ControladorRoles{

    public static function ctrCrearRol(){

        if (!(isset($_POST["nombre"]) && $_POST["nombre"] != null)){
            return;
        }

        $datos = array(
            "nombre" => $_POST["nombre"],
            "descripcion" => $_POST["descripcion"]
        );

        $respuesta = ModeloRoles::mdlCrearRol($datos);

        return $respuesta;
    }
}