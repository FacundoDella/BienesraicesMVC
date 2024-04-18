<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController
{

    public static function index(Router $router) // Le paso la referencia del objeto Router instanciado ($router= new Router) en el index.php, para no perder la info y no instanciarlo de nuevo
    {
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;

        $vendedores = Vendedor::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
        ]);
    }
    public static function crear(Router $router)
    {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo de errores
        $errores = Propiedad::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crea una nueva instancia 
            $propiedad = new Propiedad($_POST['propiedad']);

            /* SUBIDA DE ARCHIVOS */


            // Generar nombre unico para cada imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen']);
                $image->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Validar
            $errores = $propiedad->validar();

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
                $resultado = $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        // Arreglo de errores  
        $errores = Propiedad::getErrores();


        // Ejecuta el codigo despues de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // Asignar los atributos nuevos enviados  a travez de $_POST
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);

            // Validacion
            $errores = $propiedad->validar();

            // Generar nombre unico para cada imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen']);
                $image->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            // Revisar que el array de errores este vacio
            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Almacenar la imagen 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores,
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
