CREATE TABLE `tm_usuario` (
    `usu_id` INT(10) NOT NULL AUTO_INCREMENT,
    `usu_nombre` VARCHAR(90) NOT NULL COLLATE 'utf8mb4_spanish_ci',
    `usu_correo` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_spanish_ci',
    `usu_pass` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_spanish_ci',
    `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `fecha_modi` DATETIME NULL DEFAULT NULL,
    `fecha_elim` DATETIME NULL DEFAULT NULL,
    `estado` INT(10) NOT NULL DEFAULT '2',
    PRIMARY KEY (`usu_id`) USING BTREE
) COLLATE='utf8mb4_spanish_ci' ENGINE=InnoDB AUTO_INCREMENT=24;
