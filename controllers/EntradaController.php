<?php

namespace Controllers;

use Model\Entrada;
use MVC\Router;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class EntradaController
{

    public static function crear(Router $router)
    {

        $entrada = new Entrada;

        // Arreglo de errores
        $errores = Entrada::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crea una nueva instancia 
            $entrada = new Entrada($_POST['entrada']);

            /* SUBIDA DE ARCHIVOS */
            // Generar nombre unico para cada imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['entrada']['tmp_name']['imagen']);
                $image->cover(800, 600);
                $entrada->setImagen($nombreImagen);
            }

            // Validar
            $errores = $entrada->validar();

            // Revisar que el array de errores este vacio
            if (empty($errores)) {

                // Crear la carpeta
                $carpetaImagenes = '../../imagenes/';
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $resultado = $entrada->guardar();
            }
        }

        $router->render('entradas/crear', [
            "errores" => $errores,
            "entrada" => $entrada,
        ]);
    }
    public static function actualizar(Router $router)
    {
        // Valido mediante GET que exista un id
        $id = validarORedireccionar('/admin');
        $entrada = Entrada::find($id);
        // Arreglo de errores  
        $errores = Entrada::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los valores
            $args = $_POST['entrada'];
            // Sincronizar objeto en memoria con lo que el usuario escribio
            $entrada->sincronizar($args);
            // Validacion
            $errores = $entrada->validar();

            // Generar nombre unico para cada imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Subida de archivos
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['entrada']['tmp_name']['imagen']);
                $image->cover(800, 600);
                $entrada->setImagen($nombreImagen);
            }


            if (empty($errores)) {
                if ($_FILES['entrada']['tmp_name']['imagen']) {
                    // Almacenar la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $entrada->guardar();
            }
        }



        $router->render('/entradas/actualizar', [
            'errores' => $errores,
            'entrada' => $entrada,
        ]);
    }
    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que exista un id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $entrada = entrada::find($id);
                    $entrada->eliminar();
                }
            }
        }
    }
}
