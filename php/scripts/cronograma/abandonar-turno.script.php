<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    session_start();
    $idUsuarioInput = $_SESSION["idUsuarioSenasoft"];
    $horarioInput= $_POST['horario'];
    $fechaTurno = $_POST['fecha'];


    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->UsuarioExistente("idUsuario",$idUsuarioInput);

    if($respuesta["estado"]){
        $cronogramaClass = new Cronograma();
        $respuesta = $cronogramaClass->AbandonarTurno($idUsuarioInput, $horarioInput, $fechaTurno);

    }

    echo json_encode($codigosMensajes[$respuesta["respuesta"]]);

?>