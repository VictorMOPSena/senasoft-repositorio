<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/empleado.class.php';
    require_once '../../classes/rango.class.php';
    require_once '../../codigos-mensajes.php';

    $id = "3";
    $usuario = "4433";
    $contraAntigua = "1";
    $contraNueva = "1";
    $correo = "aasd@gma.com";
    $rango = "Funcionario";

    $rangoClass = new Rango();
    $respuesta = $rangoClass->AgregarRango(1, $rango);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

    if($respuesta['estado'] || $respuesta["respuesta"]=="re"){
        $empleadoClass = new Empleado();
        $respuesta = $empleadoClass->ActualizarEmpleado($id, $usuario, $contraAntigua, $contraNueva, $correo, $respuesta["id"]);
        echo $codigosMensajes[$respuesta["respuesta"]];
    
    }

?>