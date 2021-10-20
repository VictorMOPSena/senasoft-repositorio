<?php
/*
session_start();

$usuario = $_SESSION[''];

if($usuario == null || $usuario == ""){
    echo "no tiene permiso";
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Index empleados</title>
</head>
<body>
    <div class="container_menu">
        <div class="container_img_logo">
            imagen del logo
        </div>
        <div class="container_perfil">
            <div class="">
                nombre usuario
            </div>
            <div class="container_img_profile">
                imagen de perfil del usuario
            </div>
        </div>

    </div>

    <div class="container_options">
        <div class="container_turno">
            <div class="icono_turno">
                <i class="fas fa-file-signature"></i>
            </div>
            <div class="informacion">
                <h1>presione para seleccionar turnos de la semana</h1>
            </div>
        </div>
        
        <div class="ver_turnos">
        <div class="icono_calendario">
            <i class="fas fa-calendar"></i>
            </div>
            <div class="informacion">
                <h1>presione ver los turnos de la semana</h1>
            </div>
        </div>

    </div>
    
</body>
</html>