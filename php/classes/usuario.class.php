<?php
    
    class Usuario extends Conexion {

        private $idUsuario;
        private $nombreUsuario;
        private $contraUsuario;
        private $idPersonaUsuario;
        private $idRolUsuario;

        private $nombreUsuarioMaxLength;
        private $contraUsuarioMaxLength=20;


        //Función para traer la longitud de caracteres de las columnas de la tabla "personal" desde la base de datos
        function CargarMaxLength(){
            $stmt = $this->Conectar()->prepare("SELECT COLUMN_NAME as columna, CHARACTER_MAXIMUM_LENGTH as length FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='usuario';");
            $stmt->execute();
            
            if($stmt->rowCount()>0){

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    if($resultado->columna=="nombreUsuario"){
                        $this->nombreUsuarioMaxLength=$resultado->length;
                    
                    }
                }
            }
        }



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idUsuario) && !empty($this->nombreUsuario) && !empty($this->contraUsuario) && !empty($this->idPersonaUsuario) && !empty($this->idRolUsuario)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdUsuario(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idUsuario)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresNombreUsuario(){
            $respuesta = false;
            if(preg_match("/^[a-zA-Z0-9]*$/", $this->nombreUsuario)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdPersonaUsuario(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idPersonaUsuario)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresIdRolUsuario(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idRolUsuario)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        

        //Funciones para validar la longitud de caracteres de los datos ingresados
        function ValidarLengthNombreUsuario(){
            $respuesta = false;
            if(strlen($this->nombreUsuario)<=$this->nombreUsuarioMaxLength){
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarLengthContraUsuario(){
            $respuesta = false;
            if(strlen($this->contraUsuario)<=$this->contraUsuarioMaxLength){
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

            }else if(!$this->ValidarCaracteresIdUsuario()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresNombreUsuario()){
                $respuesta["respuesta"] = "nuspcln";

            }else if(!$this->ValidarCaracteresIdPersonaUsuario()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresIdRolUsuario()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarLengthNombreUsuario()){
                $respuesta["respuesta"] = "nusmc";

            }else if(!$this->ValidarLengthContraUsuario()){
                $respuesta["respuesta"] = "consmc";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //Función para inicializar los atributos de la clase
        function SetDatos($idUsuarioInput, $nombreInput, $contraInput, $idPersonaInput, $idRolInput){
            $this->idUsuario = $idUsuarioInput;
            $this->nombreUsuario = $nombreInput;
            $this->contraUsuario = $contraInput;
            $this->idPersonaUsuario = $idPersonaInput;
            $this->idRolUsuario = $idRolInput;
        }



        //Función para obtener el número de usuarios
        function ObtenerNumeroUsuariosEmpleados(){
            $stmt = $this->Conectar()->prepare("SELECT COUNT(idUsuario) as cantidad FROM usuario WHERE idRolUsuario=?");

            $respuesta = ["estado"=>false, "respuesta"=>"neu"];

            if(!$stmt->execute(array(2))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
             
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "eu";

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    $respuesta["cantidad"] = $resultado->cantidad;
                }
                
            }else{
                $respuesta["respuesta"] = "neu";
            }

            return $respuesta;
        }




        //Funcion para obtener los usuario
        function ObtenerUsuarios(){
            $stmt = $this->Conectar()->prepare("SELECT * FROM usuario");
            $stmt->execute();
            
            $respuesta = ["estado"=>false, "respuesta"=>"neu"];
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "eu";
                $respuesta["stmt"] = $stmt;
            }

            return $respuesta;
        }



        //Función para verificar si un usuario existe, y si existe, trae los datos del usuario
        function UsuarioExistente($columna, $valor){
            $respuesta = ["estado"=>false, "respuesta"=>"une"];

            $stmt = $this->Conectar()->prepare("SELECT * FROM usuario WHERE $columna=?");

            if(!$stmt->execute(array($valor))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ue";
                $respuesta["stmt"] = $stmt; 
            }

            return $respuesta;
        }



        //Función para agregar un usuario
        function AgregarUsuario($idUsuarioInput, $nombreInput, $contraInput, $idPersonaInput, $idRolInput){
            $this->SetDatos($idUsuarioInput, $nombreInput, $contraInput, $idPersonaInput, $idRolInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->UsuarioExistente("nombreUsuario", $nombreInput);
            if($respuesta["estado"]){
                $respuesta["respuesta"] = "ue";
                return $respuesta;
            }

            $contraHashFormat = password_hash($this->contraUsuario, PASSWORD_DEFAULT);

            $stmt = $this->Conectar()->prepare("INSERT INTO usuario (nombreUsuario, contraUsuario, idPersonaUsuario, idRolUsuario) VALUES(?,?,?,?)");
            if(!$stmt->execute(array($this->nombreUsuario, $contraHashFormat, $this->idPersonaUsuario, $this->idRolUsuario))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "uac";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para actualizar un usuario
        function ActualizarUsuario($idUsuarioInput, $nombreInput, $contraAntiguaInput, $contraNuevaInput, $idPersonaInput, $idRolInput){
            $this->SetDatos($idUsuarioInput, $nombreInput, $contraAntiguaInput, $idPersonaInput, $idRolInput);

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->UsuarioExistente("idUsuario", $idUsuarioInput);
            if(!$respuesta["estado"]){
                $respuesta["respuesta"] = "une";
                return $respuesta;
            }

            $contraAux;
            $resultados=$respuesta["stmt"]->fetchAll(PDO::FETCH_OBJ);
            foreach($resultados as $resultado){
                $contraAux = $resultado->contraUsuario;
            }
            if(!password_verify($this->contraUsuario, $contraAux)){
                $respuesta["respuesta"] = "cunec";
                return $respuesta;

            }

            $this->contraUsuario = $contraAux;
            
            if(!empty($contraNuevaInput)){
                $this->contraUsuario  = password_hash($contraNuevaInput, PASSWORD_DEFAULT);
                
            }

            $stmt = $this->Conectar()->prepare("UPDATE usuario SET nombreUsuario=?, contraUsuario=?, idPersonaUsuario=?, idRolUsuario=? WHERE idUsuario=?");
            if(!$stmt->execute(array($this->nombreUsuario, $this->contraUsuario, $this->idPersonaUsuario, $this->idRolUsuario, $this->idUsuario))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            $respuesta["estado"] = true;
            $respuesta["respuesta"] = "uacc";

            $stmt = null;
            return $respuesta;
        }



        //Función para eliminar um usuario
        function EliminarUsuario($idInput){

            $respuesta = ["estado"=>false, "respuesta"=>"unel"];

            $stmt = $this->Conectar()->prepare("DELETE FROM usuario WHERE idUsuario=?");
            if(!$stmt->execute(array($idInput))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "uelc";
            }else{
                $respuesta["respuesta"] = "une";
            }

            $stmt = null;
            return $respuesta;
    
        }

    }

?>