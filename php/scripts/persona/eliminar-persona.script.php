<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/empleado.class.php';
    require_once '../../codigos-mensajes.php';

    $id = "3";

    $empleadoClass = new Empleado();
    $respuesta = $empleadoClass->EliminarEmpleado($id);
    echo $codigosMensajes[$respuesta["respuesta"]];


?>