<?php

namespace Controllers;

use Model\Cita;
use MVC\Router;

class CitaController {
    
    public static function index(Router $router)
    {      
        isAuth();

        $id = $_SESSION['id'];
        $reservas = Cita::where('usuarioId', $id);

        foreach ($reservas as $reserva) {
            $reserva->fecha = date("d/m/Y", strtotime($reserva->fecha));
            $reserva->hora = date("H:i", strtotime($reserva->hora));
        }        


        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'reservas' => $reservas
        ]);
    }
}