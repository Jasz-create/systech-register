<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->enum('shirt_size', ['XS','S','M','L','XL','XXL']);
            $table->string('receipt_number', 50)->unique();
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('paid_at')->nullable();
            $table->enum('status', ['pending','validated','rejected'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrations'); }
};
