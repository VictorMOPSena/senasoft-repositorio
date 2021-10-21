<?php


    session_start();

    if(isset($_SESSION['idRolUsuarioSenasoft'])){
        if($_SESSION['idRolUsuarioSenasoft'] != 1){
            header ("location: index.php");
        }
    }else{
        header ("location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/interfaces/index_jefe.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title>Index jefe</title>
</head>
<body>
    <div class="container_menu">
        <div class="container_img_logo">
            <img src="./assets/img/Logo.png" alt="">
        </div>
        <div class="container_perfil">
            <div class="container_name_user">
                Bienvenido <?php echo $_SESSION['nombreUsuarioSenasoft']?>
            </div>
            <div class="container_img_profile">
                <a href="actualizar_perfil.php"><img src="./assets/img/img_profile.jpg" alt=""></a>
            </div>
            <div class="container_cerrar_sesion">
                <a href="./php/scripts/sesion/cerrar-sesion.script.php"><i class="fas fa-user"> Cerrar sesion</i></a>
            </div>
        </div>
    </div>

    <div class="container_options">


        <div class="container_personal">
            <a href="ver_personal.php" >
            <div class="icono_turno">
                    <i class="fas fa-file-signature"></i>       
            </div>
            <div class="informacion_ver_personal">
                <h1>VER EMPELADOS CONTRATADOS</h1>
                <p>Podra seleccionar esta opcion para <br>
                    ver los empleados que actualmente <br>
                    se encuentran registrados  <br>
                    en la empresa.
                </p>
            </div>
            </a>
        </div>  

        <div class="container_ver_turnos">
            <a href="./tablas/tabla_estandar.php">
            <div class="icono_calendario">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="informacion_de_turnos">
                <h1>VER TURNOS DE LOS EMPLEADOS</h1>
                <p>Podra seleccionar esta opcion para <br>
                    ver los turnos de la semana <br>
                    de cada empleado por cada especialidad</p>
            </div>
            </a>
        </div>

        <div class="container_agregar_personal">
            <a href="agregar_personal.php">
            <div class="icono_agregar_personal">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="informacion_agregar_personal">
                <h1>AGREGAR PERSONAL</h1>
                <p>Podra agregar nuevo personal <br>
                en caso de que se  <br>
                contrate un nuevo empleado
            </div>
            </a>
        </div>

        <div class="container_crear_usuario">
            <a href="crear_usuario_admin.php">
            <div class="icono_crear_usuario">
                <i class="fas fa-users"></i>
            </div>
            <div class="informacion_crear_usuarios">
                <h1>Crear usuario administrador</h1>
                <p>Podra crear un usuario <br>
                para el ingreso de los  <br>
                jefes 
            </div>
            </a>
        </div>

        <div class="container_crear_usuario">
            <a href="crear_usuario_empleado.php">
            <div class="icono_crear_usuario">
                <i class="fas fa-users"></i>
            </div>
            <div class="informacion_crear_usuarios">
                <h1>Crear usuario empleado</h1>
                <p>Podra crear un usuario <br>
                para el ingreso de los  <br>
                distintos tipos de empleados
            </div>
            </a>
        </div>

        <div class="container_crear_usuario">
            <a href="ver_usuarios.php">
            <div class="icono_crear_usuario">
             <i class="fas fa-user-edit"></i>
            </div>
            <div class="informacion_crear_usuarios">
                <h1>Actualizar Usuarios Empleados</h1>
                <p>podra modificar la <br>
                informacion de aquiellos<br>
                usuarios que lo requiran
            </div>
            </a>
        </div>
        


    </div>
    
</body>
</html>