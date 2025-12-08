<?php
require_once __DIR__ . '/../Model/Cita.php';

class CitaController {
    private $model;

    public function __construct() {
        $this->model = new Cita();
    }

    /** OBTENER TODAS LAS CITAS */
    public function index() {
        return $this->model->obtenerTodas();
    }

    /** AGREGAR CITA */
    public function guardar($data) {
        return $this->model->agregar($data);
    }

    /** EDITAR CITA */
    public function editar($data) {
        return $this->model->actualizar($data);
    }

    /** ELIMINAR CITA */
    public function eliminar($id) {
        return $this->model->eliminar($id);
    }

    /** OBTENER CITA POR ID (si algún día lo necesitas) */
    public function obtenerPorId($id) {
        return $this->model->obtenerPorId($id);
    }
}
?>
