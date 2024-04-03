<?php
    session_start();
    class Conectar{
        protected $dbh;
        protected function conexion(){
            try{
                $conectar= $this->dbh = new PDO("mysql:local=localhost;dbname=tec_export","root","",);
                return $conectar;
            }
            catch(Exception $e){
                print "¡Error BD!: " . $e->getMessage(). "<br/>";
                die();
            }
        }   
        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");

        } 
        public static function ruta(){
            //TODO: Cambiar la ruta de acuerdo al servidor
            return "http://localhost/login/";
        }
    }
?>