<?php

namespace Prestamos\Modelos;

class Proyector extends Equipo
{
    public function diasMaximoPrestamo(): int
    {
        return 1;
    }
}