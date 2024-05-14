<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Tec_export";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta a la tabla Jefes
$sql = "SELECT * FROM Jefes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jefes</title>
    <link rel="stylesheet" href="static/css/styles.css"> 
<body>
    <div class="section-jefes">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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
        $conn->close();
        ?>
    </div>
</body>
</html>
