<?php
require_once("../../config/conexion.php");
require_once("../../model/Jefe.php");

if (isset($_GET['id'])) {
    $jefe_id = $_GET['id'];
    $jefe = new Jefe();
    $data = $jefe->getJefeById($jefe_id);

    if (isset($_POST['update'])) {
        $jefe_nombre = $_POST['jefe_nombre'];
        $jefe_role = $_POST['jefe_role'];
        $jefe_correo = $_POST['jefe_correo'];
        $jefe_number = $_POST['jefe_number'];
        $jefe_extension = $_POST['jefe_extension'];
        $jefe_location = $_POST['jefe_location'];
        $jefe_hire_date = $_POST['jefe_hire_date'];

        $jefe->modificar_jefe($jefe_id, $jefe_nombre, $jefe_role, $jefe_correo, $jefe_number, $jefe_extension, $jefe_location, $jefe_hire_date);
        header("Location: panel_control.php");
    }
} else {
    header("Location: panel_control.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jefe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Editar Jefe</h2>
    <form method="POST">
        Nombre: <input type="text" name="jefe_nombre" value="<?php echo $data['jefe_nombre']; ?>"><br>
        Rol: <input type="text" name="jefe_role" value="<?php echo $data['jefe_role']; ?>"><br>
        Correo: <input type="email" name="jefe_correo" value="<?php echo $data['jefe_correo']; ?>"><br>
        Número: <input type="text" name="jefe_number" value="<?php echo $data['jefe_number']; ?>"><br>
        Extensión: <input type="text" name="jefe_extension" value="<?php echo $data['jefe_extension']; ?>"><br>
        Ubicación: <input type="text" name="jefe_location" value="<?php echo $data['jefe_location']; ?>"><br>
        Fecha de contratación: <input type="date" name="jefe_hire_date" value="<?php echo $data['jefe_hire_date']; ?>"><br>
        <input type="submit" name="update" value="Actualizar">
    </form>
</body>
</html>
