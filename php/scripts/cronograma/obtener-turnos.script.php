<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    session_start();
    $fechaTurno = $_POST['fecha'];
    $idEspecialidad = $_SESSION["idEspecialidadUsuarioSenasoft"];

    $envio['estado'] = false;
    $envio['datos'] = [];

    $usuarioClass = new Usuario();
    $respuesta = $usuarioClass->ObtenerNumeroUsuariosEmpleadosEspecialidad($idEspecialidad);

    $envio['cantidadEmpleados']=$respuesta['cantidad'];

    $cronogramaClass = new Cronograma();
    $respuesta = $cronogramaClass->ObtenerTurnosFecha($fechaTurno, $idEspecialidad);

    if($respuesta["estado"]){
        $envio['estado'] = true;
        $aux = [];
        $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            array_push($aux, $resultado->idUsuarioCronogramaActual);
            array_push($aux, $resultado->horarioCronogramaActual);
            array_push($aux, $resultado->fechaCronogramaActual);
            array_push($envio['datos'], $aux);
            $aux = [];
        }
        
    }
    

    // echo $codigosMensajes[$respuesta["respuesta"]]."<br>";
    // echo json_encode($codigosMensajes[$respuesta["respuesta"]]);
    echo json_encode($envio);

?>