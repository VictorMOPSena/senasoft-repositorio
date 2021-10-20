<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = 1;
    $nombreInput = "Empleado";

    $rolClass = new Rol();
    $respuesta = $rolClass->ActualizarRol($idInput, $nombreInput);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

?>