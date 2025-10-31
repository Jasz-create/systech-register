<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;

class AcademicYearRule extends Handler
{
    public function __construct(private int $min = 1, private int $max = 5) {}

    protected function check(StudentRegistrationDTO $dto, Result $r): void
    {
        if ($dto->academic_year === null || $dto->academic_year < $this->min || $dto->academic_year > $this->max) {
            $r->add('academic_year', "Año lectivo inválido ({$this->min}-{$this->max}).");
        }
    }
}
