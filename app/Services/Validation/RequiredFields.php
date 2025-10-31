<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;

class RequiredFields extends Handler
{
    protected function check(StudentRegistrationDTO $dto, Result $r): void
    {
        foreach (['first_name','last_name','email','career','shirt_size','receipt_number','academic_year'] as $f) {
            if($dto->{$f} === null || $dto->{$f} === '') $r->add($f,'Campo requerido.');
        }
        if(!empty($dto->email) && !filter_var($dto->email, FILTER_VALIDATE_EMAIL))
            $r->add('email','Email inválido.');
    }
}
