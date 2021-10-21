<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/sesion.class.php';
    require_once '../../codigos-mensajes.php';

    $sesionClass = new Sesion();
    $respuesta = $sesionClass->CerrarSesion();
    $mensaje=$respuesta["respuesta"];
    
   header ("Location: ../../../index.php?msn=$mensaje");

?>