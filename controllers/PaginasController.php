<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Entrada;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{


    public static function index(Router $router)
    {

        $propiedades = Propiedad::get(3);
        $entradas = Entrada::get(2);
        $entradaDescripcion = false;
        $inicio = true; // Esta es la propiedad que requiere el layout.php para que funcione bien el header

        $router->render('/paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'entradas' => $entradas,
            'entradaDescripcion' => $entradaDescripcion,
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
        $entradaDescripcion = true;
        $entradas = Entrada::all();
        $router->render('/paginas/blog', [
            'entradas' => $entradas,
            'entradaDescripcion' => $entradaDescripcion,
        ]);
    }

    public static function entrada(Router $router)
    {

        $id = validarORedireccionar('/blog');
        $entrada = Entrada::find($id);

        $router->render('/paginas/entrada', [
            'entrada' => $entrada,
        ]);
    }

    public static function contacto(Router $router)
    {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP (protocolo para enviar emails)
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'a5894295f2d27e';
            $mail->Password = '84c15d6b963db0';
            $mail->SMTPSecure = 'tls';

            // Configurando el contenido del mail
            $mail->setFrom('admin@bienesraices.com'); // Quien envia el email
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); // Quien lo recibe
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre:  ' . $respuestas['nombre'] . ' </p>';
            $contenido .= '<p>Mensaje:  ' . $respuestas['mensaje'] . ' </p>';

            // Enviar de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] == 'telefono') {
                $contenido .= '<p>Eligió ser contactado por Teléfono:</p>';
                $contenido .= '<p>Teléfono:  ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha de contacto:  ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora:  ' . $respuestas['hora'] . ' </p>';
            } else {
                $contenido .= '<p>Eligió ser contactado por Email:</p>';
                $contenido .= '<p>Email:  ' . $respuestas['email'] . ' </p>';
            }
            $contenido .= '<p>Vende o Compra:  ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto:  $' . $respuestas['precio'] . ' </p>';
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';


            if ($mail->send()) {
                $mensaje = "Mensaje enviado Correctamente";
            } else {
                $mensaje =  "El mensaje no se pudo enviar...";
            }
        }

        $router->render('/paginas/contacto', [
            'mensaje' => $mensaje,
        ]);
    }
}
