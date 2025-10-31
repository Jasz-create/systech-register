<?php

namespace App\Services\Intake;

class StudentRegistrationDTO
{
    public function __construct(
        public string $full_name,
        public string $email,
        public string $cif,
        public string $shirt_size,
        public string $receipt_number,
        public ?float $amount = null,
        public ?string $paid_at = null // 'Y-m-d'
    ) {}
}
