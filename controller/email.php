<?php
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");
    require_once("../model/Email.php");
    $usuario = new Usuario();
    $email = new Email();
    switch($_GET["op"]){
        case "recuperar":
            $datos= $usuario->get_usuario_correo($_POST["usu_correo"]);
            if(is_array($datos)== true and count($datos)==0){
                echo "false";
            }
            else{
                $email->recovery($_POST["usu_correo"]);
                echo "true";
            }
            
            
        break;
    }
?>