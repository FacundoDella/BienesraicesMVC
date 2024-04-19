<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        // Se guarda en rutasGET, la URL como llave y la funcion como valor
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        // Se guarda en rutasPOST, la URL como llave y la funcion como valor
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];


        // Obtengo la URL que visite
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];


        if ($metodo === 'GET') {
            // Se ejecuta la funcion asociada a la URL actual
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if (in_array($urlActual,  $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            // La URL existe y hay una funcion asociada
            call_user_func($fn, $this); // Lee de manera dinamica el nombre de la funcion y la ejecuta, ya que el nombre peude variar
        } else {
            echo 'Pagina No Encontrada';
        }
    }

    // El codigo de arriba, lo que hace en resumen, es guardar en memoria la URL que visite el usuario (las cuales estan pre definidas),luego verifica que sea GET,para luego llamar de manera dinamica a una funcion u otra dependiendo de la url (las funciones se llaman en public/index.php)


    // Muestra una vista

    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value; // $$ (doble signo) = Variable de variable. Este codigo itera y genera variables con el nombre de los $key manteniendo el valor de cada uno
        }

        ob_start(); // Inicia un almacenamiento en memoria cuando se ejecuta esta funcion (render)
        include __DIR__ . "/views/$view.php"; // Y almacena este archivo, el cual puede cargar diferentes archivos, ya que es dinamico

        $contenido = ob_get_clean(); // Despues lo almacena en $contenido y limpia la memoria

        include __DIR__ . "/views/layout.php";
    }
}
