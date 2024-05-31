<?php
require_once("../../config/conexion.php");
require_once("../../model/Jefe.php");

if (isset($_GET['id'])) {
    $jefe_id = $_GET['id'];
    $jefe = new Jefe();
    $jefe->eliminar_jefe($jefe_id);
    header("Location: panel_control.php");
} else {
    header("Location: panel_control.php");
}
?>
