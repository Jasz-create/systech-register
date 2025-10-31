<?php

namespace App\Services\Intake;

interface IntakeAdapter {
    public function toDTO(mixed $input): StudentRegistrationDTO;
}
