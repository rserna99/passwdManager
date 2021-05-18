<?php

class ControladorPlantilla{

    public function ctrMostrarPlantilla(){

        include "Vista\plantilla.php";
    }


    static public function ctrActualizarPagina(){
        echo "<script>
                window.location.reload();
            </script>";
    }
}
