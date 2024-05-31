<?php
class Jefe extends Conectar {
    public function getJefes() {
        $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
        parent::set_names(); // Establece los nombres de los caracteres

        $sql = "SELECT * FROM Jefes";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJefeById($jefe_id) {
        $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
        parent::set_names(); // Establece los nombres de los caracteres

        $sql = "SELECT * FROM Jefes WHERE jefe_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $jefe_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar_jefe($jefe_nombre, $jefe_role, $jefe_correo, $jefe_number, $jefe_extension, $jefe_location, $jefe_hire_date) {
        $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
        parent::set_names(); // Establece los nombres de los caracteres

        // Consulta para insertar un nuevo jefe
        $sql = "INSERT INTO Jefes 
                (jefe_nombre, jefe_role, jefe_correo, jefe_number, jefe_extension, jefe_location, jefe_hire_date) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?)";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $jefe_nombre);
        $sql->bindValue(2, $jefe_role);
        $sql->bindValue(3, $jefe_correo);
        $sql->bindValue(4, $jefe_number);
        $sql->bindValue(5, $jefe_extension);
        $sql->bindValue(6, $jefe_location);
        $sql->bindValue(7, $jefe_hire_date);
        $sql->execute();

        // Consulta para obtener el último ID insertado
        $sql1 = "SELECT LAST_INSERT_ID() as 'jefe_id'";
        $sql1 = $conectar->prepare($sql1);
        $sql1->execute();
        return $sql1->fetchAll();
    }

    public function modificar_jefe($jefe_id, $jefe_nombre, $jefe_role, $jefe_correo, $jefe_number, $jefe_extension, $jefe_location, $jefe_hire_date) {
        $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
        parent::set_names(); // Establece los nombres de los caracteres

        // Consulta para actualizar un jefe existente
        $sql = "UPDATE Jefes SET 
                jefe_nombre = ?, 
                jefe_role = ?, 
                jefe_correo = ?, 
                jefe_number = ?, 
                jefe_extension = ?, 
                jefe_location = ?, 
                jefe_hire_date = ? 
                WHERE jefe_id = ?";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $jefe_nombre);
        $sql->bindValue(2, $jefe_role);
        $sql->bindValue(3, $jefe_correo);
        $sql->bindValue(4, $jefe_number);
        $sql->bindValue(5, $jefe_extension);
        $sql->bindValue(6, $jefe_location);
        $sql->bindValue(7, $jefe_hire_date);
        $sql->bindValue(8, $jefe_id);
        $sql->execute();
    }

    public function eliminar_jefe($jefe_id) {
        $conectar = parent::conexion(); // Obtiene la conexión a la base de datos
        parent::set_names(); // Establece los nombres de los caracteres

        // Consulta para eliminar un jefe existente
        $sql = "DELETE FROM Jefes WHERE jefe_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $jefe_id);
        $sql->execute();
    }
}
?>
