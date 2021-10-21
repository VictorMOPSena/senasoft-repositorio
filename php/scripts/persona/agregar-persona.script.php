<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

    $cedulaInput = $_POST['cedula'];
    $nombresInput =$_POST['nombre'];
    $apellidosInput =$_POST['apellido'];
    $celularInput =$_POST['celular'];
    $correoInput = $_POST['correo'];
    $direccionInput =$_POST['direccion'];
    $especialidadInput = $_POST['especialidad'];

    // $cedulaInput = 7;
    // $nombresInput = "a";
    // $apellidosInput = "a";
    // $celularInput = "1";
    // $correoInput = "a@gmail.com";
    // $direccionInput = "a";
    // $especialidadInput = "Doctor";


    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->AgregarEspecialidad(1, $especialidadInput);
    $respuesta = $especialidadClass->EspecialidadExistente("nombreEspecialidad", $especialidadInput);
    $idEspecialidadInput;

    if($respuesta["estado"]){
        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            $idEspecialidadInput = $resultado->idEspecialidad;
        }

        $personaClass = new Persona();
        $respuesta = $personaClass->AgregarPersona(1, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput);
        
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

    
?>