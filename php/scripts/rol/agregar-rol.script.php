<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../codigos-mensajes.php';

    $nombreInput = "Administradsor";

    $rolClass = new Rol();
    $respuesta = $rolClass->AgregarRol(1, $nombreInput);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    
?>