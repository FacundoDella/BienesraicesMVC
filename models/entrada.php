<?php

namespace Model;

class Entrada extends ActiveRecord
{

    protected static $tabla = 'entradas';
    protected static $columnasDB = ['id', 'titulo', 'subtitulo', 'imagen', 'descripcion', 'creador', 'creado'];

    public $id;
    public $titulo;
    public $subtitulo;
    public $imagen;
    public $descripcion;
    public $creador;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->subtitulo = $args['subtitulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->creador = $args['creador'] ?? '';
        $this->creado = date('Y/m/d');
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un título';
        }

        if (!$this->subtitulo) {
            self::$errores[] = 'El subtítulo es obligatorio';
        }

        if (strlen($this->descripcion) < 30) {
            self::$errores[] = 'La descripcion es obligatoria y debe tener al menos 30 caracteres';
        }

        if (!$this->imagen) {
            self::$errores[] = 'Debes añadir una imagen';
        }

        if (!$this->creador) {
            self::$errores[] = 'El creador es obligatiorio';
        }

        return self::$errores;
    }
}
