<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../codigos-mensajes.php';

    $horarioInput=1;
    // $idUsuarioInput = $_SESSION["idUsuarioSenasoft"];
    $idUsuarioInput=1;
    

    session_start();
    $cronogramaClass = new Cronograma();
    $respuesta = $cronogramaClass->TomarTurno($horarioInput, $idUsuarioInput);


    
    



?>