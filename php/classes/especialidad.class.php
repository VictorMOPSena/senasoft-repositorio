<?php
    
    class Especialidad extends Conexion {

        private $idEspecialidad;
        private $nombreEspecialidad;

        private $nombreEspecialidadMaxLength;



        //Función para traer la longitud de caracteres de las columnas de la tabla "personal" desde la base de datos
        function CargarMaxLength(){
            $stmt = $this->Conectar()->prepare("SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='especialidad';");
            $stmt->execute();
            
            if($stmt->rowCount()>0){
                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    if($resultado->columna=="nombreEspecialidad"){
                        $this->nombreEspecialidadMaxLength=$resultado->length;
                    
                    }
                }
            }
        }



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idEspecialidad) && !empty($this->nombreEspecialidad)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdEspecialidad(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idEspecialidad)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresNombreEspecialidad(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z]*$/", $this->nombreEspecialidad)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funcion para validar la longitud de caracteres de los datos ingresados
        function ValidarLengthNombreEspecialidad(){
            $respuesta = false;
            if(strlen($this->nombreEspecialidad)<=$this->nombreEspecialidadMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }


        //Función que llama a todas las funciones para validar los datos
        function ValidarDatos(){
            $this->CargarMaxLength();

            $respuesta = ["estado"=>false, "respuesta"=>"nsvd"];

            if (!$this->ValidarDatosVacios()){
                $respuesta["respuesta"] = "hcv";

            }else if(!$this->ValidarCaracteresIdEspecialidad()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresNombreEspecialidad()){
                $respuesta["respuesta"] = "nespcl";

            }else if(!$this->ValidarLengthNombreEspecialidad()){
                $respuesta["respuesta"] = "nesmc";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //Función para inicializar los atributos de la clase
        function SetDatos($idInput, $nombreInput){
            $this->idEspecialidad = $idInput;
            $this->nombreEspecialidad = $nombreInput;
        }



        //Funcion para Obtener las especialidades
        function ObtenerEspecialidades(){
            $stmt = $this->Conectar()->prepare("SELECT * FROM especialidad");
            $stmt->execute();
            
            $respuesta = ["estado"=>false, "respuesta"=>"nee"];
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ee";
                $respuesta["stmt"] = $stmt; 
            }

            return $respuesta;
        }



        //Función para verificar si una especialidad existe, y si existe, trae los datos de la especialidad
        function EspecialidadExistente($columna, $valor){
            $respuesta = ["estado"=>false, "respuesta"=>"ene"];

            if(!$this->ValidarCaracteresIdEspecialidad()){
                $respuesta["respuesta"] = "ispcn";
                return $respuesta;
            };


            $stmt = $this->Conectar()->prepare("SELECT * FROM especialidad WHERE $columna=?");

            if(!$stmt->execute(array($valor))){
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


        //Función para agregar una especialidad
        function AgregarEspecialidad($idInput, $nombreInput){
            $this->SetDatos($idInput, $nombreInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->EspecialidadExistente("nombreEspecialidad", $nombreInput);
            if($respuesta["estado"]){
                $respuesta["respuesta"] = "ese";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("INSERT INTO especialidad (nombreEspecialidad) VALUES(?)");
            if(!$stmt->execute(array($this->nombreEspecialidad))){
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
        function ActualizarEspecialidad($idInput, $nombreInput){
            $this->SetDatos($idInput, $nombreInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->EspecialidadExistente($this->idEspecialidad);
            if(!$respuesta["estado"]){
                $respuesta["respuesta"] = "ene";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("UPDATE especialidad SET nombreEspecialidad=? WHERE idEspecialidad=?");
            if(!$stmt->execute(array($this->nombreEspecialidad, $this->idEspecialidad))){
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
        function EliminarEspecialidad($idInput){

            $respuesta = ["estado"=>false, "respuesta"=>"enel"];

            $stmt = $this->Conectar()->prepare("DELETE FROM especialidad WHERE idEspecialidad=?");
            if(!$stmt->execute(array($idInput))){
                if($stmt->errorInfo()[1]==1451){
                    $stmt = null;
                    $respuesta["respuesta"] = "eseup";
                    return $respuesta;
                }else{
                    $stmt = null;
                    $respuesta["respuesta"] = "estmt";
                    return $respuesta;

                }
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