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
    <title>Document</title>
</head>
<body>

<div class="container_menu">
        <div class="container_img_logo">
            <img src="./assets/img/Logo.png" alt="">
        </div>
        <div class="container_perfil">
            <div class="container_name_user">
                nombre usuario
            </div>
            <div class="container_img_profile">
                <a href=""><img src="./assets/img/img_profile.jpg" alt=""></a>
            </div>
        </div>
    </div>

    <div class="container_principal">
        <div class="container_form">

        <form action="./php/scripts/usuario/agregar-usuario.script.php" method="POST" class="container_crear_usuario">
            <h1>CREAR NUEVO USUARIO</h1>
            <center>
            <input type="hidden" name="rol" value="2">
            <input type="text" class="input_text" name="usuario" placeholder="Crear Usuario"><br>
            <input type="text" class="input_text" name="contraseña" placeholder="Crear Contraseñas"><br>
            <input list="cedulas" class="input_text" name="documento" placeholder="Documentos"><br>
            <datalist id="cedulas">
                <?php
                 require_once "./php/classes/conexion.class.php";
                 require_once "./php/classes/persona.class.php";

                 $personaClass = new Persona();
                    
                    $respuesta=$personaClass->ObtenerPersonas();
                    
                    if($respuesta["estado"]){
                        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                            foreach($resultados as $resultado){
                ?>
                    <option value="<?php echo $resultado->cedulaPersona;?>"></option>
                <?php                       
                            }     
                    }        
                ?>
            </datalist>
            
    
            <input type="submit" class="btn_input" value="Crear">
            </center>
        </form>

        </div>
    </div>

</body>
</html>
