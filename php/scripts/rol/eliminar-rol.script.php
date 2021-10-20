<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = 1;

    $rolClass = new Rol();
    $respuesta = $rolClass->EliminarRol($idInput);
    echo $codigosMensajes[$respuesta["respuesta"]];

?>