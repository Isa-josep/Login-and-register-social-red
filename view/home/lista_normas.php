<?php
require_once("../../config/conexion.php");
require_once("../../model/Producto.php");
$producto = new Producto();
$files = $producto->get_files();


$folders = [];
foreach ($files as $file) {
    $filePath = str_replace('../', '', $file['files_details_nom']);
    $parts = explode('/', $filePath);
    $folderName = $parts[1];
    if (!isset($folders[$folderName])) {
        $folders[$folderName] = [];
    }
    $folders[$folderName][] = $filePath;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 50px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            margin-bottom: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .folder-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .folder-card {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: calc(33% - 20px);
            box-sizing: border-box;
            text-align: center;
        }
        .folder-card:hover {
            background-color: #0056b3;
        }
        .file-list {
            display: none;
            margin-top: 10px;
        }
        .file-list a {
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            background-color: #f4f4f4;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        .file-list a:hover {
            background-color: #ddd;
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
        <div class="folder-container">
            <?php
            if (!empty($folders)) {
                foreach ($folders as $folderName => $files) {
                    echo "<div class='folder-card' onclick='toggleFiles(\"$folderName\")'>$folderName</div>";
                    echo "<div id='$folderName' class='file-list'>";
                    foreach ($files as $filePath) {
                        $correctPath = "/login/" . $filePath;
                        $fileName = basename($correctPath);
                        echo "<a href='$correctPath' target='_blank'>$fileName</a>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<p class='no-files'>No hay archivos para mostrar.</p>";
            }
            ?>
        </div>
    </div>
    <script>
        function toggleFiles(folderId) {
            const fileList = document.getElementById(folderId);
            if (fileList.style.display === "none" || fileList.style.display === "") {
                fileList.style.display = "block";
            } else {
                fileList.style.display = "none";
            }
        }
    </script>
</body>
</html>
