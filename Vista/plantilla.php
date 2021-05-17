<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset='utf-8'>

    <title>Gestor de contraseñas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c5c009e5a9.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Raleway&display=swap" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="Vista/paginas/style.css">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="contrasenas" id="titulo-navbar">Gestor de contraseñas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">








            <?php
            if (isset($_SESSION["usuarioIniciado"]) && $_SESSION["usuarioIniciado"] == "ok")
            {
                echo '<li class="navbar-item">';
                echo '<a title="Contraseñas" href="contrasenas" class="nav-link">Contraseñas <i class="fas fa-key"></i></a>';
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
            ?>
        </ul>
    </div>
</nav>

<br>

<div class="container" id="contenido">
    <br>
    <?php

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

    ?>
</div>
</body>
<script rel="script" src='Vista/js/contrasenas.js'></script>
<script rel="script" src='Vista/js/usuarios.js'></script>
</html>