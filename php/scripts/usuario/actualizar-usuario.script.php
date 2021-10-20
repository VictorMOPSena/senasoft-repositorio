<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idUsuarioInput = 4;
    $nombreInput = "usuario1w4442";
    $contraInput = "12ww3";
    $cedulaPersonaInput = 3;
    $idRolInput = 1;


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
            $respuesta = $usuarioClass->ActualizarUsuario($idUsuarioInput, $nombreInput, $contraInput, $idPersonaAux, $idRolInput);
            
        }   
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    

?>