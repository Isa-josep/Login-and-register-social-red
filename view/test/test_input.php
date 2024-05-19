<?php
// Asegúrate de usar el mismo nombre "file" que en el formulario HTML
if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name']; // Nombre del archivo
    $fileSize = $_FILES['file']['size']; // Tamaño del archivo
    $fileTmpName = $_FILES['file']['tmp_name']; // Archivo temporal

    $ruta = "test2/" . $fileName;

    // Función que copia el archivo a la carpeta
    if (move_uploaded_file($fileTmpName, $ruta)) {
        echo "El archivo se subió correctamente.";
    } else {
        echo "Hubo un error al subir el archivo.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}
?>
