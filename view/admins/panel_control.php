<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../home/static/img/_260c3a3f-b5a7-4736-b622-501bce489d78.jpeg" type="image/x-icon">
    <title>Panel de Control</title>
</head>
<body>
    
</body>
</html>

<?php
    require_once("../../config/conexion.php");
    require_once("../../model/Usuario.php");
    $usuario= new Usuario();
    if(isset($_SESSION["usu_id"]) && count($_SESSION)>0 && $_SESSION["role_id"]==3){
    $db = new mysqli('localhost', 'root', '', 'tec_export');
    $sql = "SELECT tm_usuario.*, roles.role_name 
            FROM tm_usuario 
            JOIN roles ON tm_usuario.role_id = roles.role_id";
        $result = $db->query($sql);

        // Mostrar los usuarios en una tabla
        if ($result->num_rows > 0) {
            echo '<link rel="stylesheet" href="style.css">';
            echo '<table>';
            echo '<tr><th>ID</th><th>Nombre</th><th>Correo electrónico</th><th>Estado</th><th>Rol</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['usu_id'] . '</td>';
                echo '<td>' . $row['usu_nombre'] . '</td>';
                echo '<td>' . $row['usu_correo'] . '</td>';
                echo '<td>' . $row['estado'] . '</td>';
                echo '<td>' . $row['role_name'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No hay usuarios registrados.';
        }
        $db->close();
    }
    else{
        header("Location:".Conectar::ruta()."index.php?m=7");
        exit();
    }
?>