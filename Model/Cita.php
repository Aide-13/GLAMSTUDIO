<?php
require_once __DIR__ . '/../Config/conexion.php';

class Cita {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
    }

    public function obtenerTodas() {
        return $this->conn->query("SELECT * FROM citas");
    }

    public function agregar($data) {
        $stmt = $this->conn->prepare("INSERT INTO citas (nombre, apellidos, telefono, servicio, descripcion, fecha, hora) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $data['nombre'], $data['apellidos'], $data['telefono'], $data['servicio'], $data['descripcion'], $data['fecha'], $data['hora']);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizar($data) {
        $stmt = $this->conn->prepare("UPDATE citas SET nombre=?, apellidos=?, telefono=?, servicio=?, descripcion=?, fecha=?, hora=? WHERE id=?");
        $stmt->bind_param("sssssssi", $data['nombre'], $data['apellidos'], $data['telefono'], $data['servicio'], $data['descripcion'], $data['fecha'], $data['hora'], $data['id']);
        return $stmt->execute();
    }
}
?>
