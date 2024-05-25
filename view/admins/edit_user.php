<?php
require_once("../../config/conexion.php");
require_once("../../model/Usuario.php");

$usuario = new Usuario();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuarioData = $usuario->getUsuarioById($id); 

    if ($usuarioData) {
        $roles = $usuario->getRoles();
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Editar Usuarios</title>
            <link rel="stylesheet" href="style.css"> 
        </head>    
        <body>
            <h2>Editar Usuario</h2>

            <form method="post" action="actualizar_user.php"> 
                <input type="hidden" name="usu_id" value="<?php echo $usuarioData['usu_id']; ?>">

                <label for="usu_nombre">Nombre:</label>
                <input type="text" id="usu_nombre" name="usu_nombre" value="<?php echo $usuarioData['usu_nombre']; ?>"><br><br>

                <label for="usu_correo">Correo Electrónico:</label>
                <input type="email" id="usu_correo" name="usu_correo" value="<?php echo $usuarioData['usu_correo']; ?>"><br><br>

                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="1" <?php echo ($usuarioData['estado'] == 1) ? 'selected' : ''; ?>>Activo</option>
                    <option value="0" <?php echo ($usuarioData['estado'] == 0) ? 'selected' : ''; ?>>Inactivo</option>
                </select><br><br>

                <label for="role_id">Rol:</label>
                <select id="role_id" name="role_id">
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['role_id']; ?>" <?php echo ($rol['role_id'] == $usuarioData['role_id']) ? 'selected' : ''; ?>>
                            <?php echo $rol['role_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

                <button type="submit">Actualizar</button>
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "ID de usuario no especificado.";
}
