<?php

use Model\ActiveRecord; // 3 Mandamos a llamar a la class ActiveRecord
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeload();

require 'funciones.php';
require 'config/database.php';

// Conectarnos a la base de datos 
$db = conectarDB(); // Mandamos a llamar la coneccion de database.php, asignando $db a la funcion que conecta con la base de datos, para liego en el paso 4 asignarlo a setDB


ActiveRecord::setDB($db); // 4 Le asignamos $db, que es basicamente la conexion a la base de datos de database.php conectarDB();
