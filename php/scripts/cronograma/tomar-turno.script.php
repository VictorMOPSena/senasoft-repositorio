<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    // $idUsuarioInput = $_SESSION["idUsuarioSenasoft"];
    // session_start();
    $idUsuarioInput=2;
    $horarioInput=1;
    $fechaTurno ="2021-10-24";


    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->UsuarioExistente("idUsuario",$idUsuarioInput);

    if($respuesta["estado"]){
        $respuesta = $usuarioClass->ObtenerNumeroUsuariosEmpleados();
        $cronogramaClass = new Cronograma();
        $respuesta = $cronogramaClass->TomarTurno($idUsuarioInput, $horarioInput, $fechaTurno, $respuesta['cantidad']);

    }

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";


    
    



?>