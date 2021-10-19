<?php
    
    class Personal extends Conexion {

        private $idPersonal;
        private $usuarioPersonal;
        private $contraPersonal;
        private $cedulaPersonal;
        private $nombresPersonal;
        private $apellidosPersonal;
        private $celularPersonal;
        private $correoPersonal;
        private $idRolPersonal;

        private $usuarioPersonalMaxLength;
        private $contraPersonalMaxLength=20;
        private $cedulaPersonalMaxLength;
        private $nombresPersonalMaxLength;
        private $apellidosPersonalMaxLength;
        private $celularPersonalMaxLength;
        private $correoPersonalMaxLength;



        //Función para traer la longitud de caracteres de las columnas de la tabla "personal" desde la base de datos
        function CargarMaxLength(){
            $stmt = $this->Conectar()->prepare("SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='personal';");
            $stmt->execute();
            
            if($stmt->rowCount()>0){

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    if($resultado->columna=="usuarioPersonal"){
                        $usuarioPersonalMaxLength=$resultado->length;

                    }else if($resultado->columna=="cedulaPersonal"){
                        $cedulaPersonalMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="nombresPersonal"){
                        $nombresPersonalMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="apellidosPersonal"){
                        $apellidosPersonalMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="celularPersonal"){
                        $celularPersonalMaxLength=$resultado->length;
                    
                    }
                    else if($resultado->columna=="correoPersonal"){
                        $correoPersonalMaxLength=$resultado->length;
                    
                    }
                }
            }
        }



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idPersonal) &&!empty($this->usuarioPersonal) && !empty($this->contraPersonal) && !empty($this->cedulaPersonal) && !empty($this->nombresPersonal) && !empty($this->apellidosPersonal) && !empty($this->celularPersonal) && !empty($this->correoPersonal) && !empty($this->idRolPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdPersonal(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresUsuarioPersonal(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z0-9]*$/", $this->usuarioPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresCedulaPersonal(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->cedulaPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresNombresPersonal(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z]*$/", $this->nombresPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresApellidosPersonal(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z]*$/", $this->apellidosPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresCelularPersonal(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->celularPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdRolPersonal(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idRolPersonal)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Función para validar los caracteres del correo
        function ValidarCorreo(){
            $respuesta = false;
            if(filter_var($this->correoPersonal, FILTER_VALIDATE_EMAIL)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        

        //Funciones para validar la longitud de caracteres de los datos ingresados
        function ValidarLengthUsuarioPersonal(){
            $respuesta = false;
            if(strlen($this->usuarioPersonal)<=$usuarioPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthContraPersonal(){
            $respuesta = false;
            if(strlen($this->contraPersonal)<=$contraPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthCedulaPersonal(){
            $respuesta = false;
            if(strlen($this->cedulaPersonal)<=$cedulaPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthNombresPersonal(){
            $respuesta = false;
            if(strlen($this->nombresPersonal)<=$nombresPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthApellidosPersonal(){
            $respuesta = false;
            if(strlen($this->apellidosPersonal)<=$apellidosPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthCelularPersonal(){
            $respuesta = false;
            if(strlen($this->celularPersonal)<=$celularPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthCorreoPersonal(){
            $respuesta = false;
            if(strlen($this->correoPersonal)<=$correoPersonalMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }



        //Función que llama a todas las funciones para validar los datos
        function ValidarDatos(){
            $this->CargarMaxLength();

            $respuesta = ["estado"=>false, "respuesta"=>""];

            if (!$this->ValidarDatosVacios()){
                $respuesta["respuesta"] = "hcv";

            }else if(!$this->ValidarCaracteresIdPersonal()){
                $respuesta["respuesta"] = "isdcn";

            }else if(!$this->ValidarCaracteresUsuarioPersonal()){
                $respuesta["respuesta"] = "uspcnl";

            }else if(!$this->ValidarCaracteresCedulaPersonal()){
                $respuesta["respuesta"] = "cspcn";

            }else if(!$this->ValidarCaracteresNombresPersonal()){
                $respuesta["respuesta"] = "nspcl";

            }else if(!$this->ValidarCaracteresApellidosPersonal()){
                $respuesta["respuesta"] = "aspcl";

            }else if(!$this->ValidarCaracteresCelularPersonal()){
                $respuesta["respuesta"] = "ncspcn";

            }else if(!$this->ValidarCaracteresIdRolPersonal()){
                $respuesta["respuesta"] = "irspcn";

            }else if(!$this->ValidarCorreo()){
                $respuesta["respuesta"] = "cnv";

            }else if(!$this->ValidarLengthUsuarioPersonal()){
                $respuesta["respuesta"] = "usmc";

            }else if(!$this->ValidarLengthContraPersonal()){
                $respuesta["respuesta"] = "csmc";

            }else if(!$this->ValidarLengthCedulaPersonal()){
                $respuesta["respuesta"] = "";

            }else if(!$this->ValidarLengthNombresPersonal()){
                $respuesta["respuesta"] = "";

            }else if(!$this->ValidarLengthApellidosPersonal()){
                $respuesta["respuesta"] = "";

            }else if(!$this->ValidarLengthCelularPersonal()){
                $respuesta["respuesta"] = "";

            }else if(!$this->ValidarLengthCorreoPersonal()){
                $respuesta["respuesta"] = "";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }
      
    }

?>