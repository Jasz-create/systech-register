<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;

class ShirtSizeRule extends Handler
{
    public function __construct(private array $allowed){}

    protected function check(StudentRegistrationDTO $dto, Result $r): void
    {
        if(!in_array($dto->shirt_size, $this->allowed, true))
            $r->add('shirt_size','Talla no permitida para esta edición.');
    }
}
