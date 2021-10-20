<?php

    session_start();

    if(isset($_SESSION['idRolUsuarioSenasoft'])){
        if($_SESSION['idRolUsuarioSenasoft'] == 1){
            header ("location: index_jefe.php");
        }else{
            header ("location: index_empleados.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/interfaces/inicio_sesion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title>Inicio de sesion</title>
</head>
<body>
    <div class="container_principal">
        <div class="container_form">    
            <form action="./php/scripts/sesion/iniciar-sesion.script.php" method="POST">
                <h1>INICIO DE SESION</h1><br><br>
            <center>
                <i class="fas fa-user-circle"><input type="text" name="usuario" class="input_text" placeholder="Usuario"></i><br><br>
                <i class="fas fa-key"><input type="password" name="contraseña" class="input_text" placeholder="Contraseña"></i><br><br>
                <input type="submit" class="btn_input" value="Ingresar"><br><br>
            </center>
            </form> 
        </div>
    </div>
</body>
</html>