<?php

namespace Model;

use Model\ActiveRecord;

class CitaServicio extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'turnos_servicios';
    protected static $columnasDB = ['id', 'servicioId', 'turnoId'];

    public $id;
    public $servicioId;
    public $turnoId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->servicioId = $args['servicioId'] ?? '';
        $this->turnoId = $args['turnoId'] ?? '';
    }
}