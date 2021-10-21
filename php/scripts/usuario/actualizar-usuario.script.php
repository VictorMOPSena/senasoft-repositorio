<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    // $idUsuarioInput = $_POST['id'];
    // $nombreInput = $_POST['usuario'];
    // $contraInput = $_POST['contraseña'];
    // $contraConfirmacionInput = $_POST['confirmacion'];
    // $cedulaPersonaInput = $_POST['cedula'];
    // $idRolInput = $_POST['rol'];

    $idUsuarioInput = 2;
    $nombreInput = $_POST['usuario'];
    $contraInput = $_POST['contraseña'];
    $contraConfirmacionInput = $_POST['confirmacion'];
    $cedulaPersonaInput = $_POST['cedula'];
    idRolInput = $_POST['rol'];


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
                        $respuesta = $usuarioClass->ActualizarUsuario($idUsuarioInput, $nombreInput, $contraInput, $contraConfirmacionInput, $idPersonaAux, $idRolInput);
    
                    }else{
                        $respuesta["respuesta"] = "yhucc";
                    }
                    
    
                }else{
                    $respuesta = $usuarioClass->ActualizarUsuario($idUsuarioInput, $nombreInput, $contraInput, $contraConfirmacionInput, $idPersonaAux, $idRolInput);

                }
            }
        }   
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    

?>