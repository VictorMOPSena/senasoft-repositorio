<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = 4;

    $cronogramaClass = new Cronograma();
    $respuesta = $cronogramaClass->EliminarUsuario($idInput);

    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->EliminarUsuario($idInput);
    echo $codigosMensajes[$respuesta["respuesta"]];

?>