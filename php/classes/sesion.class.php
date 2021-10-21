<?php

    class Sesion extends Conexion {

        private $idUsuarioSesion;
        private $nombreUsuarioSesion;
        private $idPersonaUsuarioSesion;
        private $idRolUsuarioSesion;
        private $idEspecialidadUsuarioSesion;


        //Función para validar que los campos no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idUsuarioSesion) && !empty($this->nombreUsuarioSesion) && !empty($this->idPersonaUsuarioSesion) && !empty($this->idRolUsuarioSesion) && !empty($this->idEspecialidadUsuarioSesion)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funcion para validar los caracteres de los datos
        function ValidarCaracteresIdUsuarioSesion(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idUsuarioSesion)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresNombreUsuarioSesion(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z0-9]*$/", $this->nombreUsuarioSesion)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdPersonaUsuarioSesion(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idPersonaUsuarioSesion)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdRolUsuarioSesion(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idRolUsuarioSesion)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdEspecialidadUsuarioSesion(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idEspecialidadUsuarioSesion)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Función que llama a todas las funciones para validar los datos
        function ValidarDatos(){
            $respuesta = ["estado"=>false, "respuesta"=>"nsvd"];

            if (!$this->ValidarDatosVacios()){
                $respuesta["respuesta"] = "hcv";

            }else if(!$this->ValidarCaracteresIdUsuarioSesion()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresNombreUsuarioSesion()){
                $respuesta["respuesta"] = "nuspcnl";

            }else if(!$this->ValidarCaracteresIdPersonaUsuarioSesion()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresIdRolUsuarioSesion()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresIdEspecialidadUsuarioSesion()){
                $respuesta["respuesta"] = "ispcn";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //Función para inicializaar los atributos de la clase
        function SetDatos($idUsuarioInput, $nombreUsuarioInput, $idPersonaUsarioInput, $idRolUsuarioInput, $idEspecialidadUsuarioInput){
            $this->idUsuarioSesion = $idUsuarioInput;
            $this->nombreUsuarioSesion = $nombreUsuarioInput;
            $this->idPersonaUsuarioSesion = $idPersonaUsarioInput; 
            $this->idRolUsuarioSesion = $idRolUsuarioInput;
            $this->idEspecialidadUsuarioSesion = $idEspecialidadUsuarioInput;
        }



        //Función para iniciar sesión
        function IniciarSesion($idUsuarioInput, $nombreUsuarioInput, $idPersonaUsarioInput, $idRolUsuarioInput, $idEspecialidadUsuarioInput){
            $this->SetDatos($idUsuarioInput, $nombreUsuarioInput, $idPersonaUsarioInput, $idRolUsuarioInput, $idEspecialidadUsuarioInput);

            $respuesta = ["estado"=>false, "respuesta"=>"nspis"];

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            session_start();
            $_SESSION["idUsuarioSenasoft"] = $this->idUsuarioSesion;
            $_SESSION["nombreUsuarioSenasoft"] = $this->nombreUsuarioSesion;
            $_SESSION["idPersonaUsuarioSenasoft"] = $this->idPersonaUsuarioSesion;
            $_SESSION["idRolUsuarioSenasoft"] = $this->idRolUsuarioSesion;
            $_SESSION["idEspecialidadUsuarioSenasoft"] = $this->idEspecialidadUsuarioSesion;

            $respuesta = ["estado"=>true, "respuesta"=>"sic"];
            return $respuesta;

        }



        //Función para cerrar sesión
        function CerrarSesion(){
            $respuesta = ["estado"=>false, "respuesta"=>"nspcs"];

            session_start();
            session_unset();
            session_destroy();

            $respuesta = ["estado"=>true, "respuesta"=>"scc"];
            return $respuesta;
        }


    }

?>