<?php

    class Conexion {
        private $servidorConexion;
        private $baseDeDatosConexion;
        private $usuarioConexion;
        private $contraConexion;

        function __construct(){
            $this->servidorConexion = 'localhost';
            $this->baseDeDatosConexion = 'senasoft';
            $this->usuarioConexion = 'root';
            $this->contraConexion = '';
        }

        public function Conectar(){
            try{ 
                $conexion = new PDO("mysql:host=".$this->servidorConexion.";dbname=".$this->baseDeDatosConexion, $this->usuarioConexion, $this->contraConexion);
            
                return $conexion;
                
            }catch(PDOException $error){
                echo "ERROR: ".$error->getMessage()."<br>CÓDIGO: ".$error->getCode();
                die();
            }  
        }
    }

?>