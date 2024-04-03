<?php
    class Usuario extends Conectar{
        public function registrar_usuario($usu_nombre, $usu_correo, $usu_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario 
                (usu_nombre,usu_correo,usu_pass) 
                VALUES 
                ('?' , '?','?')";
            $sql=$conectar->prepare($sql);
            //TODO: cmabiar parametros en caso de se necesario
            $sql->bindValue(1, $usu_nombre);
            $sql->bindValue(2, $usu_correo);
            $sql->bindValue(3, $usu_pass);
            $sql->execute();
        }
    }
?>