<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idUsuarioInput = 12;
    $nombreInput = "victorop";
    $contraAntiguaInput = "2";
    $contraNuevaInput = "3";
    $cedulaPersonaInput = 1126458612;
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
            $respuesta = $usuarioClass->UsuarioExistente("idUsuario", $idUsuarioInput);
            if($respuesta["estado"]){
                $respuesta = $usuarioClass->UsuarioExistente("idPersonaUsuario", $idPersonaAux);

                if($respuesta["estado"]){
                    $idUsuarioConEsaPersona;
                    $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
                    foreach($resultados as $resultado){
                        $idUsuarioConEsaPersona = $resultado->idUsuario;
                    }
    
                    if($idUsuarioConEsaPersona==$idUsuarioInput){
                        $respuesta = $usuarioClass->ActualizarUsuario($idUsuarioInput, $nombreInput, $contraAntiguaInput, $contraNuevaInput, $idPersonaAux, $idRolInput);
    
                    }else{
                        $respuesta["respuesta"] = "yhucc";
                    }
                    
    
                }else{
                    $respuesta = $usuarioClass->ActualizarUsuario($idUsuarioInput, $nombreInput, $contraAntiguaInput, $contraNuevaInput, $idPersonaAux, $idRolInput);

                }
            }
        }   
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    

?>