<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../codigos-mensajes.php';

    session_start();
    $horario = $_POST['horario'];
    $fechaTurno = $_POST['fecha'];
    $idEspecialidad = $_SESSION["idEspecialidadUsuarioSenasoft"];
    

    // $fechaTurno = '2021-10-18';
    // $idEspecialidad = 5;
    // $horario = 2;


    $envio['estado'] = false;
    $envio['datos'] = [];

    $cronogramaClass = new Cronograma();
    $respuesta = $cronogramaClass->ObtenerEmpleadosTurno($fechaTurno, $idEspecialidad, $horario);

    if($respuesta["estado"]){
        $envio['estado'] = true;
        $aux = [];
        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            array_push($aux, $resultado->nombresPersona." ".$resultado->apellidosPersona);

        }

        array_push($envio['datos'], $aux);
    }


    // echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    // echo json_encode($codigosMensajes[$respuesta["respuesta"]]);
    echo json_encode($envio);

?>