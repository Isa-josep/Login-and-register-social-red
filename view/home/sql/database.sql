DROP DATABASE IF EXISTS Tec_export; -- Eliminar la base de datos si existe opcional

CREATE DATABASE Tec_export;
USE Tec_export;

CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) UNIQUE
);

INSERT INTO roles (role_name) VALUES 
('user'),
('admin'),
('super_admin');

CREATE TABLE `tm_usuario` (
	`usu_id` INT(10) NOT NULL AUTO_INCREMENT,
	`usu_nombre` VARCHAR(90) NOT NULL COLLATE 'utf8mb3_spanish_ci',
	`usu_correo` VARCHAR(50) NOT NULL COLLATE 'utf8mb3_spanish_ci',
	`usu_pass` VARCHAR(250) NOT NULL COLLATE 'utf8mb3_spanish_ci',
	`fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`fecha_modi` DATETIME NULL DEFAULT NULL,
	`fecha_elim` DATETIME NULL DEFAULT NULL,
	`fecha_activate` DATETIME NULL DEFAULT NULL,
	`estado` INT(10) NOT NULL DEFAULT '2',
	`role_id` INT NOT NULL DEFAULT '1',
	PRIMARY KEY (`usu_id`) USING BTREE,
	FOREIGN KEY (`role_id`) REFERENCES roles(`role_id`)
);
