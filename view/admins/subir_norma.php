<?php
require_once("../../config/conexion.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

if (isset($_SESSION["usu_id"]) && $_SESSION["role_id"] == 3) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Subir normas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="../../static/css/style.css"> -->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Subir normas Tec-export</h1>
                    <div class="form-group">
                    <form method="post" id="producto_form">
                        <label class="form-label" for="rule_names" >Nombre de la norma</label>
                        <input  type="text" name="rule_name" id="rule_name" class="form-control" placeholder="Ingrese el nombre de la norma">
                       
                    </div>
                    <div style="height: 20px;"></div>
                    
                        <div class="form-group">
                            <div class="dropzone">
                                <div class="dz-defaut dz-message">
                                    <!-- <span>Arrastra los archivos aquí para subirlos</span> -->
                                    <button class="dz-button" type="button">
                                        <img class="img-icon" src="../../assets/upload.png" alt="icon">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div style="height: 20px;"></div>
                        <button type="submit" class="btn btn-primary"> Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <script src="subir_norma.js"></script>
    </html>
    <?php
} else {
    header("Location:" . Conectar::ruta() . "index.php?m=7");
    exit();
}
?>
