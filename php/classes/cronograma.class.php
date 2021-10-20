<?php

    class Cronograma extends Conexion {

        private $idUsuarioCronograma;
        private $horarioCronograma;



        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idUsuarioCronograma) && !empty($this->horarioCronograma)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Funciones para validar los caracteres de los datos ingresados
        function ValidarCaracteresIdUsuarioCronograma(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->idUsuarioCronograma)) {
                $respuesta = true;
            }
            return $respuesta;
        }

        function ValidarCaracteresHorarioCronograma(){
            $respuesta = false;
            if(preg_match("/^[0-9]*$/", $this->horarioCronograma)) {
                $respuesta = true;
            }
            return $respuesta;
        }



        //Función que llama a todas las funciones para validar los datos
        function ValidarDatos(){
            $respuesta = ["estado"=>false, "respuesta"=>"nsvd"];

            if (!$this->ValidarDatosVacios()){
                $respuesta["respuesta"] = "hcv";

            }else if(!$this->ValidarCaracteresIdUsuarioCronograma()){
                $respuesta["respuesta"] = "ispcn";

            }else if(!$this->ValidarCaracteresHorarioCronograma()){
                $respuesta["respuesta"] = "nuspcln";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }





        function SetDatos($idUSuarioInput, $horarioInput){
            $this->idUsuarioCronograma = $idUSuarioInput;
            $this->horarioCronograma = $horarioInput;
        }

        function TomarTurno($idUSuarioInput, $horarioInput){
            $this->SetDatos($idUSuarioInput, $horarioInput);
            $respuesta = ["estado"=>false, "respuesta"=>""];

            $stmt = $this->Conectar()->prepare("INSERT INTO cronogramaactual (idUsuarioCronogramaActual, horarioCronogramaActual, fechaCronogramaActual) VALUES(?,?,?)");
            if(!$stmt->execute(array($this->idUsuarioCronograma, $this->horarioCronograma, "2020-05-12"))){
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

    }

?>