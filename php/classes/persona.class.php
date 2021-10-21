<?php
    
    class Persona extends Conexion {

        private $idPersona;
        private $cedulaPersona;
        private $nombresPersona;
        private $apellidosPersona;
        private $celularPersona;
        private $correoPersona;
        private $direccionPersona;
        private $idEspecialidadPersona;

        private $cedulaPersonaMaxLength;
        private $nombresPersonaMaxLength;
        private $apellidosPersonaMaxLength;
        private $celularPersonaMaxLength;
        private $correoPersonaMaxLength;
        private $direccionPersonaMaxLength;



        //Función para traer la longitud de caracteres de las columnas de la tabla "personal" desde la base de datos
        function CargarMaxLength(){
            $stmt = $this->Conectar()->prepare("SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='persona';");
            $stmt->execute();
            
            if($stmt->rowCount()>0){

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    if($resultado->columna=="cedulaPersona"){
                        $this->cedulaPersonaMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="nombresPersona"){
                        $this->nombresPersonaMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="apellidosPersona"){
                        $this->apellidosPersonaMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="celularPersona"){
                        $this->celularPersonaMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="correoPersona"){
                        $this->correoPersonaMaxLength=$resultado->length;
                    
                    }else if($resultado->columna=="direccionPersona"){
                        $this->direccionPersonaMaxLength=$resultado->length;
                    
                    }
                }
            }
        }



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idPersona) && !empty($this->cedulaPersona) && !empty($this->nombresPersona) && !empty($this->apellidosPersona) && !empty($this->celularPersona) && !empty($this->correoPersona) && !empty($this->direccionPersona) && !empty($this->idEspecialidadPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdPersona(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresCedulaPersona(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->cedulaPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresNombresPersona(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z ]*$/", $this->nombresPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresApellidosPersona(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z ]*$/", $this->apellidosPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresCelularPersona(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->celularPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdEspecialidadPersona(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idEspecialidadPersona)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Función para validar los caracteres del correo
        function ValidarCorreo(){
            $respuesta = false;
            if(filter_var($this->correoPersona, FILTER_VALIDATE_EMAIL)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        

        //Funciones para validar la longitud de caracteres de los datos ingresados
        function ValidarLengthCedulaPersona(){
            $respuesta = false;
            if(strlen($this->cedulaPersona)<=$this->cedulaPersonaMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthNombresPersona(){
            $respuesta = false;
            if(strlen($this->nombresPersona)<=$this->nombresPersonaMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthApellidosPersona(){
            $respuesta = false;
            if(strlen($this->apellidosPersona)<=$this->apellidosPersonaMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthCelularPersona(){
            $respuesta = false;
            if(strlen($this->celularPersona)<=$this->celularPersonaMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthCorreoPersona(){
            $respuesta = false;
            if(strlen($this->correoPersona)<=$this->correoPersonaMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthDireccionPersona(){
            $respuesta = false;
            if(strlen($this->direccionPersona)<=$this->direccionPersonaMaxLength){
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

            }else if(!$this->ValidarCaracteresIdPersona()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresCedulaPersona()){
                $respuesta["respuesta"] = "cspcn";

            }else if(!$this->ValidarCaracteresNombresPersona()){
                $respuesta["respuesta"] = "nspcl";

            }else if(!$this->ValidarCaracteresApellidosPersona()){
                $respuesta["respuesta"] = "aspcl";

            }else if(!$this->ValidarCaracteresCelularPersona()){
                $respuesta["respuesta"] = "ncspcn";

            }else if(!$this->ValidarCaracteresIdEspecialidadPersona()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCorreo()){
                $respuesta["respuesta"] = "cnv";

            }else if(!$this->ValidarLengthCedulaPersona()){
                $respuesta["respuesta"] = "cesmc";

            }else if(!$this->ValidarLengthNombresPersona()){
                $respuesta["respuesta"] = "nsmc";

            }else if(!$this->ValidarLengthApellidosPersona()){
                $respuesta["respuesta"] = "asmc";

            }else if(!$this->ValidarLengthCelularPersona()){
                $respuesta["respuesta"] = "ncsmc";

            }else if(!$this->ValidarLengthCorreoPersona()){
                $respuesta["respuesta"] = "cosmc";

            }else if(!$this->ValidarLengthDireccionPersona()){
                $respuesta["respuesta"] = "dirsmc";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //Función para inicializar los atributos de la clase
        function SetDatos($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput){
            $this->idPersona = $idInput;
            $this->cedulaPersona = $cedulaInput;
            $this->nombresPersona = $nombresInput;
            $this->apellidosPersona = $apellidosInput;
            $this->celularPersona = $celularInput;
            $this->correoPersona = $correoInput;
            $this->direccionPersona = $direccionInput;
            $this->idEspecialidadPersona = $idEspecialidadInput;
        }



        //Funcion para Obtener las personas
        function ObtenerPersonas(){
            $stmt = $this->Conectar()->prepare("SELECT * FROM persona INNER JOIN especialidad WHERE persona.idEspecialidadPersona=especialidad.idEspecialidad");
            $stmt->execute();
            
            $respuesta = ["estado"=>false, "respuesta"=>"nep"];
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ep";
                $respuesta["stmt"] = $stmt;
            }

            return $respuesta;
        }



        //Función para verificar si una persona existe, y si existe, trae los datos de la persona
        function PersonaExistente($idInput){
            $this->idPersona = $idInput;

            $respuesta = ["estado"=>false, "respuesta"=>"pne"];

            if(!$this->ValidarCaracteresIdPersona()){
                $respuesta["respuesta"] = "ispcn";
                return $respuesta;
            };


            $stmt = $this->Conectar()->prepare("SELECT * FROM persona INNER JOIN especialidad WHERE idPersona=? AND persona.idEspecialidadPersona=especialidad.idEspecialidad;");

            if(!$stmt->execute(array($this->idPersona))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "pe";
                $respuesta["stmt"] = $stmt; 
            }

            return $respuesta;
        }



        //Función para verificar si una cedula ya está en uso, y si existe, trae los datos de la persona de esa cédula
        function CedulaExistente($cedulaInput){
            $this->cedulaPersona = $cedulaInput;

            $respuesta = ["estado"=>false, "respuesta"=>"cneu"];

            if(!$this->ValidarCaracteresCedulaPersona()){
                $respuesta["respuesta"] = "cspcn";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("SELECT * FROM persona INNER JOIN especialidad WHERE cedulaPersona=? AND persona.idEspecialidadPersona=especialidad.idEspecialidad;");

            if(!$stmt->execute(array($this->cedulaPersona))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "cyeu";
                $respuesta["stmt"] = $stmt;
            }

            return $respuesta;
        }



        //Función para verificar si una cedula ya está en uso, y si existe, trae los datos de la persona de esa cédula
        function CedulaExistenteId($idInput, $cedulaInput){
            $this->idPersona = $idInput;
            $this->cedulaPersona = $cedulaInput;

            $respuesta = ["estado"=>false, "respuesta"=>"cneu"];

            if(!$this->ValidarCaracteresCedulaPersona()){
                $respuesta["respuesta"] = "cspcn";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("SELECT * FROM persona INNER JOIN especialidad WHERE idPersona=? AND cedulaPersona=? AND persona.idEspecialidadPersona=especialidad.idEspecialidad;");

            if(!$stmt->execute(array($this->idPersona, $this->cedulaPersona))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "cpap";
                $respuesta["stmt"] = $stmt;
            }else{
                $respuesta["respuesta"] = "cnpap";
            }

            return $respuesta;
        }



        //Función para agregar una persona
        function AgregarPersona($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput){
            $this->SetDatos($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->CedulaExistente($this->cedulaPersona);
            if($respuesta["estado"]){
                $respuesta["respuesta"] = "cyeu";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("INSERT INTO persona (cedulaPersona, nombresPersona, apellidosPersona, celularPersona, correoPersona, direccionPersona, idEspecialidadPersona) VALUES(?,?,?,?,?,?,?)");
            if(!$stmt->execute(array($this->cedulaPersona, $this->nombresPersona, $this->apellidosPersona, $this->celularPersona, $this->correoPersona, $this->direccionPersona, $this->idEspecialidadPersona))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "pac";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para actualizar una persona
        function ActualizarPersona($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput){
            $this->SetDatos($idInput, $cedulaInput, $nombresInput, $apellidosInput, $celularInput, $correoInput, $direccionInput, $idEspecialidadInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->PersonaExistente($this->idPersona);
            if(!$respuesta["estado"]){
                $respuesta["respuesta"] = "pne";
                return $respuesta;
            }

            $respuesta = $this->CedulaExistenteId($this->idPersona, $this->cedulaPersona);
            if(!$respuesta["estado"]){
                $respuesta["respuesta"] = "cyeu";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("UPDATE persona SET cedulaPersona=?, nombresPersona=?, apellidosPersona=?, celularPersona=?, correoPersona=?, direccionPersona=?, idEspecialidadPersona=? WHERE idPersona=?");
            if(!$stmt->execute(array($this->cedulaPersona, $this->nombresPersona, $this->apellidosPersona, $this->celularPersona, $this->correoPersona, $this->direccionPersona, $this->idEspecialidadPersona, $this->idPersona))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            $respuesta["estado"] = true;
            $respuesta["respuesta"] = "pacc";

            $stmt = null;
            return $respuesta;
        }



        //Función para eliminar una persona
        function EliminarPersona($idInput){

            $respuesta = ["estado"=>false, "respuesta"=>"pnel"];

            $stmt = $this->Conectar()->prepare("DELETE FROM persona WHERE idPersona=?");
            if(!$stmt->execute(array($idInput))){
                if($stmt->errorInfo()[1]==1451){
                    $stmt = null;
                    $respuesta["respuesta"] = "peuu";
                    return $respuesta;
                }else{
                    $stmt = null;
                    $respuesta["respuesta"] = "estmt";
                    return $respuesta;

                }
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "pelc";
            }else{
                $respuesta["respuesta"] = "pne";
            }

            $stmt = null;
            return $respuesta;
    
        }

    }

?>