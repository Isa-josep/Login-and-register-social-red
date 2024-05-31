<?php
    class Producto extends Conectar{
        public function insert_producto($rule_name){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO rules (rule_id,rule_name) VALUES (null,?);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $rule_name);
            $sql->execute();
            $sql1 = "SELECT LAST_INSERT_ID() as rule_id;";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado = $sql1->fetchAll(pdo::FETCH_ASSOC);
        }
        public function insert_file($rule_id, $file_name){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO files_details (files_details_id,rule_id,files_details_nom) VALUES (null,?,?);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $rule_id);
            $sql->bindValue(2, $file_name);
            $sql->execute();
        }
        public function get_files(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM files_details;";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>