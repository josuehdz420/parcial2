<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Prestamos\Controladores\PrestamoControlador;

$controlador = new PrestamoControlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->guardar();
} else {
    $controlador->formulario();
}