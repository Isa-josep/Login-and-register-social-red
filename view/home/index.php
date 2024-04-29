<?php
    require_once("../../config/conexion.php");
    require_once("../../model/Usuario.php");
    $usuario= new Usuario();
    if(isset($_SESSION["usu_id"]) && count($_SESSION)>0){
        
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1></h1>Bienvenido <?php echo $_SESSION["usu_nombre"];?></h1>
    </body>
    </html>
    <?php
    }
    else{
        header("Location:".Conectar::ruta()."index.php?m=5");
        exit();
    }
?>