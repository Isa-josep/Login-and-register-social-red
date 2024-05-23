<?php
// delete_user.php
require_once("../../config/conexion.php");
require_once("../../model/Usuario.php");

$usuario = new Usuario();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($usuario->eliminarUsuario($id)) {
        header("Location: panel_control.php"); // Redirige a la lista de usuarios después de eliminar
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    echo "ID de usuario no especificado.";
}
