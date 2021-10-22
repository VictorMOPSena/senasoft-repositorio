<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    session_start();
    $idUsuarioInput = $_SESSION["idUsuarioSenasoft"];
    $diaInput= $_POST['dia'];
    $horarioInput= $_POST['horario'];
    $fechaTurno = $_POST['fecha'];
    $idEspecialidad = $_SESSION["idEspecialidadUsuarioSenasoft"];
    // $idUsuarioInput = 5;
    // $diaInput = 0;
    // $horarioInput= 1;
    // $fechaTurno = "2021-10-14";
    // $idEspecialidad = 5;



    $fechaSepara = explode("-", $fechaTurno);
    $mktimeFecha = mktime(0, 0, 0, date($fechaSepara[1]), date($fechaSepara[2]+$diaInput), date($fechaSepara[0]));
    $fechaFinal = date("Y-m-d", $mktimeFecha);


    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->UsuarioExistente("idUsuario",$idUsuarioInput);

    if($respuesta["estado"]){
        $respuesta = $usuarioClass->ObtenerNumeroUsuariosEmpleadosEspecialidad($idEspecialidad);
        $cronogramaClass = new Cronograma();
        $respuesta = $cronogramaClass->TomarTurno($idUsuarioInput, $horarioInput, $fechaFinal, $respuesta['cantidad'], $idEspecialidad);

    }

    // echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    echo json_encode($codigosMensajes[$respuesta["respuesta"]]);
    // echo json_encode($fechaFinal);

?>