<?php

Class ControladorSeguridad{

    public static function ctrValidarNombreUsuario($nombre){
        if (isset($nombre) && $nombre != "")
        {
            if (preg_match('/^[a-zA-ZáéíóúàèìòùñÑ ]+$/', $nombre)){
                return "ok";
            }
            else {
                return "error:Nombre no valido";
            }
        }
        else {
            return "error:Introducir nombre";
        }
    }

    public static function  ctrValidarEmail($email){

        if (isset($email) && $email != "")
        {
            if (preg_match('/^[^0-9][a-zA-Z0-9]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)){
                return "ok";
            }
            else {
                return "error:Email no valido";
            }
        }
        else {
            return "error:Introducir email";
        }
    }

    public static function ctrValidarContrasena($contrasena){
        // Requisitos de la contraseña:
            # Longitud de 8 a 16 caracteres
            # Minimo un digito
            # Minimo una letra mayuscula
            # Minimo una letra miniscula

        if (isset($contrasena) && $contrasena != "") {
            if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $contrasena)){
                return "ok";
            }
            else {
                return "error:Contraseña no valida";
            }
        }
        else {
            return "error:Introducir contraseña";
        }
    }
}



