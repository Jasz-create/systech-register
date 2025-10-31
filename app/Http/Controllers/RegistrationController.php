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
        // Adapter: form -> DTO
        $dto = $intake->fromForm($request->all());

        // Chain: validación
        $result = $pipeline->validate($dto);
        if(!$result->isValid())
            return back()->withErrors($result->errors())->withInput();

        // Persistencia mínima
        $student = Student::firstOrCreate(
            ['cif' => $dto->cif],
            ['full_name' => $dto->full_name, 'email' => $dto->email]
        );

        Registration::create([
            'student_id' => $student->id,
            'shirt_size' => $dto->shirt_size,
            'receipt_number' => $dto->receipt_number,
            'amount' => $dto->amount,
            'paid_at' => $dto->paid_at,
            'status' => 'validated',
        ]);

        return redirect()->route('register.form')->with('ok','Registro guardado.');
    }
}
