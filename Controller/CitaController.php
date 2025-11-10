<?php
require_once __DIR__ . '/../Model/Cita.php';

class CitaController {
    private $model;

    public function __construct() {
        $this->model = new Cita();
    }

    public function index() {
        return $this->model->obtenerTodas();
    }

    public function guardar($data) {
        return $this->model->agregar($data);
    }

    public function actualizar($data) {
        return $this->model->actualizar($data);
    }

    public function eliminar($id) {
        return $this->model->eliminar($id);
    }

    public function obtenerPorId($id) {
        return $this->model->obtenerPorId($id);
    }
}
?>
