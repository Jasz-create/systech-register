<?php

namespace App\Bad;

use Illuminate\Support\Facades\DB;

class RegistrationGod
{
    public function process(array $req): array
    {
        $errors = [];

        // Validaciones dispersas y mezcladas (anti-patrón)
        if(empty($req['first_name'])) $errors['first_name'][] = 'Campo requerido.';
        if(empty($req['last_name']))  $errors['last_name'][]  = 'Campo requerido.';

        if(empty($req['email'])) $errors['email'][] = 'Campo requerido.';
        elseif(!filter_var($req['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'][] = 'Email inválido.';

        if(empty($req['career'])) $errors['career'][] = 'Campo requerido.';

        $allowedSizes = ['XS','S','M','L','XL','XXL']; // hardcodeado aquí (mal)
        if(empty($req['shirt_size']) || !in_array(strtoupper($req['shirt_size']), $allowedSizes, true))
            $errors['shirt_size'][] = 'Talla no permitida.';

        $year = isset($req['academic_year']) ? (int)$req['academic_year'] : 0;
        if($year < 1 || $year > 5) $errors['academic_year'][] = 'Año lectivo inválido (1-5).';

        if(empty($req['receipt_number'])) $errors['receipt_number'][] = 'Campo requerido.';
        else {
            $exists = DB::table('registrations')->where('receipt_number', $req['receipt_number'])->exists();
            if($exists) $errors['receipt_number'][] = 'El número de recibo ya existe.';
        }

        if(!empty($errors)) return ['ok'=>false,'errors'=>$errors];

        // Inserciones directas y acopladas (anti-patrón)
        $studentId = DB::table('students')->where('email', strtolower($req['email']))->value('id');
        if(!$studentId){
            $studentId = DB::table('students')->insertGetId([
                'first_name' => $req['first_name'],
                'last_name'  => $req['last_name'],
                'full_name'  => trim(($req['first_name'] ?? '').' '.($req['last_name'] ?? '')),
                'email'      => strtolower($req['email']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('registrations')->insert([
            'student_id'     => $studentId,
            'career'         => $req['career'],
            'academic_year'  => $year,
            'shirt_size'     => strtoupper($req['shirt_size']),
            'receipt_number' => $req['receipt_number'],
            'amount'         => ($req['amount'] ?? null),
            'paid_at'        => ($req['paid_at'] ?? null),
            'status'         => 'validated',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return ['ok'=>true];
    }
}
