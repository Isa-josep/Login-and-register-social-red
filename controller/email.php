<?php
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");
    require_once("../model/Email.php");
    $usuario = new Usuario();
    $email = new Email();
    switch($_GET["op"]){
        case "recuperar":
            $email->recovery($_POST["usu_correo"]);
            
        break;
    }
?>