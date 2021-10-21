<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = $_GET['id'];

    $personaClass = new Persona();
    $respuesta = $personaClass->EliminarPersona($idInput);
    echo $codigosMensajes[$respuesta["respuesta"]];

?>