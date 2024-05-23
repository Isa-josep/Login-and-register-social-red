<?php
    class Usuario extends Conectar{
        private $key="Tec-Export-Itsu";
        private $cipher = "aes-256-cbc";

        public function login(){
            $conectar= parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo= $_POST["usu_correo"];
                $pass= $_POST["usu_pass"];
                if(empty($correo) && empty($pass)){
                    //si los datos esta vacios mandamos un mensaje de error por url
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }
                else{
                    $sql="SELECT * FROM tm_usuario WHERE usu_correo=?";
                    $sql=$conectar->prepare($sql);
                    $sql->bindValue(1, $correo);
                    $sql->execute();
                    $resultado= $sql->fetch();
                    if($resultado){
                        $textoCifrado= $resultado["usu_pass"];
                        $textoDescifrado= $this->pass_decrypt($textoCifrado);
                        // echo $textoDescifrado;
                        if($textoDescifrado == $pass){
                            if(is_array($resultado) && count($resultado)>0){
                                $_SESSION["usu_id"]=$resultado["usu_id"];
                                $_SESSION["usu_nombre"]=$resultado["usu_nombre"];
                                $_SESSION["usu_correo"]=$resultado["usu_correo"];
                                $_SESSION["role_id"]=$resultado["role_id"];
                                $_SESSION["estado"]=$resultado["estado"];
                                header("Location:".Conectar::ruta()."view/Home/");
                                exit();
                            }
                        } 
                        else{
                            header("Location:".Conectar::ruta()."index.php?m=3");
                            exit();
                        }
                    }
                    else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }

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

        public function pass_decrypt($usu_pass){
            $iv_dec=substr(base64_decode($usu_pass),0,openssl_cipher_iv_length($this->cipher));
            $cifrado=substr(base64_decode($usu_pass),openssl_cipher_iv_length($this->cipher));
            return openssl_decrypt($cifrado,$this->cipher,$this->key,OPENSSL_RAW_DATA,$iv_dec);
        }
        
        public function getUsuarioById($id) {
            $conectar = parent::conexion();
            $sql = "SELECT * FROM tm_usuario WHERE usu_id = :id"; 
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        public function actualizarUsuario($id, $nombre, $correo, $estado, $role_id) {
            $conectar = parent::conexion();
            $sql = "UPDATE tm_usuario SET usu_nombre = :nombre, usu_correo = :correo, estado = :estado, role_id = :role_id WHERE usu_id = :id";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT); 
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function eliminarUsuario($id) {
            $conectar = parent::conexion();
            $sql = "DELETE FROM tm_usuario WHERE usu_id = :id";
        
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
        
        public function getUsuarios() {
            $conectar = parent::conexion(); 
            $sql = "SELECT tm_usuario.*, roles.role_name 
                    FROM tm_usuario 
                    JOIN roles ON tm_usuario.role_id = roles.role_id";
            $result = $conectar->query($sql); 
            $usuarios = [];
            if ($result) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $usuarios[] = $row;
                }
            } else {  
                echo "Error en la consulta: " . $conectar->errorInfo()[2];
            }
            return $usuarios;
        }

        public function getRoles() {
            $conectar = parent::conexion();
            $sql = "SELECT * FROM roles";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>