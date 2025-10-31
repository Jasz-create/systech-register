<?php

namespace App\Services\Validation;

class Result
{
    private array $errors = [];

    public function add(string $field, string $message): void
    { $this->errors[$field][] = $message; }

    public function isValid(): bool { return empty($this->errors); }
    public function errors(): array { return $this->errors; }
}
