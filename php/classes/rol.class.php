<?php
    
    class Rol extends Conexion {

        private $idRol;
        private $nombreRol;

        private $nombreRolMaxLength;



        //Función para traer la longitud de caracteres de las columnas de la tabla "personal" desde la base de datos
        function CargarMaxLength(){
            $stmt = $this->Conectar()->prepare("SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='rol';");
            $stmt->execute();
            
            if($stmt->rowCount()>0){

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    if($resultado->columna=="nombreRol"){
                        $this->nombreRolMaxLength=$resultado->length;
                    
                    }
                }
            }
        }



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idRol) && !empty($this->nombreRol)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdRol(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idRol)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresNombreRol(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z]*$/", $this->nombreRol)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funcion para validar la longitud de caracteres de los datos ingresados
        function ValidarLengthNombreRol(){
            $respuesta = false;
            if(strlen($this->nombreRol)<=$this->nombreRolMaxLength){
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

            }else if(!$this->ValidarCaracteresIdRol()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresNombreRol()){
                $respuesta["respuesta"] = "nrspcl";

            }else if(!$this->ValidarLengthNombreRol()){
                $respuesta["respuesta"] = "nrsmc";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //Función para inicializar los atributos de la clase
        function SetDatos($idInput, $nombreInput){
            $this->idRol = $idInput;
            $this->nombreRol = $nombreInput;
        }



        //Funcion para Obtener las los roles
        function ObtenerRoles(){
            $stmt = $this->Conectar()->prepare("SELECT * FROM rol");
            $stmt->execute();
            
            $respuesta = ["estado"=>false, "respuesta"=>"ner"];
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "er";
                $respuesta["stmt"] = $stmt; 
            }

            return $respuesta;
        }



        //Función para verificar si un rol existe, y si existe, trae los datos del rol
        function RolExistente($columna, $valor){
            $respuesta = ["estado"=>false, "respuesta"=>"rne"];

            if(!$this->ValidarCaracteresIdRol()){
                $respuesta["respuesta"] = "ispcn";
                return $respuesta;
            };


            $stmt = $this->Conectar()->prepare("SELECT * FROM rol WHERE $columna=?");

            if(!$stmt->execute(array($valor))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "re";
                $respuesta["stmt"] = $stmt; 
            }

            return $respuesta;
        }


        //Función para agregar una persona
        function AgregarRol($idInput, $nombreInput){
            $this->SetDatos($idInput, $nombreInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->RolExistente("nombreRol", $nombreInput);
            if($respuesta["estado"]){
                $respuesta["respuesta"] = "re";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("INSERT INTO rol (nombreRol) VALUES(?)");
            if(!$stmt->execute(array($this->nombreRol))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "rac";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para actualizar un rol
        function ActualizarRol($idInput, $nombreInputt){
            $this->SetDatos($idInput, $nombreInputt);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->RolExistente($this->idRol);
            if(!$respuesta["estado"]){
                $respuesta["respuesta"] = "re";
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("UPDATE rol SET nombreRol=? WHERE idRol=?");
            if(!$stmt->execute(array($this->nombreRol, $this->idRol))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            $respuesta["estado"] = true;
            $respuesta["respuesta"] = "racc";

            $stmt = null;
            return $respuesta;
        }



        //Función para eliminar un rol
        function EliminarRol($idInput){

            $respuesta = ["estado"=>false, "respuesta"=>"rnel"];

            $stmt = $this->Conectar()->prepare("DELETE FROM rol WHERE idRol=?");
            if(!$stmt->execute(array($idInput))){
                if($stmt->errorInfo()[1]==1451){
                    $stmt = null;
                    $respuesta["respuesta"] = "reuu";
                    return $respuesta;
                }else{
                    $stmt = null;
                    $respuesta["respuesta"] = "estmt";
                    return $respuesta;

                }
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "relc";
            }else{
                $respuesta["respuesta"] = "rne";
            }

            $stmt = null;
            return $respuesta;
    
        }

    }

?>