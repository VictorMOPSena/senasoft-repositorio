<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/rol.class.php';
    require_once '../../classes/persona.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idUsuarioInput = $_POST['id'];
    $nombreInput = $_POST['usuario'];
    $contraInput = $_POST['contraseña'];
    $contraConfirmacionInput = $_POST['confirmacion'];
    $cedulaPersonaInput = $_POST['cedula'];
    $nombreRolInput = $_POST['rol'];

    // $idUsuarioInput = 5;
    // $nombreInput = "pedro";
    // $contraInput = "123";
    // $contraConfirmacionInput = "123";
    // $cedulaPersonaInput = "3214523126";
    // $nombreRolInput = "Administrador";


    $rolClass = new Rol();
    $respuesta = $rolClass->RolExistente("nombreRol", $nombreRolInput);
    if($respuesta["estado"]){
        $idRolInput;
        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            $idRolInput = $resultado->idRol;
        }
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
    }

    $mensaje = $respuesta["respuesta"];
    header("location: ../../../ver_usuarios.php?msm=$mensaje");
    // echo $codigosMensajes[$mensaje]."<br>";
    

?>