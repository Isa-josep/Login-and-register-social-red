<?php
require_once("../config/conexion.php");
require_once("../model/Producto.php");
$producto = new Producto();

switch($_GET["op"]){
    case "insert":
        $rule_name = $_POST["rule_name"];
        $datos = $producto->insert_producto($rule_name);

        if (empty($_FILES["file"]["name"][0])) {
            //TODO: No se han subido archivos
        } else {
            foreach ($datos as $row) {
                $countfiles = count($_FILES["file"]["name"]);
                //TODO: cambiar espacio por guion bajo
                $rule_name_sanitized = preg_replace('/[^a-zA-Z0-9_]/', '_', $rule_name);
                $ruta = "../assets/" . $rule_name_sanitized . "/";

                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }

                for ($index = 0; $index < $countfiles; $index++) {
                    $filename = $_FILES["file"]["name"][$index];
                    $tmp_filename = $_FILES["file"]["tmp_name"][$index];
                    $destino = $ruta . $filename;

                    if (move_uploaded_file($tmp_filename, $destino)) {
                        $producto->insert_file($row["rule_id"], $destino); // Guardar la ruta del archivo en la base de datos
                    } else {
                        echo "Error al mover el archivo: $filename";
                    }
                }
            }
        }
        echo json_encode($datos);
    break;
    case "get_files":
        $datos = $producto->get_files();
        echo json_encode($datos);
    break;
}
?>
