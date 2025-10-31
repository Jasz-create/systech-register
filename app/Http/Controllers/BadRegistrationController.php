<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bad\RegistrationGod;

class BadRegistrationController extends Controller
{
    public function create()
    {
        // Reutilizamos la vista de formulario para comparar comportamientos
        return view('register.form');
    }

    public function store(Request $request)
    {
        // ANTI-PATRÓN 1: God Object
        $result = (new RegistrationGod())->process($request->all());
        if(!$result['ok']) return back()->withErrors($result['errors'])->withInput();
        return redirect()->route('bad.form')->with('ok', '(MAL) Guardado con God Object');
    }

    /** ANTI-PATRÓN 2: Cut & Paste (demo adicional) */
    public function importCsvDemo(Request $request)
    {
        $row = $request->all(); // simula fila CSV
        $errors = [];

        // --- DUPLICADO (regex y lista de tallas pegadas) ---
        if(empty($row['cif'])) $errors['cif'][] = 'Campo requerido.';
        elseif(!preg_match('/^[A-Z0-9]{6,20}$/', strtoupper($row['cif'])))
            $errors['cif'][] = 'CIF inválido (6-20 alfanumérico).';

        $allowed = ['XS','S','M','L','XL','XXL']; // duplicado
        if(empty($row['shirt_size']) || !in_array(strtoupper($row['shirt_size']), $allowed, true))
            $errors['shirt_size'][] = 'Talla no permitida.';
        // ----------------------------------------------------

        if(!empty($errors)) return back()->withErrors($errors)->withInput();
        return back()->with('ok','(MAL) Importación con código pegado');
    }
}
