<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Persona</title>
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

    <div class="container_form">
        <form action="./php/scripts/persona/agregar-persona.script.php" method="POST">
            <input type="text" name="cedula" placeholder="Documento">
            <input type="text" name="nombre" placeholder="Nombres">
            <input type="text" name="apellido" placeholder="Apllidos">
            <input type="text" name="celular" placeholder="Celular">
            <input type="email" name="correo" placeholder="Correo Electronico">
            <input type="text" name="direccion" placeholder="Direcion">
            <input list="especialidades" name="especialidad" placeholder="Especialidad">
            
            <datalist id="especialidades">
                <?php

                    require_once "./php/classes/conexion.class.php";
                    require_once "./php/classes/especialidad.class.php";
                
                    $especialidadClass = new Especialidad();
                    
                    $respuesta=$especialidadClass->ObtenerEspecialidades();
                    
                    if($respuesta["estado"]){
                        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                            foreach($resultados as $resultado){
                ?>
                                    <option value="<?php echo $resultado->nombreEspecialidad;?>"></option>
                <?php                       
                            }     
                    }

                ?>
            </datalist>
            <input type="submit" value="Agregar personal">
        </form>
    </div>
</body>
</html>