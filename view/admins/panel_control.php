<?php
require_once("../../config/conexion.php");
require_once("../../model/Usuario.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}


$usuario = new Usuario();

if (isset($_SESSION["usu_id"]) && $_SESSION["role_id"] == 3) {
    $usuarios = $usuario->getUsuarios();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../home/static/img/_260c3a3f-b5a7-4736-b622-501bce489d78.jpeg" type="image/x-icon">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <h2>Lista de Usuarios</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Estado</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['usu_id']; ?></td>
                <td><?php echo $usuario['usu_nombre']; ?></td>
                <td><?php echo $usuario['usu_correo']; ?></td>
                <td><?php echo $usuario['estado']; ?></td>
                <td><?php echo $usuario['role_name']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $usuario['usu_id']; ?>">Editar</a> |
                    <a href="delete_user.php?id=<?php echo $usuario['usu_id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php?m=7");
    exit();
}
