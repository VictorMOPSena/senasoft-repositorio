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
    <link rel="stylesheet" href="./assets/css/interfaces/agregar_usuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title>Crear Usuario</title>
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

    <div class="container_principal">
        <div class="container_form">

        <form action="./php/scripts/usuario/actualizar-usuario.script.php" method="POST" class="container_crear_usuario">
            <h1>ACTUALIZAR PERFIL</h1>
            <center>
        
            <input type="hidden" class="input_text" name="id" value="<?php echo  $_SESSION['idPersonaUsuarioSenasoft']?>"><br>
            <input type="text" class="input_text" name="usuario "placeholder="Nuevo usuario"><br>
            <input type="password" class="input_text" name="contraseña" placeholder="Contraseña contraseña"><br>
            <input type="password" class="input_text" name="confirmar" placeholder="Confirmar contraseña"><br>
            <input type="submit" class="btn_input" value="Actualizar">

            </center>
            
        </form>

        </div>
    </div>

</body>
</html>