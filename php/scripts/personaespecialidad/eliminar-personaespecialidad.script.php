<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/personaespecialidad.class.php';
    require_once '../../codigos-mensajes.php';

    $idPersonaInput = 3;
    $idEspecialidadInput = 11;

    $personaespecialidadClass = new PersonaEspecialidad();
    $respuesta = $personaespecialidadClass->EliminarPersonaEspecialidad($idPersonaInput, $idEspecialidadInput);
    echo $codigosMensajes[$respuesta["respuesta"]];

?>