<?php
    require"../include/vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");
    
    class Email extends PHPMailer{
        protected $Gmail ='ceaprende@cecyteuruapan.edu.mx';
        protected $Gpassword = 'mehk jncp neit kzhf';
        private $key="Tec-Export-Itsu";
        private $cipher = "aes-256-cbc";
        
        // protected $cipher = "AES-128-CTR";

        public function registrar($usu_id){
            
            $conexion = new Conectar();

            $usuario=new Usuario();
            $datos = $usuario->get_usuario_id($usu_id);

            $iv=openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
            $cifrado=openssl_encrypt($usu_id,$this->cipher,$this->key,OPENSSL_RAW_DATA,$iv);
            $txt_cifrado=base64_encode($iv.$cifrado);

            $this->isSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587; //Puerto 
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';

            $this->Username = $this->Gmail;
            $this->Password = $this->Gpassword;
            $this->setFrom($this->Gmail, 'Registro de Tec-Export Itsu');
            $this->CharSet = 'UTF-8';
            $this->addAddress($datos[0]["usu_correo"]);
            $this->Subject = 'Registro de Usuarioo';

            $body = file_get_contents('../static/mail/registrar.html');
            $body = str_replace("xlinkcorreourl",$conexion->ruta()."view/confirmar/?id=".$txt_cifrado,$body);
            $this->Body = $body;
            $this->AltBody= strip_tags("Confirmar registro?");

            try{
                $this->send();
                return true;
            }
            catch(Exception $e){
                echo "Error al enviar el correo: {$this->ErrorInfo}"; //TODO: eliminar si da error
                return false;

            }
            // $this->isHTML(true);
        }

        public function recovery($usu_correo){
            
            $conexion = new Conectar();

            $usuario=new Usuario();
            $datos = $usuario->get_usuario_correo($usu_correo);

           

            $this->isSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587; //Puerto 
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';

            $this->Username = $this->Gmail;
            $this->Password = $this->Gpassword;
            $this->setFrom($this->Gmail, 'Recuperar contraseña  de Tec-Export Itsu');
            $this->CharSet = 'UTF-8';
            $this->addAddress($datos[0]["usu_correo"]);
            $this->Subject = 'Registro de Usuarioo';

            $body = file_get_contents('../static/mail/registrar.html');
            // $body = str_replace("xlinkcorreourl",$conexion->ruta()."view/confirmar/?id=".$txt_cifrado,$body);
            $this->Body = $body;
            $this->AltBody= strip_tags("Recuperar contraseña");

            try{
                $this->send();
                return true;
            }
            catch(Exception $e){
                echo "Error al enviar el correo: {$this->ErrorInfo}"; //TODO: eliminar si da error
                return false;

            }
            // $this->isHTML(true);
        }

    }
?>