<?php

    require_once '../../classes/conexion.class.php';
    require_once '../../classes/cronograma.class.php';
    require_once '../../classes/usuario.class.php';
    require_once '../../codigos-mensajes.php';

    $idInput = $_GET['id'];

    $cronogramaClass = new Cronograma();
    $respuesta = $cronogramaClass->SetUsuarioNoExistente($idInput);

    if($respuesta['estado']){
        $usuarioClass = new Usuario();
        $respuesta = $usuarioClass->EliminarUsuario($idInput);
        
    }

    $mensaje = $respuesta["respuesta"];
    
    echo '<script type="text/javascript">
    alert(El usuario se elimino correctamente");
    window.location.href="../../../ver_usuarios.php?msn' .$mensaje.'";
    </script>';

?>