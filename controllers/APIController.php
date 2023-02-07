<?php
namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController {

    public static function index()
    {   
        isAuth();
        
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar()
    {   
        // Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $disponible = $cita->disponible();

        if ($disponible) {
            $resultado = $cita->guardar();
            $idCita = $resultado['id'];

            // Almacena los ID de servicios con el ID de la cita
            $idServicios = explode(",", $_POST['servicios']);
            foreach ($idServicios as $idServicio) {
                $args = [
                    'servicioId' => $idServicio,
                    'turnoId' => $idCita
                ];
                $citaServicio = new CitaServicio($args);
                $citaServicio->guardar();
            }

            echo json_encode(['exito' => $resultado]);
        } else {
            echo json_encode(['error' => 'El turno no está disponible. Intenta reservar en otro horario']);
        }      
    }

    public static function eliminar() {

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

            // Busca el registro y lo elimina de la BD
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}