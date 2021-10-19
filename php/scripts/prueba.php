<?php

    require_once '../classes/conexion.class.php';
    require_once '../classes/empleado.class.php';
    require_once '../classes/rango.class.php';
    require_once "../codigos-mensajes.php";

    // $empleado = new Empleado();
    // $respuesta = $empleado->AgregarEmpleado("fsss","e","easd@g.com","aasa");
    // echo $codigosMensajes[$respuesta["respuesta"]];

    $rango = new Rango();
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


    $empleado = new Empleado();
    $respuesta = $empleado->ObtenerEmpleados();

    if($respuesta["estado"]){
        $resultados=$respuesta["respuesta"]->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $resultado){
            echo $resultado->idEmpleados." - ";
            echo $resultado->usuario." - ";
            echo $resultado->contra." - ";
            echo $resultado->correo." - ";
            echo $resultado->rango;
            echo "<br>";
        } 

    }else{
        echo $codigosMensajes[$respuesta["respuesta"]];

    }


    //SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='empleados';

?>