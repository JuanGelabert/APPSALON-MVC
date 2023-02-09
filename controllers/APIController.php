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

            $id = $_POST['id'];
        
            //Busca los registros en la tabla turnos_servicios y los almacena en un arreglo de objetos
            $citaServicio = CitaServicio::where('turnoId', $id);
            
            // Itera el arreglo de objetos eliminando cada registro en la BD
            foreach ($citaServicio as $registro) {
                $registro->eliminar();
            }

            // Busca el registro de la cita y lo elimina de la BD
            $cita = Cita::find($id);
            $cita->eliminar();


            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}