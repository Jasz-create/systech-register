<?php

namespace App\Services\Config;

class ConfigRepository
{
    private EventValidationConfig $base;

    public function __construct()
    {
        $this->base = new EventValidationConfig('SYSTECH Base');
    }

    public function forYear(int $year): EventValidationConfig
    {
        $cfg = clone $this->base;         // ← PROTOTYPE
        $cfg->eventName = "SYSTECH {$year}";

        // Ejemplo (cambia reglas en futuras ediciones)
        if($year >= 2026) $cfg->allowedShirtSizes = ['S','M','L','XL'];

        return $cfg;
    }
}
