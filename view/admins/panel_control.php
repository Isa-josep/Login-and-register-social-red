<?php
require_once("../../config/conexion.php");
require_once("../../model/Usuario.php");
require_once("../../model/Jefe.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

$usuario = new Usuario();
$jefe = new Jefe();

if (isset($_SESSION["usu_id"]) && $_SESSION["role_id"] == 3) {
    $usuarios = $usuario->getUsuarios();
    $jefes = $jefe->getJefes();
    $nombre_usuario = $_SESSION["usu_nombre"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../home/static/img/_260c3a3f-b5a7-4736-b622-501bce489d78.jpeg" type="image/x-icon">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>Bienvenido, <?php echo $nombre_usuario; ?></h1>
    
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

    <h2>Lista de Jefes</h2>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Correo electrónico</th>
            <th>Extensión</th>
            <th>Ubicación</th>
            <th>Fecha de contratación</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($jefes as $jefe): ?>
            <tr>
                <td><?php echo $jefe['jefe_nombre']; ?></td>
                <td><?php echo $jefe['jefe_role']; ?></td>
                <td><?php echo $jefe['jefe_correo']; ?></td>
                <td><?php echo $jefe['jefe_extension']; ?></td>
                <td><?php echo $jefe['jefe_location']; ?></td>
                <td><?php echo $jefe['jefe_hire_date']; ?></td>
                <td>
                    <a href="edit_jefe.php?id=<?php echo $jefe['jefe_id']; ?>">Editar</a> |
                    <a href="delete_jefe.php?id=<?php echo $jefe['jefe_id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="sizedbox"></div>
    <a href="add_jefe.php" class="btn">Agregar Nuevo Jefe</a>
</body>
</html>
<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php?m=7");
    exit();
}
?>
