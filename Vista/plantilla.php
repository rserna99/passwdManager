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
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Gestor de contraseñas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto">
            <li class="navbar-item">
                <a href="index.php?pagina=registro" class="nav-link">Registrarse</a>
            </li>
            <li class="navbar-item">
                <a href="index.php?pagina=iniciar_sesion" class="nav-link">Iniciar sesion</a>
            </li>
            <li class="navbar-item">
                <a href="index.php?pagina=contrasenas" class="nav-link">Contraseñas</a>
            </li>
            <li class="navbar-item">
                <a href="index.php?pagina=salir" class="nav-link">Salir</a>
            </li>
        </ul>
        </li>
        </ul>
    </div>
</nav>

<br>

<div class="container">
    <?php

    if (isset($_GET["pagina"])) {

        switch ($_GET["pagina"]) {

            case "registro":
                include "Vista\paginas\\registro.php";
                break;
            case "iniciar_sesion":
                include "Vista\paginas\iniciar_sesion.php";
                break;
            case "contrasenas":
                include "Vista\paginas\listar_contrasenas.php";
                break;
            case "salir":
                //include "";
                include "Vista\paginas\salir.php";
                break;
            default:
                echo "<h1>Error 404: Pagina no valida</h1>";

        }
    }

    ?>
</div>


</body>

</html>