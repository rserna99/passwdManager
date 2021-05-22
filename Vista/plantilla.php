<?php
session_start();

require_once "Controlador/plantillas.controlador.php";

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

            <?php ControladorPlantilla::ctrCrearEnlacesNavbar(); ?>
        </ul>
    </div>
</nav>

<br>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-lg-9" id="contenido">
            <br>
            <?php ControladorPlantilla::ctrWhiteList(); ?>
        </div>
    </div>
</div>

</div>
</body>
<script rel="script" src='Vista/js/contrasenas.js'></script>
<script rel="script" src='Vista/js/usuarios.js'></script>
</html>