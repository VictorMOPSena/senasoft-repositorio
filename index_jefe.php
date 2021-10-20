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
    <link rel="stylesheet" href="./assets/css/interfaces/index_jefe.css">
    <title>Index jefe</title>
</head>
<body>
    <div class="container_menu">
        <div class="container_img_logo">
            imagen del logo
        </div>
        <div class="container_perfil">
            <div class="container_name_user">
                nombre usuario
            </div>
            <div class="container_img_profile">
                imagen de perfil del usuario
            </div>
        </div>
    </div>

    <div class="container_options">


        <div class="container_turno">
            <a href="ver_personal.php">
            <div class="icono_turno">
                <i class="fas fa-file-signature"></i>
            </div>
            <div class="informacion">
                <h1>presione para ver personal</h1>
            </div>
            </a>
        </div>  

        <div class="ver_turnos">
            <a href="">
            <div class="icono_calendario">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="informacion">
                <h1>presione ver los turnos</h1>
            </div>
            </a>
        </div>

        <div class="ver_empleados">
            <a href="ver_empleados.php">
            <div class="icono_empleados">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="informacion">
                <h1>Ver empleados</h1>
            </div>
            </a>
        </div>

        <div class="agregar_personal">
            <a href="agregar_personal.php">
            <div class="icono_agregar_personal">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="informacion">
                <h1>Agregar personal</h1>
            </div>
            </a>
        </div>

        <div class="crear_usuario">
            <a href="agregar_personal.php">
            <div class="icono_crear_usuario">
                <i class="fas fa-users"></i>
            </div>
            <div class="informacion">
                <h1>Crear usuario nuevo</h1>
            </div>
            </a>
        </div>


    </div>
    
</body>
</html>