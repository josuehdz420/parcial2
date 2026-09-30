<?php

namespace Prestamos\Modelos;

class Laptop extends Equipo
{
    public function diasMaximoPrestamo(): int
    {
        return 3;
    }
}