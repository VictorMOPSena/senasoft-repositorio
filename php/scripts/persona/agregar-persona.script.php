<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

    $cedulaInput = $_POST['cedula'];
    $nombresInput =$_POST['nombre'];
    $apellidosInput =$_POST['apellido'];
    $celularInput =$_POST['celular'];
    $correoInput = $_POST['correo'];
    $direccionInput =$_POST['direccion'];

    $personaClass = new Persona();
    $respuesta = $personaClass->AgregarPersona(1, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput);
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    
?>