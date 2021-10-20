<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/especialidad.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = $_POST['id'];
    $cedulaInput = $_POST['cedula'];
    $nombresInput = $_POST['nombre'];
    $apellidosInput = $_POST['apellido'];
    $celularInput = $_POST['celular'];
    $correoInput =$_POST['correo'];
    $direccionInput = $_POST['direccion'];
    $especialidadInput = $_POST['especialidad'];

    $especialidadClass = new Especialidad();
    $respuesta = $especialidadClass->AgregarEspecialidad(1, $especialidadInput);
    $respuesta = $especialidadClass->EspecialidadExistente("nombreEspecialidad", $especialidadInput);
    
    if($respuesta["estado"]){
        $idEspecialidadInput;
        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            $idEspecialidadInput = $resultado->idEspecialidad;
        }

        $personaClass = new Persona();
        $respuesta = $personaClass->ActualizarPersona($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput);
        
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

?>