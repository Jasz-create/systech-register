<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;

class CifFormat extends Handler
{
    protected function check(StudentRegistrationDTO $dto, Result $r): void
    {
        if(!preg_match('/^[A-Z0-9]{6,20}$/', $dto->cif))
            $r->add('cif','CIF inválido (6-20 alfanumérico).');
    }
}
