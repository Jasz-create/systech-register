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

        // Prototype: config clonada por edición/año
        $config = $this->configs->forYear(2025);

        $head = new RequiredFields();
        $head
            ->setNext(new CifFormat())
            ->setNext(new ShirtSizeRule($config->allowedShirtSizes))
            ->setNext(new UniqueReceipt());

        return $head->handle($dto, $result);
    }
}
