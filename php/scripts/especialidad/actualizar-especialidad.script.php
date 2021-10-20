<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = 1;
    $nombreInput = "Pediatra";

    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->ActualizarEspecialidad($idInput, $nombreInput);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

?>