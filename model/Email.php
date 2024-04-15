<?php
    require"../include/vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");
    
    class Email extends PHPMailer{
        protected $Gmail ='ceaprende@cecyteuruapan.edu.mx';
        protected $Gpassword = 'mehk jncp neit kzhf';

        public function registrar($usu_correo){
            $conexion = new Conectar();
            $this->isSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587; //Puerto 
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';

            $this->Username = $this->Gmail;
            $this->Password = $this->Gpassword;
            $this->setFrom($this->Gmail, 'Registro de Tec-Export Itsu');
            $this->CharSet = 'UTF-8';
            $this->addAddress($usu_correo);
            $this->Subject = 'Registro de Usuarioo';

            $body = file_get_contents('../static/mail/registrar.html');
            $body = str_replace("xlinkcorreourl",$conexion->ruta()."view/confirmar",$body);
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
    }
?>