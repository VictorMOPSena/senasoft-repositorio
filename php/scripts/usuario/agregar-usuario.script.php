<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $nombreInput = $_POST['usuario'];
    $contraInput =  $_POST['contraseña'];
    $cedulaPersonaInput = $_POST['documento'];
    $idRolInput = $_POST['rol'];

    // $nombreInput = "g";
    // $contraInput =  "a";
    // $cedulaPersonaInput = 7;
    // $idRolInput = 2;

    $rolClass = new Rol();
    $respuesta = $rolClass->RolExistente("idRol", $idRolInput);

    if($respuesta["estado"]){
        $personaClass = new Persona();
        $respuesta = $personaClass->CedulaExistente($cedulaPersonaInput);

        if($respuesta["estado"]){
            $idPersonaAux;
            $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
            foreach($resultados as $resultado){
                $idPersonaAux = $resultado->idPersona;
            }

            $usuarioClass = new Usuario();
            $respuesta = $usuarioClass->UsuarioExistente("idPersonaUsuario", $idPersonaAux);

            if(!$respuesta["estado"]){
                $respuesta = $usuarioClass->AgregarUsuario(1, $nombreInput, $contraInput, $idPersonaAux, $idRolInput);

            }else{
                $respuesta["respuesta"] = "yhucc";

            }
        }   
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

    
?>