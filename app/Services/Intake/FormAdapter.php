<?php

namespace App\Services\Intake;

class FormAdapter implements IntakeAdapter
{
    public function toDTO(mixed $in): StudentRegistrationDTO
    {
        $d = is_array($in) ? $in : [];
        return new StudentRegistrationDTO(
            first_name: trim($d['first_name'] ?? ''),
            last_name:  trim($d['last_name']  ?? ''),
            email:     strtolower(trim($d['email'] ?? '')),
            career:    trim($d['career'] ?? ''),
            shirt_size: strtoupper(trim($d['shirt_size'] ?? '')),
            receipt_number: trim($d['receipt_number'] ?? ''),
            amount: (isset($d['amount']) && $d['amount']!=='') ? (float)$d['amount'] : null,
            paid_at: $d['paid_at'] ?? null,
            academic_year: isset($d['academic_year']) ? (int)$d['academic_year'] : null,
        );
    }
}
