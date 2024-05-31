<?php
require_once("../../config/conexion.php");
require_once("../../model/Jefe.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

if (isset($_SESSION["usu_id"]) && $_SESSION["role_id"] == 3) {
    $jefe = new Jefe();

    if (isset($_POST['add'])) {
        $jefe_nombre = $_POST['jefe_nombre'];
        $jefe_role = $_POST['jefe_role'];
        $jefe_correo = $_POST['jefe_correo'];
        $jefe_number = $_POST['jefe_number'];
        $jefe_extension = $_POST['jefe_extension'];
        $jefe_location = $_POST['jefe_location'];
        $jefe_hire_date = $_POST['jefe_hire_date'];

        $jefe->registrar_jefe($jefe_nombre, $jefe_role, $jefe_correo, $jefe_number, $jefe_extension, $jefe_location, $jefe_hire_date);
        header("Location: panel_control.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Jefe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input, textarea {
            margin-bottom: 10px;
            font-size: 1.1em;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 1.2em;
            color: #fff;
            background-color: #5cb85c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Agregar Nuevo Jefe</h2>
        <form method="POST">
            <label for="jefe_nombre">Nombre:</label>
            <input type="text" name="jefe_nombre" id="jefe_nombre" required>
            
            <label for="jefe_role">Rol:</label>
            <input type="text" name="jefe_role" id="jefe_role" required>
            
            <label for="jefe_correo">Correo:</label>
            <input type="email" name="jefe_correo" id="jefe_correo" required>
            
            <label for="jefe_number">Número:</label>
            <input type="text" name="jefe_number" id="jefe_number" required>
            
            <label for="jefe_extension">Extensión:</label>
            <input type="text" name="jefe_extension" id="jefe_extension">
            
            <label for="jefe_location">Ubicación:</label>
            <input type="text" name="jefe_location" id="jefe_location" required>
            
            <label for="jefe_hire_date">Fecha de contratación:</label>
            <input type="date" name="jefe_hire_date" id="jefe_hire_date" required>
            
            <input type="submit" name="add" value="Agregar">
        </form>
    </div>
</body>
</html>
<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php?m=7");
    exit();
}
?>
