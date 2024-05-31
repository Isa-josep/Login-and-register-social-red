<?php
require_once("../../config/conexion.php");
require_once("../../model/Producto.php");
$producto = new Producto();
$files = $producto->get_files();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normas PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .file-container {
            margin: 20px 0;
        }
        .file-container a {
            display: block;
            padding: 10px 15px;
            margin: 10px 0;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .file-container a:hover {
            background-color: #0056b3;
        }
        .no-files {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Archivos PDF</h1>
        <div class="file-container">
            <?php
            if (!empty($files)) {
                foreach ($files as $file) {
                    $filePath = $file['files_details_nom'];
                    $correctPath = "/login/" . ltrim(str_replace('../', '', $filePath), '/');
                    $fileName = basename($correctPath);
                    echo "<a href='$correctPath' target='_blank'>$fileName</a>";
                }
            } else {
                echo "<p class='no-files'>No hay archivos para mostrar.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
