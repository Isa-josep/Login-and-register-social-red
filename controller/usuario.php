<?php
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");
    require_once("../model/Email.php");
    $usuario = new Usuario();
    $email = new Email();
    switch($_GET["op"]){
        case "registrar":
            $datos= $usuario->get_usuario_correo($_POST["usu_correo"]);
            if(is_array($datos)== true and count($datos)==0){
                $datos1 = $usuario->registrar_usuario($_POST["usu_nombre"], $_POST["usu_correo"], $_POST["usu_pass"]);
                //TODO mensaje de depuracion para verificar si se esta enviando los datos
                $email->registrar($datos1[0]["usu_id"]);
                echo "OK";
            }
            else{
                echo "Data Duplicada";
            }
        break;
        case "activate":
            $usuario->activate_user($_POST["usu_id"]);
            echo "OK";
        break;
    }
?>