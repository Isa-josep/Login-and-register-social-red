<?php
    //TODO: Clase Usuario que extiende de Conectar para manejar la conexión a la base de datos
    class Usuario extends Conectar {
        //TODO: Propiedades para el cifrado de contraseñas y desencriptado de las mimas 
        private $key = "Tec-Export-Itsu";
        private $cipher = "aes-256-cbc";

        //TODO: Método para iniciar sesión
        public function login() {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            parent::set_names(); //TODO: Establece los nombres de los caracteres

            //TODO: Verifica si se ha enviado el formulario de inicio de sesión
            if (isset($_POST["enviar"])) {
                $correo = $_POST["usu_correo"]; //TODO: Obtiene el correo del formulario
                $pass = $_POST["usu_pass"]; //TODO: Obtiene la contraseña del formulario

                //TODO: Si el correo o la contraseña están vacíos, redirige con un mensaje de error
                if (empty($correo) && empty($pass)) {
                    header("Location:" . Conectar::ruta() . "index.php?m=2");
                    exit();
                } else {
                    //TODO: Consulta para verificar el usuario por correo
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo=?";
                    $sql = $conectar->prepare($sql);
                    $sql->bindValue(1, $correo);
                    $sql->execute();
                    $resultado = $sql->fetch();

                    if ($resultado) {
                        $textoCifrado = $resultado["usu_pass"]; //TODO: Obtiene la contraseña cifrada
                        $textoDescifrado = $this->pass_decrypt($textoCifrado); //TODO: Desencripta la contraseña

                        //TODO: Si la contraseña desencriptada coincide con la ingresada, inicia sesión
                        if ($textoDescifrado == $pass) {
                            if (is_array($resultado) && count($resultado) > 0) {
                                $_SESSION["usu_id"] = $resultado["usu_id"];
                                $_SESSION["usu_nombre"] = $resultado["usu_nombre"];
                                $_SESSION["usu_correo"] = $resultado["usu_correo"];
                                $_SESSION["role_id"] = $resultado["role_id"];
                                $_SESSION["estado"] = $resultado["estado"];
                                header("Location:" . Conectar::ruta() . "view/Home/");
                                exit();
                            }
                        } else {
                            //TODO: Si la contraseña no coincide, redirige con un mensaje de error
                            header("Location:" . Conectar::ruta() . "index.php?m=3");
                            exit();
                        }
                    } else {
                        //TODO: Si no se encuentra el usuario, redirige con un mensaje de error
                        header("Location:" . Conectar::ruta() . "index.php?m=1");
                        exit();
                    }
                }
            }
        }

        //TODO: Método para registrar un nuevo usuario
        public function registrar_usuario($usu_nombre, $usu_correo, $usu_pass) {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            parent::set_names(); //TODO: Establece los nombres de los caracteres

            //TODO: Consulta para insertar un nuevo usuario
            $sql = "INSERT INTO tm_usuario 
                    (usu_nombre, usu_correo, usu_pass) 
                    VALUES 
                    (?, ?, ?)";
            $sql = $conectar->prepare($sql);
            $usu_pass_encrypt = $this->pass_encrypt($usu_pass); //TODO: Cifra la contraseña
            
            $sql->bindValue(1, $usu_nombre);
            $sql->bindValue(2, $usu_correo);
            $sql->bindValue(3, $usu_pass_encrypt);
            $sql->execute();

            //TODO: Consulta para obtener el último ID insertado
            $sql1 = "SELECT Last_INSERT_ID() as 'usu_id'";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $sql1->fetchAll();
        }

        //TODO: Método para obtener un usuario por correo
        public function get_usuario_correo($usu_correo) {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            parent::set_names(); //TODO: Establece los nombres de los caracteres
            $sql = "SELECT * FROM tm_usuario WHERE usu_correo=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_correo);
            $sql->execute();
            return $sql->fetchAll();
        }

        //TODO: Método para obtener un usuario por ID
        public function get_usuario_id($usu_id) {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            parent::set_names(); //TODO: Establece los nombres de los caracteres
            $sql = "SELECT * FROM tm_usuario WHERE usu_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $sql->fetchAll();
        }

        //TODO: Método para activar un usuario
        public function activate_user($usu_id) {
            $iv_dec = substr(base64_decode($usu_id), 0, openssl_cipher_iv_length($this->cipher));
            $cifrado = substr(base64_decode($usu_id), openssl_cipher_iv_length($this->cipher));
            $txt_descifrado = openssl_decrypt($cifrado, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv_dec);

            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            parent::set_names(); //TODO: Establece los nombres de los caracteres
            //TODO: Consulta para actualizar el estado del usuario a activo
            $sql = "UPDATE tm_usuario SET estado=1, fecha_activate=NOW() WHERE usu_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $txt_descifrado);
            $sql->execute();
        }

        //TODO: Método para recuperar la contraseña de un usuario
        public function recover_password($usu_correo, $usu_pass) {
            $usu_pass_encrypt = $this->pass_encrypt($usu_pass); //TODO: Cifra la nueva contraseña

            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            parent::set_names(); //TODO: Establece los nombres de los caracteres
            //TODO: Consulta para actualizar la contraseña del usuario
            $sql = "UPDATE tm_usuario SET usu_pass=? WHERE usu_correo=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_pass_encrypt); 
            $sql->bindValue(2, $usu_correo); 
            $sql->execute();    
        }

        //TODO: Método para cifrar una contraseña
        public function pass_encrypt($usu_pass) {
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
            $cifrado = openssl_encrypt($usu_pass, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
            return base64_encode($iv . $cifrado);
        }

        //TODO: Método para descifrar una contraseña
        public function pass_decrypt($usu_pass) {
            $iv_dec = substr(base64_decode($usu_pass), 0, openssl_cipher_iv_length($this->cipher));
            $cifrado = substr(base64_decode($usu_pass), openssl_cipher_iv_length($this->cipher));
            return openssl_decrypt($cifrado, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv_dec);
        }
        
        //TODO: Método para obtener un usuario por ID usando bindParam
        public function getUsuarioById($id) {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            $sql = "SELECT * FROM tm_usuario WHERE usu_id = :id"; 
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        //TODO: Método para actualizar los datos de un usuario
        public function actualizarUsuario($id, $nombre, $correo, $estado, $role_id) {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            //TODO: Consulta para actualizar los datos del usuario
            $sql = "UPDATE tm_usuario SET usu_nombre = :nombre, usu_correo = :correo, estado = :estado, role_id = :role_id WHERE usu_id = :id";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT); 
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        //TODO: Método para eliminar un usuario
        public function eliminarUsuario($id) {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            //TODO: Consulta para eliminar un usuario por ID
            $sql = "DELETE FROM tm_usuario WHERE usu_id = :id";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
        
        //TODO: Método para obtener todos los usuarios y sus roles
        public function getUsuarios() {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            //TODO: Consulta para obtener los usuarios y sus roles
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

        //TODO: Método para obtener todos los roles
        public function getRoles() {
            $conectar = parent::conexion(); //TODO: Obtiene la conexión a la base de datos
            $sql = "SELECT * FROM roles";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
