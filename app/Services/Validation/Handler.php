<?php

namespace App\Services\Validation;

use App\Services\Intake\StudentRegistrationDTO;

abstract class Handler
{
    private ?Handler $next = null;

    public function setNext(Handler $next): Handler { $this->next = $next; return $next; }

    final public function handle(StudentRegistrationDTO $dto, Result $result): Result
    {
        $this->check($dto, $result);
        if ($result->isValid() && $this->next) return $this->next->handle($dto, $result);
        return $result;
    }

    abstract protected function check(StudentRegistrationDTO $dto, Result $result): void;
}
