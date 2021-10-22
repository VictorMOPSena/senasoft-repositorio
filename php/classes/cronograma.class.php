<?php

    class Cronograma extends Conexion {

        private $idUsuarioCronograma;
        private $horarioCronograma;
        private $fechaCronograma;
        private $usuariosTotalCronograma;
        private $idEspecialidadCronograma;


        //Función para validar que los datos ingresados no estén vacíos
        function ValidarDatosVacios(){
            $respuesta = false;
            if(!empty($this->idUsuarioCronograma) && !empty($this->horarioCronograma) && !empty($this->fechaCronograma)) {
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
        function ValidarCaracteresFechaCronograma(){
            $respuesta = false;
            if(preg_match("/^[0-9-]*$/", $this->fechaCronograma)) {
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
                $respuesta["respuesta"] = "hnv";

            }else if(!$this->ValidarCaracteresFechaCronograma()){
                $respuesta["respuesta"] = "ffnv";

            }else{
                $respuesta["respuesta"] = "";
                $respuesta["estado"] = true;

            }
            return $respuesta;
        }



        //funcion para inicializar los atributos de la clase
        function SetDatos($idUSuarioInput, $horarioInput, $fechaInput, $usuariosTotalInput, $idEspecialidadInput){
            $this->idUsuarioCronograma = $idUSuarioInput;
            $this->horarioCronograma = $horarioInput;
            $this->fechaCronograma = $fechaInput;
            $this->usuariosTotalCronograma = $usuariosTotalInput;
            $this->idEspecialidadCronograma = $idEspecialidadInput;
        }



        //Función para obtener personas por turno
        function ObtenerEmpleadosTurno($fechaInput, $idEspecialidadInput, $horarioInput){
            $respuesta = ["estado"=>false, "respuesta"=>"eno"];

            $stmt = $this->Conectar()->prepare("SELECT nombresPersona, apellidosPersona FROM persona INNER JOIN cronogramaactual WHERE fechaCronogramaActual=? AND persona.idPersona=cronogramaactual.idUsuarioCronogramaActual AND idEspecialidadPersona=? AND horarioCronogramaActual=?;");
            if(!$stmt->execute(array($fechaInput, $idEspecialidadInput, $horarioInput))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "eoc";
                $respuesta["stmt"] = $stmt;

            }else {
                $respuesta["respuesta"] = "emne";
            }

            $stmt = null;
            return $respuesta;

        }



        //Función para obtener los turnos a partir de la fecha(domingo)
        function ObtenerTurnosFecha($fechaInput, $idEspecialidadInput){
            $respuesta = ["estado"=>false, "respuesta"=>"tsno"];

            $fechaSepara = explode("-", $fechaInput);
            $mktimeFecha = mktime(0, 0, 0, date($fechaSepara[1]), date($fechaSepara[2]), date($fechaSepara[0]));

            $dia = date("l", $mktimeFecha);
            if($dia!="Sunday"){
                $respuesta["respuesta"] = "fidsud";
                $stmt = null;
                return $respuesta;   
            }

            $futuroSabado = date('Y-m-d', strtotime($fechaInput. ' + 6 days'));

            $stmt = $this->Conectar()->prepare("SELECT * FROM cronogramaactual INNER JOIN persona WHERE fechaCronogramaActual BETWEEN ? AND ? AND cronogramaactual.idUsuarioCronogramaActual=persona.idPersona AND idEspecialidadPersona=?;");
            $a="";
            if(!$stmt->execute(array($fechaInput, $futuroSabado, $idEspecialidadInput))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "toc";
                $respuesta["stmt"] = $stmt;

            }else {
                $respuesta["respuesta"] = "tsne";
            }

            $stmt = null;
            return $respuesta;

        }



        //Función para verificar que no haya seleccionado un turno ya tomado
        function VerificarTurnoRepetido(){
            $respuesta = ["estado"=>false, "respuesta"=>"tnv"];

            $stmt = $this->Conectar()->prepare("SELECT * FROM cronogramaactual WHERE idUsuarioCronogramaActual=? AND horarioCronogramaActual=? AND fechaCronogramaActual=?");

            if(!$stmt->execute(array($this->idUsuarioCronograma, $this->horarioCronograma, $this->fechaCronograma))){
                echo $stmt->errorInfo();
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ytst";
                $respuesta["stmt"] = $stmt;

            }else {
                $respuesta["respuesta"] = "tnr";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para verificar que sólo pueda tomar 5 turnos, ya que 2 días a la semana son descansos
        function VerificarCantidadTurnos(){
            $respuesta = ["estado"=>false, "respuesta"=>"cttnv"];

            $fechaSepara = explode("-", $this->fechaCronograma);

            $numDia = $fechaSepara[2];

            $mktimeFecha = mktime(0, 0, 0, date($fechaSepara[1]), date($numDia), date($fechaSepara[0]));
            $diaInicio = date("l", $mktimeFecha);
            $fechaInicio = date("Y-m-d", $mktimeFecha);

            while($diaInicio!="Sunday") {
                $numDia--;
                $mktimeFecha = mktime(0, 0, 0, date($fechaSepara[1]), date($numDia), date($fechaSepara[0]));
                $diaInicio = date("l", $mktimeFecha);
            }

            $fechaInicio = date("Y-m-d", $mktimeFecha);


            $mktimeFecha = mktime(0, 0, 0, date($fechaSepara[1]), date($numDia+6), date($fechaSepara[0]));
            $fechaFinal = date("Y-m-d", $mktimeFecha);
            $diaFinal = date("l", $mktimeFecha);


            $stmt = $this->Conectar()->prepare("SELECT COUNT(idCronogramaActual) as cantidad FROM cronogramaactual WHERE idUsuarioCronogramaActual=? AND fechaCronogramaActual BETWEEN ? AND ?;");

            if(!$stmt->execute(array($this->idUsuarioCronograma, $fechaInicio, $fechaFinal))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            if($stmt->rowCount()>0){
                $respuesta["respuesta"] = "et";

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    $respuesta["cantidad"] = $resultado->cantidad;
                }
                
                if($respuesta["cantidad"]<5){
                    $respuesta["estado"] = true;
                    $respuesta["respuesta"] = "td";
                }else{
                    $respuesta["respuesta"] = "nptmt";
                }

            }else{
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "td";
            }


            $stmt = null;
            return $respuesta;
        }



        //Función para verificar que el turno seleccionado no esté lleno
        function VerificarTurnoLLeno(){
            $respuesta = ["estado"=>false, "respuesta"=>"tllnv"];

            $stmt = $this->Conectar()->prepare("SELECT COUNT(idCronogramaActual) as cantidad FROM cronogramaactual INNER JOIN persona WHERE cronogramaactual.idUsuarioCronogramaActual=persona.idPersona AND idEspecialidadPersona=? AND horarioCronogramaActual=? AND fechaCronogramaActual=?;");

            if(!$stmt->execute(array($this->idEspecialidadCronograma, $this->horarioCronograma, $this->fechaCronograma))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["respuesta"] = "et";

                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    $respuesta["cantidad"] = $resultado->cantidad;
                }

                if($this->usuariosTotalCronograma%2==1){
                    $this->usuariosTotalCronograma++;
                }

                $this->usuariosTotalCronograma/=2;

                if($respuesta["cantidad"]<$this->usuariosTotalCronograma){
                    $respuesta["estado"] = true;
                    $respuesta["respuesta"] = "td";

                }else{
                    $respuesta["respuesta"] = "tell";
                }

            }

            $stmt = null;
            return $respuesta;
        }



        //Función para cambiar el horario de 1 a 2 o viceversa
        function CambiarHorarioTurno(){
            $respuesta = ["estado"=>false, "respuesta"=>"nsct"];

            $stmt = $this->Conectar()->prepare("SELECT * FROM cronogramaactual WHERE idUsuarioCronogramaActual=? AND fechaCronogramaActual=?");

            if(!$stmt->execute(array($this->idUsuarioCronograma, $this->fechaCronograma))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["respuesta"] = "te";

                $horarioAux;
                $resultados=$stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($resultados as $resultado){
                    $horarioAux = $resultado->horarioCronogramaActual;
                }

                if($horarioAux==1){
                    $this->horarioCronograma=2;
                }else{
                    $this->horarioCronograma=1;
                }

                $stmt = $this->Conectar()->prepare("UPDATE cronogramaactual SET horarioCronogramaActual=? WHERE idUsuarioCronogramaActual=? AND fechaCronogramaActual=?");
                if(!$stmt->execute(array($this->horarioCronograma, $this->idUsuarioCronograma, $this->fechaCronograma))){
                    $stmt = null;
                    $respuesta["respuesta"] = "estmt";
                    return $respuesta;
                }
                
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "tcc";

            }else{
                $respuesta["estado"] = false;
                $respuesta["respuesta"] = "ntua";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para tomar turno
        function TomarTurno($idUSuarioInput, $horarioInput, $fechaInput, $usuariosTotalInput, $idEspecialidadInput){
            $this->SetDatos($idUSuarioInput, $horarioInput, $fechaInput, $usuariosTotalInput, $idEspecialidadInput);
            

            $validacion = $this->ValidarDatos();
            if(!$validacion["estado"]){
                return $validacion;
            }

            $respuesta = $this->VerificarTurnoRepetido();
            if($respuesta["estado"]){
                return $respuesta;
            }

            $respuesta = $this->VerificarTurnoLleno();
            if(!$respuesta["estado"]){
                return $respuesta;
            }

            $respuesta = $this->CambiarHorarioTurno();
            if($respuesta["estado"]){
                return $respuesta;
            }

            $respuesta = $this->VerificarCantidadTurnos();
            if(!$respuesta["estado"]){
                return $respuesta;
            }

            $stmt = $this->Conectar()->prepare("INSERT INTO cronogramaactual (idUsuarioCronogramaActual, horarioCronogramaActual, fechaCronogramaActual) VALUES(?,?,?)");
            if(!$stmt->execute(array($this->idUsuarioCronograma, $this->horarioCronograma, $this->fechaCronograma))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }
            
            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "ttc";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para dejar el turno
        function AbandonarTurno($idUSuarioInput, $horarioInput, $fechaInput){

            $respuesta = ["estado"=>false, "respuesta"=>"tna"];

            $stmt = $this->Conectar()->prepare("DELETE FROM cronogramaactual WHERE idUsuarioCronogramaActual=? AND horarioCronogramaActual=? AND fechaCronogramaActual=?");
            if(!$stmt->execute(array($idUSuarioInput, $horarioInput, $fechaInput))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            if($stmt->rowCount()>0){
                $respuesta["estado"] = true;
                $respuesta["respuesta"] = "tac";
            }else{
                $respuesta["respuesta"] = "tne";
            }

            $stmt = null;
            return $respuesta;
        }



        //Función para actualizar id de usuario
        function SetUsuarioNoExistente($idUsuarioInput){
            $respuesta = ["estado"=>false, "respuesta"=>"nscune"];
            
            $stmt = $this->Conectar()->prepare("UPDATE cronogramaactual SET idUsuarioCronogramaActual=1 WHERE idUsuarioCronogramaActual=?");
            if(!$stmt->execute(array($idUsuarioInput))){
                $stmt = null;
                $respuesta["respuesta"] = "estmt";
                return $respuesta;
            }

            $respuesta["estado"] = true;
            $respuesta["respuesta"] = "unec";
            
            $stmt = null;
            return $respuesta;
        }

    }

?>