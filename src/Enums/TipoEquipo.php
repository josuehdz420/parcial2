<?php

namespace Prestamos\Enums;

use Prestamos\Modelos\Equipo;
use Prestamos\Modelos\Laptop;
use Prestamos\Modelos\Proyector;
use Prestamos\Excepciones\DatosInvalidosException;

enum TipoEquipo: string
{
    case Laptop = 'laptop';
    case Proyector = 'proyector';

    public function crearEquipo(string $codigo, string $nombre): Equipo
    {
        return match ($this) {
            self::Laptop => new Laptop($codigo, $nombre),
            self::Proyector => new Proyector($codigo, $nombre),
            default => throw new DatosInvalidosException("Tipo de equipo no válido.")
        };
    }
}