<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = 1;
    $cedulaInput = "332";
    $nombresInput = "ssssssssss ssssssssss ssss";
    $apellidosInput = "ssssssssss ssssssss ssssssssss";
    $celularInput = "1111111111";
    $correoInput ="aaaaaaa12@gmail.com";
    $direccionInput = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
    $idEspecialidadInput = $_POST['especialidad'];

    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->EspecialidadExistente("idEspecialidad", $idEspecialidadInput);
    if($respuesta["estado"]){
        $personaClass = new Persona();
        $respuesta = $personaClass->ActualizarPersona($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput);
    }

    
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

?>