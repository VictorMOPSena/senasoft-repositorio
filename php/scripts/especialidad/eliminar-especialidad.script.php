<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = 1;

    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->EliminarEspecialidad($idInput);
    echo $codigosMensajes[$respuesta["respuesta"]];

?>