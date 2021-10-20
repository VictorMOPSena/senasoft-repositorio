<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Ver empleados</title>
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
                            <input type="hidden" name="id" value="<?php echo $resultado->idPersona;?>">  
                            <input type="text" name="cedula" value="<?php echo $resultado->cedulaPersona;?>">
                            <input type="text" name="nombre" value="<?php echo $resultado->nombresPersona;?>">
                            <input type="text" name="apellido" value="<?php echo $resultado->apellidosPersona;?>">
                            <input type="text" name="celular" value="<?php echo $resultado->celularPersona;?>">
                            <input type="email" name="correo" value="<?php echo $resultado->correoPersona;?>">
                            <input type="text" name="direccion" value="<?php echo $resultado->direccionPersona;?>">
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