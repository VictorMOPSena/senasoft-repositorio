<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idPersonaInput = $_GET['id'];

    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->UsuarioExistente("idPersonaUsuario",$idPersonaInput);

    if($respuesta["estado"]){
        $idUsuarioAux;
        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            $idUsuarioAux = $resultado->idUsuario;
        }
    
        $respuesta = $usuarioClass->EliminarUsuario($idUsuarioAux);
    }

    $personaClass = new Persona();
    $respuesta = $personaClass->EliminarPersona($idPersonaInput);
<<<<<<< HEAD
=======
    
    echo $codigosMensajes[$respuesta["respuesta"]];
>>>>>>> 5d042bc04edc41f3c8370d77cac767cbd6a68f31

    
?>