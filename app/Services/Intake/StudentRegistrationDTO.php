<?php

namespace App\Services\Intake;

class StudentRegistrationDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $career,
        public string $shirt_size,
        public string $receipt_number,
        public ?float $amount = null,
        public ?string $paid_at = null,        // 'Y-m-d'
        public ?int $academic_year = null      // 1..5
    ) {}
}
