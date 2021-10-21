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
    <title>Actualizar personal</title>
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
                <a href="actualizar_usuario.php"><img src="./assets/img/img_profile.jpg" alt=""></a>
            </div>
            <div class="container_cerrar_sesion">
                <a href="./php/scripts/sesion/cerrar-sesion.script.php"><i class="fas fa-user"> Cerrar sesion</i></a>
            </div>
        </div>
    </div>

    <div class="container_table">
            <?php
            require_once "./php/classes/conexion.class.php";
            require_once "./php/classes/persona.class.php";
            require_once "./php/codigos-mensajes.php";
            
            $personaClass = new Persona();
            $respuesta=$personaClass->PersonaExistente($_GET['id']);

            if($respuesta["estado"]){
                 $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                     foreach($resultados as $resultado){
                         ?>
                        <form action="./php/scripts/persona/actualizar-persona.script.php" method="POST">
                            <input type="hidden" class="input_text" name="id" value="<?php echo $resultado->idPersona;?>">  
                            <input type="text" class="input_text" name="cedula" value="<?php echo $resultado->cedulaPersona;?>">
                            <input type="text" class="input_text" name="nombre" value="<?php echo $resultado->nombresPersona;?>">
                            <input type="text" class="input_text" name="apellido" value="<?php echo $resultado->apellidosPersona;?>">
                            <input type="text" class="input_text" name="celular" value="<?php echo $resultado->celularPersona;?>">
                            <input type="email" class="input_text" name="correo" value="<?php echo $resultado->correoPersona;?>">
                            <input type="text" class="input_text" name="direccion" value="<?php echo $resultado->direccionPersona;?>">
                            <input list="especialidades" class="input_text" name="especialidad" placeholder="Especialidad"><br>
            
                            <datalist id="especialidades">
                            <?php

                                require_once "./php/classes/conexion.class.php";
                                require_once "./php/classes/especialidad.class.php";
                        
                                $especialidadClass = new Especialidad();
                            
                                $respuesta=$especialidadClass->ObtenerEspecialidades();
                            
                                if($respuesta["estado"]){
                                    $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                                        foreach($resultados as $resultado){
                                            if($resultado->nombreEspecialidad == "No existente"){
                                             continue;
                                            }
                            ?>
                                            <option value="<?php echo $resultado->nombreEspecialidad;?>"></option>
                            <?php                       
                                        }     
                                }

                            ?>
                            </datalist>
                            <input type="submit" value="Acualizar"></a></td>

                            </form>
                            <?php
                            }
                        
                            }else{
                                echo $codigosMensajes[$respuesta["respuesta"]];
                        
                            }

                            ?>
            
    </div>
</body>
</html>