<?php
require_once("../../config/conexion.php");
require_once("../../model/Usuario.php");

$usuario = new Usuario();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //TODO: obtener los datos del formulario
    $id = $_POST['usu_id'];
    $nombre = $_POST['usu_nombre'];
    $correo = $_POST['usu_correo'];
    $estado = $_POST['estado'];
    $role_id = $_POST['role_id'];

    //TODO: Llama a la función actualizarUsuario del model
    if ($usuario->actualizarUsuario($id, $nombre, $correo, $estado, $role_id)) {
        header("Location: panel_control.php"); //TODO: Redirige a la lista de usuarios después de actualizar
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }
}
