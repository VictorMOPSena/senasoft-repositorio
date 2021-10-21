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
    <title>Actualizar Usuario</title>
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
                <img src="./assets/img/img_profile.jpg" alt="img_perfil">
            </div>
            <div class="container_cerrar_sesion">
                <a href="./php/scripts/sesion/cerrar-sesion.script.php"><i class="fas fa-user"> Cerrar sesion</i></a>
            </div>
            <div class="container_regresar">
                <a href="ver_usuarios.php"><i class="fas fa-undo-alt"> Regresar</i></a>
            </div>
        </div>
    </div>

    <div class="container_principal">
        <div class="container_form">

        <form action="./php/scripts/usuario/actualizar-usuario.script.php" method="POST" class="container_crear_usuario">
            <h1>ACTUALIZAR USUARIO</h1>
            <center>
        
            <input type="hidden" class="input_text" name="id" value="<?php echo $_SESSION['idUsuarioSenasoft']?>"><br>
            <input type="text" class="input_text" name="usuario" placeholder="Nuevo usuario"><br>
            <input type="password" class="input_text" name="contraseña" placeholder="Contraseña contraseña"><br>
            <input type="password" class="input_text" name="confirmacion" placeholder="Confirmar contraseña"><br>
            <input type="text" class="input_text" name="cedula" value="<?php echo  $_GET['cedula']?>" placeholder="Cedula"><br>
            <input list="roles" class="input_text" name="rol" placeholder="rol"><br>
            
            <datalist id="roles">
                <?php

                    require_once "./php/classes/conexion.class.php";
                    require_once "./php/classes/rol.class.php";
                
                    $especialidadClass = new Rol();
                    
                    $respuesta=$especialidadClass->ObtenerRoles();
                    
                    if($respuesta["estado"]){
                        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                            foreach($resultados as $resultado){
                                if($resultado->nombreRol == "No existente"){
                                    continue;
                                 }
                ?>
                                    <option value="<?php echo $resultado->nombreRol;?>"></option>
                <?php                       
                            }     
                    }

                ?>
            </datalist>
            <input type="submit" class="btn_input" value="Actualizar">

            </center>
            
        </form>

        </div>
    </div>

</body>
</html>
