<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$prestamos = $_SESSION['prestamos'] ?? [];

require_once __DIR__ . '/../vistas/listado.php';