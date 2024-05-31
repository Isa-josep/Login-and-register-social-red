<?php
    require_once("../../config/conexion.php");
    require_once("../../model/Usuario.php");
    $usuario= new Usuario();
    //TODO: Verificar si la sesión está iniciada y si el rol es de administrador
    if(isset($_SESSION["usu_id"]) && count($_SESSION)>0 && $_SESSION["role_id"]==3){
        //TODO: si su rol es administrados se carga la vista de administrador
        include_once '../html/shared/view_admin.php';
    }
    //TODO: si su rol es de usuario se carga la vista de usuario
    else if(isset($_SESSION["usu_id"]) && count($_SESSION)>0){

        include_once '../html/shared/view_user.php';
    }
    //TODO: si su cuenta está deshabilitada se redirige a la página de inicio
    else if( $_SESSION["estado"]==2){
        header("Location:".Conectar::ruta()."index.php?m=6");
        exit(); 
    }
    else{
        header("Location:".Conectar::ruta()."index.php?m=5");
        exit();
    }
?>
