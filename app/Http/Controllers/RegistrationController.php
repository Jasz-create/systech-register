<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Registration;
use App\Services\Intake\IntakeService;
use App\Services\Validation\ValidationPipeline;

class RegistrationController extends Controller
{
    public function create() { return view('register.form'); }

    public function store(Request $request, IntakeService $intake, ValidationPipeline $pipeline)
    {
        $dto = $intake->fromForm($request->all());

        $result = $pipeline->validate($dto);
        if(!$result->isValid())
            return back()->withErrors($result->errors())->withInput();

        // Crear/obtener alumno por email (ya no existe CIF)
        $student = Student::firstOrCreate(
            ['email' => $dto->email],
            [
                'first_name' => $dto->first_name,
                'last_name'  => $dto->last_name,
                'full_name'  => trim($dto->first_name.' '.$dto->last_name),
            ]
        );

        Registration::create([
            'student_id'     => $student->id,
            'career'         => $dto->career,
            'academic_year'  => $dto->academic_year ?? 1,
            'shirt_size'     => $dto->shirt_size,
            'receipt_number' => $dto->receipt_number,
            'amount'         => $dto->amount,
            'paid_at'        => $dto->paid_at,
            'status'         => 'validated',
        ]);

        return redirect()->route('register.form')->with('ok','Registro guardado.');
    }
}
