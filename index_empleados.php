<?php

session_start();

if(isset($_SESSION['idRolUsuarioSenasoft'])){
    if($_SESSION['idRolUsuarioSenasoft'] != 2){
        header ("location: index.php");
    }
}else{
    header ("location: index.php");
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/tablas_turnos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title>Index empleados</title>
</head>
<body>
<div class="container_menu">
    <input id="idUsuario" type="hidden" value="<?php echo $_SESSION['idUsuarioSenasoft']?>">
        <div class="container_img_logo">
            <img src="./assets/img/Logo.png" alt="">
        </div>
        <div class="container_perfil">
            <div class="container_name_user">
                Bienvenido <?php echo $_SESSION['nombreUsuarioSenasoft']?>
            </div>
            <div class="container_img_profile">
                <img src="./assets/img/img_profile.jpg" alt="img_perfil">
            </div>
            <div class="container_cerrar_sesion">
                <a href="./php/scripts/sesion/cerrar-sesion.script.php"><i class="fas fa-user"> Cerrar sesion</i></a>
            </div>
        </div>
    </div>
    <center>
        <h1 id="h1FechaCronograma">Fecha</h1>
    </center>
    
    <input id="calendario" type="date">

    <div class="container_principal">
        <div class="container_tabla_turnos">
            <table class="tabla_turnos">
                <tr class="titulos_tabla">
                    <th>HORARIOS</th>
                    <th>DOMINGO</th>
                    <th>LUNES</th>
                    <th>MARTES</th>
                    <th>MIERCOLES</th>
                    <th>JUEVES</th>
                    <th>VIERNES</th>
                    <th>SABADO</th>
                </tr>

                <tr class="info_turnos">
                    <td>6:00</td>
                    <td><div dia="0" horario="1" class="turno_no_escogido"></td>
                    <td><div dia="1" horario="1" class="turno_no_escogido"></td>
                    <td><div dia="2" horario="1" class="turno_no_escogido"></td>
                    <td><div dia="3" horario="1" class="turno_no_escogido"></td>
                    <td><div dia="4" horario="1" class="turno_no_escogido"></td>
                    <td><div dia="5" horario="1" class="turno_no_escogido"></td>
                    <td><div dia="6" horario="1" class="turno_no_escogido"></td>
                </tr>

                <tr class="info_turnos">
                    <td>18:00</td>
                    <td><div dia="0" horario="2" class="turno_no_escogido"></td>
                    <td><div dia="1" horario="2" class="turno_no_escogido"></td>
                    <td><div dia="2" horario="2" class="turno_no_escogido"></td>
                    <td><div dia="3" horario="2" class="turno_no_escogido"></td>
                    <td><div dia="4" horario="2" class="turno_no_escogido"></td>
                    <td><div dia="5" horario="2" class="turno_no_escogido"></td>
                    <td><div dia="6" horario="2" class="turno_no_escogido"></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="ventana-emergente">
        <div class="empleados-boton">
            <div id="nombres-empleados">
                <p id="titulo_empleados">Empleados con este turno:</p>
            </div>
            <button id="boton-turno">Accion</button>
            <button id="boton-cerrar">Cerrar</button>
        </div>
    </div>
    <script src="./assets/js/escoger-turno.js"></script>
</body>
</html>