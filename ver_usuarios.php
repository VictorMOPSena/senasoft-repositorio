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
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/interfaces/ver_personal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title>Ver empleados</title>
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
                <a href=""><img src="./assets/img/img_profile.jpg" alt=""></a>
            </div>
            <div class="container_cerrar_sesion">
                <a href="./php/scripts/sesion/cerrar-sesion.script.php"><i class="fas fa-user"> Cerrar sesion</i></a>
            </div>
        </div>
    </div>

    <div class="container_table">
        <table class="tabla_ver_personas">
            <tr>
                <th>Empleado</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>

            <?php
            require_once "./php/classes/conexion.class.php";
            require_once "./php/classes/usuario.class.php";
            require_once "./php/codigos-mensajes.php";
            
            $personaClass = new Usuario();

            $respuesta=$personaClass->ObtenerUsuarios();

            if($respuesta["estado"]){
                 $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                     foreach($resultados as $resultado){
                         if($resultado->nombreUsuario == "No existente"){
                            continue;
                         }
                         ?>
                         <tr class="datos">
                             <td><?php echo $resultado->nombresPersona.' '.$resultado->apellidosPersona;?></td>
                             <td><?php echo $resultado->nombreUsuario;?></td>
                             <td><a href="./php/scripts/usuario/eliminar-usuario.script.php?id=<?php echo $resultado->idUsuario?>"><input type="submit" value="Eliminar" class="btn_input"></a></td>
                             <td><a href="actualizar_usuario.php?id=<?php echo $resultado->idPersona?>"><input type="submit" value="Actualizar" class="btn_input"></a></td>
                         </tr>
                         <?php                       
                     }
            
                 }else{
                     echo $codigosMensajes[$respuesta["respuesta"]];
                }

            ?>
        </table>

    </div>
</body>
</html>