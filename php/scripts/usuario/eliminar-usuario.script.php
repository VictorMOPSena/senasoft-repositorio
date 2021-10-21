<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = $_GET['id'];

    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->EliminarUsuario($idInput);
    $mensaje = $respuesta["respuesta"];
    header ("location: ../../../ver_usuarios.php?msn=$mensaje");

?>