<?php

namespace App\Services\Config;

class EventValidationConfig
{
    public string $eventName;
    public array $allowedShirtSizes = ['XS','S','M','L','XL','XXL'];

    public function __construct(string $eventName){ $this->eventName = $eventName; }

    public function __clone(): void
    {
        // deep copy de estructuras si hiciera falta
        $this->allowedShirtSizes = array_values($this->allowedShirtSizes);
    }
}
