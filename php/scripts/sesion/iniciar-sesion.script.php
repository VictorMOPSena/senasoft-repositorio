<?php



    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];

    require_once '../conexion.php';
    $conexion = EstablecerConexion($usuario, $contra, true);
    require_once './funciones-login-script.php';

    $datos = UsuarioExistente($conexion, $usuario);

    if($datos){
        if(password_verify($contra, $datos['contra'])){
            session_start();
            $_SESSION["idUsuarioSenasoft"] = $datos['id'];
            $_SESSION["nombreUsuarioSenasoft"] = $datos['usuario'];
            $_SESSION["contraUsuarioSenasoft"] = $contra;
            $_SESSION["rolUsuarioSenasoft"] = $datos['rango'];
            $_SESSION["nombreServitecnicosdelcamposasAdministrar"] = $datos['nombre'];

            header("location: ../../interfaz-general.php");
            exit();
        }else{
            header("location: ../../index.php?error=contra");
            exit();
        }
    }else{
        header("location: ../../index.php?error=usuario");
        exit();
    }

?>