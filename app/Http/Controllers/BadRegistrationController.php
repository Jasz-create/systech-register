<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bad\RegistrationGod;

class BadRegistrationController extends Controller
{
    public function create()
    {
        // usa la misma vista del form
        return view('register.form');
    }

    public function store(Request $request)
    {
        // ANTI-PATRÓN 1: God Object
        $result = (new RegistrationGod())->process($request->all());
        if(!$result['ok']) return back()->withErrors($result['errors'])->withInput();

        return redirect()->route('bad.form')->with('ok', '(MAL) Guardado con God Object');
    }

    // ANTI-PATRÓN 2: Cut & Paste (duplicación de reglas)
    public function importCsvDemo(Request $request)
    {
        $row = $request->all(); // simula fila CSV
        $errors = [];

        // Duplicado: validaciones pegadas
        if(empty($row['first_name'])) $errors['first_name'][] = 'Campo requerido.';
        if(empty($row['last_name']))  $errors['last_name'][]  = 'Campo requerido.';
        if(empty($row['email']))      $errors['email'][]      = 'Campo requerido.';
        elseif(!filter_var($row['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'][] = 'Email inválido.';

        $allowedSizes = ['XS','S','M','L','XL','XXL']; // duplicado
        if(empty($row['shirt_size']) || !in_array(strtoupper($row['shirt_size']), $allowedSizes, true))
            $errors['shirt_size'][] = 'Talla no permitida.';

        $year = isset($row['academic_year']) ? (int)$row['academic_year'] : 0;
        if($year < 1 || $year > 5) $errors['academic_year'][] = 'Año lectivo inválido (1-5).';

        if(empty($row['receipt_number'])) $errors['receipt_number'][] = 'Campo requerido.';

        if(!empty($errors)) return back()->withErrors($errors)->withInput();

        // (Omitido: inserciones directas, porque esto es solo evidencia de duplicación)
        return back()->with('ok','(MAL) Importación con código pegado');
    }
}
