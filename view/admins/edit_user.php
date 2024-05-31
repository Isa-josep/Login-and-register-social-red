<?php
require_once("../../config/conexion.php");
require_once("../../model/Usuario.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

if (isset($_SESSION["usu_id"]) && $_SESSION["role_id"] == 3) {
    $usuario = new Usuario();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuarioData = $usuario->getUsuarioById($id); 

        if ($usuarioData) {
            $roles = $usuario->getRoles();
            ?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Editar Usuarios</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f2f2f2;
                    }

                    h2 {
                        color: #333;
                        text-align: center;
                    }

                    form {
                        max-width: 400px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }

                    label {
                        display: block;
                        margin-bottom: 8px;
                        font-weight: bold;
                    }

                    input[type="text"],
                    input[type="email"],
                    select {
                        width: calc(100% - 20px);
                        padding: 10px;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }

                    button {
                        width: 100%;
                        padding: 10px;
                        background-color: #4CAF50;
                        color: #fff;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    button:hover {
                        background-color: #45a049;
                    }
                </style>
            </head>    
            <body>
                <h2>Editar Usuario</h2>

                <form method="post" action="actualizar_user.php"> 
                    <input type="hidden" name="usu_id" value="<?php echo $usuarioData['usu_id']; ?>">

                    <label for="usu_nombre">Nombre:</label>
                    <input type="text" id="usu_nombre" name="usu_nombre" value="<?php echo $usuarioData['usu_nombre']; ?>" required><br><br>

                    <label for="usu_correo">Correo Electrónico:</label>
                    <input type="email" id="usu_correo" name="usu_correo" value="<?php echo $usuarioData['usu_correo']; ?>" required><br><br>

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
} else {
    header("Location:" . Conectar::ruta() . "index.php?m=7");
    exit();
}
?>
