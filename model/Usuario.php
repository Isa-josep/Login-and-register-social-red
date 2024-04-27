<?php
    class Usuario extends Conectar{
        private $key="Tec-Export-Itsu";
        private $cipher = "aes-256-cbc";

        public function registrar_usuario($usu_nombre, $usu_correo, $usu_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario 
                (usu_nombre,usu_correo,usu_pass) 
                VALUES 
                (?,?,?)";
            $sql=$conectar->prepare($sql);
            $usu_pass_encrypt=$this->pass_encrypt($usu_pass);
            //TODO: cmabiar parametros en caso de se necesario
            $sql->bindValue(1, $usu_nombre);
            $sql->bindValue(2, $usu_correo);
            $sql->bindValue(3, $usu_pass_encrypt);
            $sql->execute();
            $sql1="SELECT Last_INSERT_ID() as 'usu_id'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $sql1->fetchAll();
        }
        
        public function get_usuario_correo($usu_correo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE usu_correo=?";
            $sql=$conectar->prepare($sql);
            //TODO: cmabiar parametros en caso de se necesario
            $sql->bindValue(1, $usu_correo);
            $sql->execute();
            return $sql->fetchAll();
        }
        
        public function get_usuario_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $sql->fetchAll();
        }

        public function activate_user($usu_id){
            $iv_dec=substr(base64_decode($usu_id),0,openssl_cipher_iv_length($this->cipher));
            $cifrado=substr(base64_decode($usu_id),openssl_cipher_iv_length($this->cipher));
            $txt_descifrado=openssl_decrypt($cifrado,$this->cipher,$this->key,OPENSSL_RAW_DATA,$iv_dec);
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET estado=1, fecha_activate=NOW() WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $txt_descifrado);
            $sql->execute();
        }

        public function recover_password ($usu_correo,$usu_pass){
            $usu_pass_encrypt=$this->pass_encrypt($usu_pass);
            
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET usu_pass=? WHERE usu_correo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_pass_encrypt); 
            $sql->bindValue(2, $usu_correo); 
            $sql->execute();    
        }

        public function pass_encrypt($usu_pass){
            $iv=openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
            $cifrado=openssl_encrypt($usu_pass,$this->cipher,$this->key,OPENSSL_RAW_DATA,$iv);
            return base64_encode($iv.$cifrado);
        }
    }
?>