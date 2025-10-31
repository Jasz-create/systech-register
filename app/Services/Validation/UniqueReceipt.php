<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;
use App\Models\Registration;

class UniqueReceipt extends Handler
{
    protected function check(StudentRegistrationDTO $dto, Result $r): void
    {
        if(Registration::where('receipt_number',$dto->receipt_number)->exists())
            $r->add('receipt_number','El número de recibo ya existe.');
    }
}
