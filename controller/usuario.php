<?php
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");

    $usuario = new Usuario();
    switch($_GET["op"]){
        case "registrar":
            $usuario->registrar_usuario($_POST["usu_nombre"], $_POST["usu_correo"], $_POST["usu_pass"]);
        break;
    }
?>