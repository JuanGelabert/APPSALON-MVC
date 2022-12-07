<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];

            $usuario = Usuario::where('email', $email);

            if ($usuario) {
                
            } else {
                # code...
            }
            

        }

        $router->render('auth/login', [

        ]);       
    }
    public static function crear(Router $router) {

        $usuario = new Usuario;

        // Alertras vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)) {

                // Verificar que el usuario no está registrado
                $resultado = $usuario->existeUsuario();

                // Si esta registrado muestra alerta
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear password
                    $usuario->hashPassword();

                    // Generar token unico
                    $usuario->crearToken();

                    // Enviar el email de confirmación
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    
                    // Crear el usuario
                    $resultado = $usuario->guardar();
 
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function logout() {
        
    }
    public static function olvide(Router $router) {

        
        
        $router->render('auth/olvide-password', [

        ]);
    }

    public static function recuperar() {
        
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }

    public  static function confirmar(Router $router)
    {

        $alertas = [];

        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            // Modifica al usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
