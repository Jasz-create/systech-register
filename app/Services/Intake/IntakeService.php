<?php

namespace App\Services\Intake;

class IntakeService
{
    public function fromForm(array $request): StudentRegistrationDTO
    {   return (new FormAdapter())->toDTO($request); }
}
