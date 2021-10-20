<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../codigos-mensajes.php';

    $nombreInput = "Doctor";

    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->AgregarEspecialidad(1, $nombreInput);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    
?>