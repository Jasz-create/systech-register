<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('career')->after('student_id');          // Ingeniería en Sistemas, etc.
            $table->unsignedTinyInteger('academic_year')->after('career'); // 1..5
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['career','academic_year']);
        });
    }
};
