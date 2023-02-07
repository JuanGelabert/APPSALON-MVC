<?php

namespace Controllers;

use MVC\Router;
use Model\AdminCita;

class AdminController {

    public static function index (Router $router)
    {   
        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate($fechas[1], $fechas[2], $fechas[0]) ) {
            header('Location: /404');
        }

        // Consultar base de datos
        $query = "SELECT turnos.id, turnos.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente, usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio ";
        $query .= "FROM turnos ";
        $query .= "LEFT OUTER JOIN usuarios ON turnos.usuarioId=usuarios.id ";
        $query .= "LEFT OUTER JOIN turnos_servicios ON turnos_servicios.turnoId=turnos.id ";
        $query .= "LEFT OUTER JOIN servicios ON servicios.id=turnos_servicios.servicioId ";
        $query .= "WHERE fecha = '$fecha'";
        
        $citas = AdminCita::SQL($query);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}