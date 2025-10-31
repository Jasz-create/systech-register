<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // nuevos campos
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');

            // full_name se mantiene por compatibilidad; lo rellenaremos al guardar
            // quitar CIF (si existe de la versión anterior)
            if (Schema::hasColumn('students', 'cif')) {
                $table->dropUnique(['cif']); // por si existe el índice único
                $table->dropColumn('cif');
            }

            // asegurarnos que email sigue siendo único
            $table->string('email')->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // revertir
            $table->dropColumn(['first_name','last_name']);
            // restaurar cif si hace falta
            $table->string('cif', 20)->unique()->nullable(false);
        });
    }
};
