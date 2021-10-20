<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../classes/sesion.class.php';
    require_once '../../codigos-mensajes.php';

    $nombreUsuarioInput ="victorop";
    $contraUsuarioInput = "3";

    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->UsuarioExistente("nombreUsuario", $nombreUsuarioInput);

    if($respuesta["estado"]){
        $idUsuarioAux;
        $nombreUsuarioAux;
        $idPersonaUsarioAux;
        $idRolUsuarioAux;

        $contraUsuarioAux;

        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            $idUsuarioAux = $resultado->idUsuario;
            $nombreUsuarioAux = $resultado->nombreUsuario;
            $idPersonaUsarioAux = $resultado->idPersonaUsuario;
            $idRolUsuarioAux = $resultado->idRolUsuario;
            $contraUsuarioAux = $resultado->contraUsuario;
        }

        if(password_verify($contraUsuarioInput, $contraUsuarioAux)){
            $sesionClass = new Sesion();
            $respuesta = $sesionClass->IniciarSesion($idUsuarioAux, $nombreUsuarioAux, $idPersonaUsarioAux, $idRolUsuarioAux);

        }else{
            $respuesta["respuesta"] = "cunec";
        }
    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";

?>