<?php
    class Producto extends Conectar{
        //TODO: Inserta un nuevo producto en la base de datos
        public function insert_producto($rule_name){
            //TODO: Conecta a la base de datos utilizando el método de la clase padre
            $conectar = parent::conexion();
            parent::set_names();
            
            //TODO: Prepara la consulta SQL para insertar un nuevo producto
            $sql = "INSERT INTO rules (rule_id,rule_name) VALUES (null,?);";
            $sql = $conectar->prepare($sql);
            //TODO: Asigna el valor del nombre de la regla al primer parámetro de la consulta
            $sql->bindValue(1, $rule_name);
            //TODO: Ejecuta la consulta
            $sql->execute();
            
            //TODO: Prepara una consulta SQL para obtener el ID del último registro insertado
            $sql1 = "SELECT LAST_INSERT_ID() as rule_id;";
            $sql1 = $conectar->prepare($sql1);
            //TODO: Ejecuta la consulta
            $sql1->execute();
            //TODO: Devuelve el resultado como un arreglo asociativo
            return $resultado = $sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        //TODO: Inserta un archivo asociado a un producto en la base de datos
        public function insert_file($rule_id, $file_name){
            //TODO: Conecta a la base de datos utilizando el método de la clase padre
            $conectar = parent::conexion();
            parent::set_names();
            
            //TODO: Prepara la consulta SQL para insertar un archivo asociado al producto
            $sql = "INSERT INTO files_details (files_details_id,rule_id,files_details_nom) VALUES (null,?,?);";
            $sql = $conectar->prepare($sql);
            //TODO: Asigna los valores del ID de la regla y el nombre del archivo a los parámetros de la consulta
            $sql->bindValue(1, $rule_id);
            $sql->bindValue(2, $file_name);
            //TODO: Ejecuta la consulta
            $sql->execute();
        }

        //TODO: Obtiene todos los archivos de la base de datos
        public function get_files(){
            //TODO: Conecta a la base de datos utilizando el método de la clase padre
            $conectar = parent::conexion();
            parent::set_names();
            
            //TODO: Prepara la consulta SQL para obtener todos los archivos
            $sql = "SELECT * FROM files_details;";
            $sql = $conectar->prepare($sql);
            //TODO: Ejecuta la consulta
            $sql->execute();
            //TODO: Devuelve el resultado como un arreglo asociativo
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>
