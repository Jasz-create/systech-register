<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;
use App\Services\Config\ConfigRepository;

class ValidationPipeline
{
    public function __construct(private ConfigRepository $configs){}

    public function validate(StudentRegistrationDTO $dto): Result
    {
        $result = new Result();

        $config = $this->configs->forYear(2025); // Prototype

        $head = new RequiredFields();
        $head
            ->setNext(new ShirtSizeRule($config->allowedShirtSizes))
            ->setNext(new AcademicYearRule(1,5))
            ->setNext(new UniqueReceipt());

        return $head->handle($dto, $result);
    }
}
