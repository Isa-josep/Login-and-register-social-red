<?php
    session_start();
    class Conectar{
        protected $dbh;
        protected function conexion(){
            try{
                // TODO: Establecer la conexión a la base de datos MySQL
                $conectar= $this->dbh = new PDO("mysql:local=localhost;dbname=tec_export","root","",);
                return $conectar;
            }
            catch(Exception $e){
                // TODO: Imprimir el mensaje de error en caso de fallo en la conexión
                print "¡Error BD!: " . $e->getMessage(). "<br/>";
                die();
            }
        }   
        
        // TODO: Establecer caracteres de la conexión a UTF-8
        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        } 
        
        public static function ruta(){
            // TODO: Cambiar la ruta de acuerdo al servidor
            return "http://localhost/login/";
        }
    }
?>