<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    session_start();
    // $fechaTurno = $_POST['fecha'];
    $fechaTurno = "2021-10-17";

    $cronogramaClass = new Cronograma();
    $respuesta = $cronogramaClass->ObtenerTurnosFecha($fechaTurno);
    print_r($respuesta['datos']);

    echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    // echo json_encode($codigosMensajes[$respuesta["respuesta"]]);
    // echo json_encode($fechaFinal);

?>