<?php
    require_once("../../config/conexion.php");
    require_once("../../model/Usuario.php");
    $usuario= new Usuario();
    if(isset($_SESSION["usu_id"]) && count($_SESSION)>0 && $_SESSION["role_id"]==3){
        include_once '../html/shared/view_admin.php';
    }
    else if(isset($_SESSION["usu_id"]) && count($_SESSION)>0){
        include_once '../html/shared/view_user.php';
    }
    else if( $_SESSION["estado"]==2){
        header("Location:".Conectar::ruta()."index.php?m=6");
        exit(); 
    }
    else{
        header("Location:".Conectar::ruta()."index.php?m=5");
        exit();
    }
?>
