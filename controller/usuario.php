<?php
    //TODO: Se requieren los archivos de configuración y modelos
    require_once("../config/conexion.php");
    require_once("../model/Usuario.php");
    require_once("../model/Email.php");

    //TODO: Se crean instancias de las clases Usuario y Email
    $usuario = new Usuario();
    $email = new Email();

    //TODO: Se utiliza un switch para determinar la operación a realizar según el valor de $_GET["op"]
    switch($_GET["op"]){
        case "registrar":
            //TODO: Se obtienen los datos del usuario y correo ingresados
            $datos= $usuario->get_usuario_correo($_POST["usu_correo"]);

            //TODO: Se verifica si los datos ya existen en la base de datos
            if(is_array($datos)== true and count($datos)==0){
                //TODO: Si los datos no existen, se registra el usuario en la base de datos
                $datos1 = $usuario->registrar_usuario($_POST["usu_nombre"], $_POST["usu_correo"], $_POST["usu_pass"]);

                //TODO: Se envía un correo de registro al usuario
                $email->registrar($datos1[0]["usu_id"]);

                //TODO: Se muestra un mensaje de éxito
                echo "OK";
            }
            else{
                //TODO: Si los datos ya existen, se muestra un mensaje de duplicado
                echo "Data Duplicada";
            }
        break;
        case "activate":
            //TODO: Se activa el usuario en la base de datos según el id proporcionado
            $usuario->activate_user($_POST["usu_id"]);

            //TODO: Se muestra "OK" si la operación fue exitosa
            echo "OK";
        break;
    }
?>