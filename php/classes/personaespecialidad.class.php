<?php
    
    class PersonaEspecialidad extends Conexion {

        private $idPersonaPE;
        private $idEspecialidadPE;



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idPersonaPE) && !empty($this->idEspecialidadPE)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdPersonaPE(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idPersonaPE)) {
                $respuesta = true;
            }
            return $respuesta;
        } 

        function ValidarCaracteresIdEspecialidadPE(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idEspecialidadPE)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Función que llama a todas las funciones para validar los datos
        function ValidarDatos(){
            $respuesta = ["estado"=>false, "respuesta"=>"nsvd"];

            if (!$this->ValidarDatosVacios()){
                $respuesta["respuesta"] = "hcv";

            }else if(!$this->ValidarCaracteresIdPersonaPE()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresIdEspecialidadPE()){
                $respuesta["respuesta"] = "ispcn";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //Función para inicializar los atributos de la clase
        function SetDatos($idPersonaInput, $idEspecialidadInput){
            $this->idPersonaPE = $idPersonaInput;
            $this->idEspecialidadPE = $idEspecialidadInput;
        }



        //Función para obtener las especialidades de una persona
        function ObtenerEspecialidades($idPersonaInput){
            $this->idPersonaPE = $idPersonaInput;

            $respuesta = ["estado"=>false, "respuesta"=>"nee"];

            if(!$this->ValidarCaracteresIdPersonaPE()){
                $respuesta["respuesta"] = "ispcn";
                return $respuesta;
            };


            $stmt = $this->Conectar()->prepare("SELECT * FROM personaespecialidad WHERE idPersonaPE=?");

            if(!$stmt->execute(array($this->idPersonaPE))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ee";
                $respuesta["stmt"] = $stmt; 
            }

            return $respuesta;
        }



        //Función para verificar si una persona tiene una especialidad en especifico
        function VerificarEspecialidad($idPersonaInput, $idEspecialidadInput){
            $this->SetDatos($idPersonaInput, $idEspecialidadInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = ["estado"=>false, "respuesta"=>"ene"];

            $stmt = $this->Conectar()->prepare("SELECT * FROM personaespecialidad WHERE idPersonaPE=? AND idEspecialidadPE=?");

            if(!$stmt->execute(array($this->idPersonaPE, $this->idEspecialidadPE))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ese";
                $respuesta["stmt"] = $stmt;
            }

            return $respuesta;
        }



        //Función para agregar una especialidad a una persona
        function AgregarPersonaEspecialidad($idPersonaInput, $idEspecialidadInput){
            $this->SetDatos($idPersonaInput, $idEspecialidadInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->VerificarEspecialidad($this->idPersonaPE,$this->idEspecialidadPE);
            if($respuesta["estado"]){
                $respuesta["respuesta"] = "ese";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("INSERT INTO personaespecialidad (idPersonaPE, idEspecialidadPE) VALUES(?,?)");
            if(!$stmt->execute(array($this->idPersonaPE, $this->idEspecialidadPE))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "eac";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para actualizar una especialidad
        function ActualizarPersonaEspecialidad($idPersonaInput, $idEspecialidadInput){
            $this->SetDatos($idPersonaInput, $idEspecialidadInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->VerificarEspecialidad($this->idPersonaPE,$this->idEspecialidadPE);
            if($respuesta["estado"]){
                $respuesta["respuesta"] = "ese";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("UPDATE personaespecialidad SET idEspecialidadPE=? WHERE idPersonaPE=?");
            if(!$stmt->execute(array($this->idEspecialidadPE, $this->idPersonaPE))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            $respuesta["estado"] = true;
            $respuesta["respuesta"] = "eacc";

            $stmt = null;
            return $respuesta;
        }



        //Función para eliminar una especialidad
        function EliminarPersonaEspecialidad($idPersonaInput, $idEspecialidadInput){

            $respuesta = ["estado"=>false, "respuesta"=>"enel"];

            $stmt = $this->Conectar()->prepare("DELETE FROM personaespecialidad WHERE idPersonaPE=? AND idEspecialidadPE=?");
            if(!$stmt->execute(array($idPersonaInput, $idEspecialidadInput))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "eelc";
            }else{
                $respuesta["respuesta"] = "ene";
            }

            $stmt = null;
            return $respuesta;
    
        }



    }

?>