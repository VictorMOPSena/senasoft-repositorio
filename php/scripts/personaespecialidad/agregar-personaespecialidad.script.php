<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/personaespecialidad.class.php';
    require_once '../../codigos-mensajes.php';

    $idPersonaInput = 3;
    $idEspecialidadInput = 2;

    $personaClass = new Persona();
    $respuesta = $personaClass->PersonaExistente($idPersonaInput);
    if($respuesta["estado"]){

        $especialidadClass = new Especialidad();
        $respuesta = $especialidadClass->EspecialidadExistente("idEspecialidad", $idEspecialidadInput);
        if($respuesta["estado"]){

            $personaespecialidadClass = new PersonaEspecialidad();
            $respuesta = $personaespecialidadClass->AgregarPersonaEspecialidad($idPersonaInput, $idEspecialidadInput);

        }
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
  
?>