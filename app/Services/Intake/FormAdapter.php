<?php

namespace App\Services\Intake;

class FormAdapter implements IntakeAdapter
{
    public function toDTO(mixed $in): StudentRegistrationDTO
    {
        $d = is_array($in) ? $in : [];
        return new StudentRegistrationDTO(
            full_name: trim($d['full_name'] ?? ''),
            email:     strtolower(trim($d['email'] ?? '')),
            cif:       strtoupper(trim($d['cif'] ?? '')),
            shirt_size: strtoupper(trim($d['shirt_size'] ?? '')),
            receipt_number: trim($d['receipt_number'] ?? ''),
            amount: (isset($d['amount']) && $d['amount']!=='') ? (float)$d['amount'] : null,
            paid_at: $d['paid_at'] ?? null,
        );
    }
}
