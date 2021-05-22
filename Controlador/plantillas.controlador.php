<?php

class ControladorPlantilla{

    public function ctrMostrarPlantilla(){

        include "Vista\plantilla.php";
    }


    static public function ctrActualizarPagina(){
        echo "<script>
                window.location.reload();
            </script>";
        return;
    }

    static public function ctrCambiarPagina($pagina, $delayMs){

        echo ($delayMs != null)?
            '<script> setTimeout(function() { window.location = "' . $pagina . '" ; }, ' . $delayMs . ') </script>' :
            '<script> window.location = "' . $pagina .'"; </script>';

    }

    static public function crtLimpiarDatosNavegador(){
        echo "<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                       </script>";
    }

    static public function ctrCrearEnlacesNavbar(){
        if (isset($_SESSION["usuarioIniciado"]) && $_SESSION["usuarioIniciado"] == "ok")
        {

            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" id="dropdown-contrasenas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contraseñas <i class="fas fa-key"></i></a>';
            echo '<div class="dropdown-menu" aria-labelledby="dropdown-contrasenas">';
            echo '<a title="Mis contraseñas" href="contrasenas" class="dropdown-item">Mis contraseñas </a>';
            echo '<a title="Contraseñas compartidas" href="contrasenas-compartidas" class="dropdown-item">Contraseñas compartidas </i></a>';
            echo '</div>';
            echo '</li>';

            echo '<li class="navbar-item">';
            echo '<a title="Editar usuario" href="index.php?pagina=editar-usuario&token=' . $_SESSION["tokenUsuario"] .'" class="nav-link">Editar usuario <i class="fas fa-user-edit"></i></a>';
            echo '</li>';

            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administración <i class="fas fa-cogs"></i></a>';
            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
            echo '<a title="Administrar usuario" href="administrar-usuarios" class="dropdown-item">Administrar usuarios <i class="fas fa-user-cog"></i></i></a>';
            echo '<a title="Administrar grupos" href="administrar-grupos" class="dropdown-item">Administrar grupos <i class="fas fa-users-cog"></i></a>';
            echo '<a title="Crear roles" href="crear-rol" class="dropdown-item">Crear rol</i></a>';
            echo '</div>';
            echo '</li>';

            echo '<li class="navbar-item">';
            echo '<a title="Cerrar sesion" href="salir" class="nav-link">Cerrar sesion <i class="fas fa-sign-out-alt"></i></a>';
            echo '</li>';
        }
        else {
            echo '<li class="navbar-item">';
            echo '<a title="Registrar usuario" href="registro" class="nav-link">Registro <i class="fas fa-user-plus"></i></a>';
            echo '</li>';

            echo '<li class="navbar-item">';
            echo '<a title="Iniciar sesion" href="iniciar-sesion" class="nav-link">Iniciar sesión <i class="fas fa-sign-in-alt"></i></a>';
            echo '</li>';
        }
    }

    static public function ctrWhiteList(){
        if (isset($_GET["pagina"])) {

            switch ($_GET["pagina"]) {

                case "registro":
                    include "Vista/paginas/usuarios/registro.php";
                    break;
                case "iniciar-sesion":
                    include "Vista/paginas/usuarios/iniciar_sesion.php";
                    break;
                case "editar-usuario":
                    include "Vista/paginas/usuarios/editar_usuario.php";
                    break;
                case "administrar-usuarios":
                    include "Vista/paginas/usuarios/admin_usuarios.php";
                    break;
                case "administrar-grupos":
                    include "Vista/paginas/grupos/admin-grupos.php";
                    break;
                case "crear-rol":
                    include "Vista/paginas/roles/crear_rol.php";
                    break;
                case "crear-grupo":
                    include "Vista/paginas/grupos/crear-grupo.php";
                    break;
                case "editar-grupo":
                    include "Vista/paginas/grupos/editar-grupo.php";
                    break;
                case "contrasenas":
                    include "Vista/paginas/contrasenas/listar_contrasenas.php";
                    break;
                case "nueva-contrasena":
                    include "Vista/paginas/contrasenas/crear_contrasena.php";
                    break;
                case "editar-contrasena":
                    include "Vista/paginas/contrasenas/editar_contrasenas.php";
                    break;
                case "compartir-contrasena":
                    include "Vista/paginas/contrasenas/compartir-contrasena.php";
                    break;
                case "salir":
                    include "Vista/paginas/usuarios/salir.php";
                    break;
                default:
                    include "Vista/paginas/error404.php";
                    break;

            }
        }
        else {
            include "Vista/paginas/usuarios/iniciar_sesion.php";
        }
    }
}
