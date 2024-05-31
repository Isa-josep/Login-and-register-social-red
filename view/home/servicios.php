<?php
require_once("../../config/conexion.php");
require_once("../../model/Jefe.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

if (isset($_SESSION["usu_id"]) && $_SESSION["role_id"] >=1) {
    $jefe = new Jefe();
    $jefes = $jefe->getJefes();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Jefes</title>
        <link rel="stylesheet" href="static/css/styles.css"> 
    </head>
    <body>
        <div class="section-jefes">
            <?php
            if (count($jefes) > 0) {
                foreach ($jefes as $row) {
                    ?>
                    <div class="card-jefe">
                        <img src="static/icons/<?php echo (strpos($row['jefe_role'], 'Jefa') !== false) ? 'girl' : 'man'; ?>.png" alt="<?php echo $row['jefe_role']; ?>" class="img-jef">
                        <div class="info-jefe">
                            <h3 class="card-title-jef"><?php echo $row['jefe_nombre']; ?></h3>
                            <p class="card-content-jef">
                                <span><?php echo $row['jefe_role']; ?></span><br>
                                <a href="mailto:<?php echo $row['jefe_correo']; ?>">e-Mail: <?php echo $row['jefe_correo']; ?></a><br>
                                <span>Conmutador: <strong><?php echo $row['jefe_number']; ?></strong> <?php echo !empty($row['jefe_extension']) ? 'Extensión ' . $row['jefe_extension'] : ''; ?></span><br>
                                <span><?php echo $row['jefe_location']; ?></span><br>
                                <span>Horario de atención: 9:00 a 14:00 - 15:00 a 17:00.</span>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "0 resultados";
            }
            ?>
        </div>
    </body>
    </html>
    <?php
} else {
    header("Location:" . Conectar::ruta() . "index.php?m=8");
    exit();
}
?>
