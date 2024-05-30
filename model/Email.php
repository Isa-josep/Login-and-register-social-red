<?php
    //TODO: Carga el autoloader de Composer para manejar dependencias
    require "../include/vendor/autoload.php";

    //TODO: Uso de las clases PHPMailer y Exception del namespace PHPMailer\PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //TODO: Carga las configuraciones de conexión y la clase Usuario
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");

    //TODO: Clase Email que extiende de PHPMailer
    class Email extends PHPMailer {
        //TODO: Propiedades protegidas y privadas para credenciales y configuración de cifrado
        protected $Gmail ='ceaprende@cecyteuruapan.edu.mx'; //TODO:Agregar el correo que se usara para mandar los emails
        protected $Gpassword = 'mehk jncp neit kzhf';//TODO: agregar la contraseña del correo
        private $key = "Tec-Export-Itsu";//TODO:Clave de cifrado
        private $cipher = "aes-256-cbc";//TODO:Cifrado

        //TODO: Método para registrar un nuevo usuario
        public function registrar($usu_id) {
            //TODO: Conexión a la base de datos
            $conexion = new Conectar();

            //TODO: Creación de un objeto Usuario y obtención de datos del usuario por ID
            $usuario = new Usuario();
            $datos = $usuario->get_usuario_id($usu_id);

            //TODO: Generación de un vector de inicialización (IV) y cifrado del ID del usuario
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
            $cifrado = openssl_encrypt($usu_id, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
            $txt_cifrado = base64_encode($iv . $cifrado);

            //TODO: Configuración del servidor SMTP
            $this->isSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587; //TODO: Puerto
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';

            //TODO: Autenticación SMTP
            $this->Username = $this->Gmail;
            $this->Password = $this->Gpassword;
            $this->setFrom($this->Gmail, 'Registro de Tec-Export Itsu');
            $this->CharSet = 'UTF-8';
            $this->addAddress($datos[0]["usu_correo"]);
            $this->Subject = 'Registro de Usuario';

            //TODO: Carga y personalización del cuerpo del correo
            $body = file_get_contents('../static/mail/registrar.html');
            $body = str_replace("xlinkcorreourl", $conexion->ruta() . "view/confirmar/?id=" . $txt_cifrado, $body);
            $this->Body = $body;
            $this->AltBody = strip_tags("Confirmar registro?");

            //TODO: Envío del correo y manejo de errores
            try {
                $this->send();
                return true;
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$this->ErrorInfo}"; //TODO: TODO: eliminar si da error
                return false;
            }
        }

        //TODO: Método para la recuperación de contraseña
        public function recovery($usu_correo) {
            //TODO: Conexión a la base de datos
            $conexion = new Conectar();

            //TODO: Creación de un objeto Usuario y obtención de datos del usuario por correo
            $usuario = new Usuario();
            $datos = $usuario->get_usuario_correo($usu_correo);

            //TODO: Configuración del servidor SMTP
            $this->isSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587; //TODO: Puerto
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';

            //TODO: Autenticación SMTP
            $this->Username = $this->Gmail;
            $this->Password = $this->Gpassword;
            $this->setFrom($this->Gmail, 'Recuperar contraseña de Tec-Export Itsu');
            $this->CharSet = 'UTF-8';
            $this->addAddress($datos[0]["usu_correo"]);
            $this->Subject = 'Recuperar contraseña';

            //TODO: Generación de una nueva contraseña aleatoria
            $xpassusu = $this->generateRandomPassword();
            $usuario->recover_password($usu_correo, $xpassusu);

            //TODO: Carga y personalización del cuerpo del correo
            $body = file_get_contents('../static/mail/recuperar.html');
            $body = str_replace("xpassusu", $xpassusu, $body);
            $body = str_replace("xlinksistema", $conexion->ruta(), $body);
            $this->Body = $body;
            $this->AltBody = strip_tags("Recuperar contraseña");

            //TODO: Envío del correo y manejo de errores
            try {
                $this->send();
                return true;
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$this->ErrorInfo}";
                return false;
            }
        }

        //TODO: Método privado para generar una contraseña aleatoria
        private function generateRandomPassword() {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $password = '';
            $length = 6; 

            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $password .= $characters[$index];
            }

            return $password;
        }
    }
?>
