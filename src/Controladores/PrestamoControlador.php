<?php

namespace Prestamos\Controladores;

use Prestamos\Enums\TipoEquipo;
use Prestamos\Excepciones\DatosInvalidosException;
use ValueError;

class PrestamoControlador
{
    public function formulario(?string $error = null, array $datos = []): void
    {
        $tipos = TipoEquipo::cases();
        require __DIR__ . '/../../vistas/formulario.php';
    }

    public function guardar(): void
    {
        $carnet = trim($_POST['carnet'] ?? '');
        $codigo = trim($_POST['codigo'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $tipoStr = trim($_POST['tipo'] ?? '');

        $datos = [
            'carnet' => $carnet,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'tipo'   => $tipoStr
        ];

        try {
            // Validar que no haya campos vacíos
            if ($carnet === '' || $codigo === '' || $nombre === '' || $tipoStr === '') {
                throw new DatosInvalidosException("Todos los campos son obligatorios.");
            }

            // Validar formato del carnet (2 letras mayúsculas seguidas de 5 dígitos)
            if (!preg_match('/^[A-Z]{2}\d{5}$/', $carnet)) {
                throw new DatosInvalidosException("El carnet debe tener exactamente dos letras mayúsculas seguidas de cinco dígitos (ej. PR21001).");
            }

            // Obtener enum a partir del string enviado
            try {
                $tipoEnum = TipoEquipo::from($tipoStr);
            } catch (ValueError $e) {
                throw new DatosInvalidosException("El tipo de equipo seleccionado no es válido.");
            }

            // Instanciar el equipo mediante el método del enum
            $equipoObj = $tipoEnum->crearEquipo($codigo, $nombre);

            // Obtener los días máximos desde el objeto instanciado
            $diasMaximos = $equipoObj->diasMaximoPrestamo();

            // Guardar en la sesión
            if (!isset($_SESSION['prestamos'])) {
                $_SESSION['prestamos'] = [];
            }

            $_SESSION['prestamos'][] = [
                'carnet'       => $carnet,
                'codigo'       => $equipoObj->codigo,
                'nombre'       => $equipoObj->nombre,
                'tipo'         => $tipoEnum->value,
                'dias_maximos' => $diasMaximos
            ];

            // Redireccionar al listado
            header('Location: listar.php');
            exit;

        } catch (DatosInvalidosException $e) {
            $this->formulario($e->getMessage(), $datos);
        }
    }
}