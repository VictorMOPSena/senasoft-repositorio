<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

<<<<<<< HEAD
    $idInput = $_POST['id'];
    $cedulaInput = $_POST['cedula'];
    $nombresInput = $_POST['nombre'];
    $apellidosInput = $_POST['apellido'];
    $celularInput = $_POST['celular'];
    $correoInput =$_POST['correo'];
    $direccionInput = $_POST['direccion'];
=======
    $idInput = 1;
    $cedulaInput = "332";
    $nombresInput = "ssssssssss ssssssssss ssss";
    $apellidosInput = "ssssssssss ssssssss ssssssssss";
    $celularInput = "1111111111";
    $correoInput ="aaaaaaa12@gmail.com";
    $direccionInput = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
    $idEspecialidadInput = $_POST['especialidad'];
>>>>>>> 8d5f07a93ea2b7a5f1ce73e7603c2cc86e5e1e1c

    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->EspecialidadExistente("idEspecialidad", $idEspecialidadInput);
    if($respuesta["estado"]){
        $personaClass = new Persona();
        $respuesta = $personaClass->ActualizarPersona($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput);
    }

    
    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

?>