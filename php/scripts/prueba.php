<?php

    require_once '../classes/conexion.class.php';
    require_once '../classes/persona.class.php';
    require_once "../codigos-mensajes.php";


    $fecha = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $tomorrow  = date("d-M-Y", $fecha)."-".date("l", $fecha);
    echo $tomorrow;

    "select Date,TotalAllowance from Calculation where EmployeeId=1 and Date >= '2011/02/25' and Date < '2011/02/28'";

    // $empleado = new Empleado();
    // $respuesta = $empleado->AgregarEmpleado("fsss","e","easd@g.com","aasa");
    // echo $codigosMensajes[$respuesta["respuesta"]];

    // $rango = new Rango();
    // $respuesta = $rango->AgregarRango("aasd");
    // echo $codigosMensajes[$respuesta["respuesta"]];


    // $respuesta = $rango->ObtenerRangos();

    // if($respuesta["estado"]){
    //     $resultados=$respuesta["respuesta"]->fetchAll(PDO::FETCH_OBJ);
    //     foreach($resultados as $resultado){
    //         echo $resultado->id." - ";
    //         echo $resultado->rango;
    //         echo "<br>";
    //     }

    // }else{
    //     echo $codigosMensajes[$respuesta["respuesta"]];

    // }


    // $personaClass = new Persona();
    // $respuesta = $personaClass->CedulaExistente(1126458612);

    // if($respuesta["estado"]){
    // $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
    // foreach($resultados as $resultado){
    //     echo $resultado->idPersona." - ";
    //     echo $resultado->cedulaPersona." - ";
    //     echo $resultado->nombresPersona." - ";
    //     echo $resultado->apellidosPersona." - ";
    //     echo $resultado->celularPersona." - ";
    //     echo $resultado->correoPersona." - ";
    //     echo $resultado->direccionPersona." - ";
    //     echo $resultado->idEspecialidadPersona." - ";
    //     echo $resultado->nombreEspecialidad." - ";
    //     echo "<br>";

    // }}else{
    //     echo $codigosMensajes[$respuesta["respuesta"]];
    
    // }

    // if($respuesta["estado"]){
    //     $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
    //     foreach($resultados as $resultado){
    //         echo $resultado->idPersona." - ";
    //         echo $resultado->cedulaPersona." - ";
    //         echo $resultado->nombresPersona." - ";
    //         echo $resultado->apellidosPersona." - ";
    //         echo $resultado->celularPersona." - ";
    //         echo $resultado->correoPersona." - ";
    //         echo $resultado->direccionPersona." - ";
    //         echo $resultado->idEspecialidadPersona." - ";
    //         echo $resultado->nombreEspecialidad." - ";
    //         echo "<br>";
    //     } 

    // }else{
    //     echo $codigosMensajes[$respuesta["respuesta"]];

    // }


    //SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='empleados';

?>