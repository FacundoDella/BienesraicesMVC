<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{


    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $inicio = true; // Esta es la propiedad que requiere el layout.php para que funcione bien el header

        $router->render('/paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('/paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('/paginas/propiedades', [
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router)
    {

        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad,
        ]);
    }

    public static function blog(Router $router)
    {

        $router->render('/paginas/blog');
    }

    public static function entrada(Router $router)
    {

        $router->render('/paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP (protocolo para enviar emails)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // El Host tomado desde MailTrap
            $mail->SMTPAuth = true;
            $mail->Username = 'a5894295f2d27e';
            $mail->Password = '********3db0';
            $mail->SMTPSecure = 'tls'; // Encriptacion
            $mail->Port = 2525; // Puerto

            // Configurando el contenido del mail
            $mail->setFrom('admin@bienesraices.com'); // Quien envia el email
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); // Quien lo recibe
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html> <p> Tienes un nuevo mensaje </p> </html>';

            $mail->Body = $contenido;


            if ($mail->send()) {
                echo "Mensaje enviado Correctamente";
            } else {
                echo "El mensaje no se pudo enviar...";
            }
        }

        $router->render('/paginas/contacto', []);
    }
}
