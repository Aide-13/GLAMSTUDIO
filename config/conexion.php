<?php
class Conexion {
    private $host = "localhost";
    private $user = "root";
    private $pass = "Nutria1720*";
    private $db   = "glam_studio";

    public function conectar() {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        return $conn;
    }
}
