<?php
require_once __DIR__ . '/../../config/conexion.php';

class Cita {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
    }

    /** =====================================
     * OBTENER TODAS LAS CITAS
     * ===================================== */
    public function obtenerTodas() {
        return $this->conn->query("SELECT * FROM citas ORDER BY fecha ASC, hora ASC");
    }

    /** =====================================
     * VALIDAR FORMATO DE FECHA (Y-m-d)
     * ===================================== */
    private function validarFecha($fecha) {
        return preg_match("/^\d{4}-\d{2}-\d{2}$/", $fecha);
    }

    /** =====================================
     * VALIDAR FORMATO DE HORA (H:i)
     * ===================================== */
    private function validarHora($hora) {
        return preg_match("/^\d{2}:\d{2}$/", $hora);
    }

    /** =====================================
     * AGREGAR CITA
     * ===================================== */
    public function agregar($data) {

        if (!$this->validarFecha($data['fecha'])) {
            throw new Exception("Fecha inválida");
        }

        if (!$this->validarHora($data['hora'])) {
            throw new Exception("Hora inválida");
        }

        $stmt = $this->conn->prepare("
            INSERT INTO citas (nombre, apellidos, telefono, servicio, descripcion, fecha, hora)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssssss",
            $data['nombre'],
            $data['apellidos'],
            $data['telefono'],
            $data['servicio'],
            $data['descripcion'],
            $data['fecha'],
            $data['hora']
        );

        return $stmt->execute();
    }

    /** =====================================
     * ELIMINAR CITA
     * ===================================== */
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    /** =====================================
     * OBTENER UNA CITA POR ID
     * ===================================== */
    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /** =====================================
     * ACTUALIZAR CITA
     * ===================================== */
    public function actualizar($data) {

        if (!$this->validarFecha($data['fecha'])) {
            throw new Exception("Fecha inválida");
        }

        if (!$this->validarHora($data['hora'])) {
            throw new Exception("Hora inválida");
        }

        $stmt = $this->conn->prepare("
            UPDATE citas 
            SET nombre=?, apellidos=?, telefono=?, servicio=?, descripcion=?, fecha=?, hora=?
            WHERE id=?
        ");

        $stmt->bind_param(
            "sssssssi",
            $data['nombre'],
            $data['apellidos'],
            $data['telefono'],
            $data['servicio'],
            $data['descripcion'],
            $data['fecha'],
            $data['hora'],
            $data['id']
        );

        return $stmt->execute();
    }
}
?>
