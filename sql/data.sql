--TODO: Eliminar la base de datos si existe
DROP DATABASE IF EXISTS Tec_export;

--TODO: Crear la base de datos
CREATE DATABASE Tec_export;
USE Tec_export;

--TODO: Crear la tabla roles para definir los diferentes roles de usuario
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY, --TODO: Identificador único para cada rol
    role_name VARCHAR(50) UNIQUE --TODO: Nombre del rol, debe ser único
);

--TODO: Insertar roles en la tabla roles
INSERT INTO roles (role_name) VALUES 
('user'),
('admin'),
('super_admin');

--TODO: Crear la tabla tm_usuario para almacenar la información de los usuarios
CREATE TABLE `tm_usuario` (
    `usu_id` INT(10) NOT NULL AUTO_INCREMENT, --TODO: Identificador único para cada usuario
    `usu_nombre` VARCHAR(90) NOT NULL COLLATE 'utf8mb3_spanish_ci', --TODO: Nombre del usuario
    `usu_correo` VARCHAR(50) NOT NULL COLLATE 'utf8mb3_spanish_ci', --TODO: Correo electrónico del usuario
    `usu_pass` VARCHAR(250) NOT NULL COLLATE 'utf8mb3_spanish_ci', --TODO: Contraseña del usuario (hash)
    `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, --TODO: Fecha de creación del registro
    `fecha_modi` DATETIME NULL DEFAULT NULL, --TODO: Fecha de modificación del registro
    `fecha_elim` DATETIME NULL DEFAULT NULL, --TODO: Fecha de eliminación del registro
    `fecha_activate` DATETIME NULL DEFAULT NULL, --TODO: Fecha de activación del registro
    `estado` INT(10) NOT NULL DEFAULT '2', --TODO: Estado del usuario
    `role_id` INT NOT NULL DEFAULT '1', --TODO: Identificador del rol del usuario (clave foránea)
    PRIMARY KEY (`usu_id`) USING BTREE, --TODO: Definir la clave primaria
    FOREIGN KEY (`role_id`) REFERENCES roles(`role_id`) --TODO: Definir la clave foránea para role_id
);

--TODO: Insertar datos en la tabla tm_usuario
INSERT INTO tm_usuario (usu_nombre, usu_correo, usu_pass, role_id, estado) VALUES 
('Isauro Jose', 'isaurini1902@gmail.com', 'ztTljwMIJM/HkvW/noFjw22gwufnF6OWbbSgJl1cldQ=', 3, 1),
('Mta Melica', 'melica.vc@uruapan.tecnm.mx', '+C80o3NNrME4GfeNFCe/5r24hK6GZnreJzIj45eVeqs=', 3, 1);

--TODO: Crear la tabla Jefes para almacenar información sobre los jefes en la organización
CREATE TABLE Jefes (
    jefe_id INT AUTO_INCREMENT PRIMARY KEY, --TODO: Identificador único para cada jefe
    jefe_nombre VARCHAR(50) NOT NULL, --TODO: Nombre del jefe
    jefe_role VARCHAR(150) NOT NULL, --TODO: Rol del jefe
    jefe_correo VARCHAR(50) NOT NULL, --TODO: Correo electrónico del jefe
    jefe_number VARCHAR(15) NOT NULL, --TODO: Número de contacto del jefe
    jefe_extension VARCHAR(10), --TODO: Extensión telefónica del jefe (opcional)
    jefe_location VARCHAR(150) NOT NULL, --TODO: Ubicación del jefe
    jefe_hire_date DATE NOT NULL --TODO: Fecha de contratación del jefe
);

--TODO: Crear la tabla rules para definir las reglas del sistema
create table rules(
    rule_id int primary key auto_increment, --TODO: Identificador único para cada regla
    rule_name varchar(255) --TODO: Nombre de la regla
);

--TODO: Crear la tabla files_details para almacenar detalles de archivos asociados con las reglas
create table files_details(
    files_details_id int primary key auto_increment, --TODO: Identificador único para cada detalle de archivo
    rule_id int, --TODO: Identificador de la regla asociada (clave foránea)
    files_details_nom varchar(255) --TODO: Nombre del archivo
);

--TODO: se agregan los datos de los jefes de carrera 
INSERT INTO Jefes (jefe_nombre, jefe_role, jefe_correo, jefe_number, jefe_extension, jefe_location, jefe_hire_date) VALUES
('M.E. Suzel Rivera González', 'Jefa del departamento de sistemas', 'suzel.rv@uruapan.tecnm.mx', '4525275050', '0502', 'Edificio A Planta Alta', '2020-01-15'),
('M.A. Marina Cazorla García', 'Jefa de División', 'marinazazorla@tecuruapan.edu.mx', '4525275050', NULL, 'Edificio F Planta Baja', '2019-05-10'),
('Ing. Carlos Castillo Arévalo', 'Jefe de Ingenieria Electronica', 'carlos.ca@uruapan.tecnm.mx', '4525275050', '0503', 'Edificio D Planta Alta', '2018-09-20'),
('IIA. Katia Gayosso Suárez', 'Jefa de Ingenieria Industrias Alimentarias', 'katiagayosso@tecuruapan.edu.mx', '4525275050', NULL, 'Edificio D Planta Alta', '2017-07-11'),
('Ing. Raúl Alvarado Guerra', 'Jefe de Departamento', 'raulalvarado@tecuruapan.edu.mx', '4525275050', NULL, 'Edificio A Planta Baja', '2016-03-05'),
('Juan Carlos Camarillo Pacheco', 'Jefe de Departamento', 'juan.cp@uruapan.tecnm.mx', '4525275050', NULL, 'Edificio F Planta Baja', '2015-11-30'),
('Ing. Julio César Cuevas Soto', 'Jefe de Departamento', 'juliocuevas@tecuruapan.edu.mx', '4525275050', NULL, 'Edificio B Planta Alta', '2014-06-25');

create table rules(
    rule_id int primary key auto_increment,
    rule_name varchar(255) 
);

create table files_details(
    files_details_id int primary key auto_increment,
    rule_id int ,
    files_details_nom varchar(255) 
);


--TODO: Consultar todos los registros de la tabla tm_usuario
SELECT * FROM tm_usuario;
