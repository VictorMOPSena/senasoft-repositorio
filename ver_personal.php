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
        <table class="tabla_ver_personas">
            <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Correo Electronico</th>
                <th>Direccion</th>
            </tr>

            <?php
            require_once "./php/classes/conexion.class.php";
            require_once "./php/classes/persona.class.php";
            require_once "./php/codigos-mensajes.php";

            $personaClass = new Persona();

            $respuesta=$personaClass->PersonaExistente(1);

            if($respuesta["estado"]){
                 $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                     foreach($resultados as $resultado){
                         ?>
                         <tr>
                             <td><?php echo $resultado->idPersona;?></td>
                             <td><?php echo $resultado->cedulaPersona;?></td>
                             <td><?php echo $resultado->nombresPersona;?></td>
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