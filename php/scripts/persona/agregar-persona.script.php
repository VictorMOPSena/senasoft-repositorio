<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

    $cedulaInput = "1111111112";
    $nombresInput = "ssssssssss ssssssssss ssss";
    $apellidosInput = "ssssssssss ssssssss ssssssssss";
    $celularInput = "1111111111";
    $correoInput ="aaaaaaa12@gmail.com";
    $direccionInput = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

    $personaClass = new Persona();
    $respuesta = $personaClass->AgregarPersona(1, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    
?>