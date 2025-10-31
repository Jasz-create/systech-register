<?php

namespace App\Bad;

use Illuminate\Support\Facades\DB;

class RegistrationGod
{
    public function process(array $req): array
    {
        $errors = [];

        // Validaciones dispersas y mezcladas (anti-patrón)
        if(empty($req['full_name'])) $errors['full_name'][] = 'Campo requerido.';
        if(empty($req['email'])) $errors['email'][] = 'Campo requerido.';
        elseif(!filter_var($req['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'][] = 'Email inválido.';

        if(empty($req['cif'])) $errors['cif'][] = 'Campo requerido.';
        elseif(!preg_match('/^[A-Z0-9]{6,20}$/', strtoupper($req['cif'])))
            $errors['cif'][] = 'CIF inválido (6-20 alfanumérico).';

        if(empty($req['shirt_size'])) $errors['shirt_size'][] = 'Campo requerido.';
        else {
            $allowed = ['XS','S','M','L','XL','XXL']; // hardcode
            if(!in_array(strtoupper($req['shirt_size']), $allowed, true))
                $errors['shirt_size'][] = 'Talla no permitida.';
        }

        if(empty($req['receipt_number'])) $errors['receipt_number'][] = 'Campo requerido.';
        else {
            $exists = DB::table('registrations')->where('receipt_number',$req['receipt_number'])->exists();
            if($exists) $errors['receipt_number'][] = 'El número de recibo ya existe.';
        }

        if(!empty($errors)) return ['ok'=>false,'errors'=>$errors];

        // Inserciones directas acopladas (anti-patrón)
        $studentId = DB::table('students')->where('cif', strtoupper($req['cif']))->value('id');
        if(!$studentId){
            $studentId = DB::table('students')->insertGetId([
                'full_name' => $req['full_name'],
                'email'     => strtolower($req['email']),
                'cif'       => strtoupper($req['cif']),
                'created_at'=> now(), 'updated_at'=> now(),
            ]);
        }

        DB::table('registrations')->insert([
            'student_id'     => $studentId,
            'shirt_size'     => strtoupper($req['shirt_size']),
            'receipt_number' => $req['receipt_number'],
            'amount'         => ($req['amount'] ?? null),
            'paid_at'        => ($req['paid_at'] ?? null),
            'status'         => 'validated',
            'created_at'     => now(), 'updated_at' => now(),
        ]);

        return ['ok'=>true];
    }
}
