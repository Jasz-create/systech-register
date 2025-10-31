<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'student_id','shirt_size','receipt_number','amount','paid_at','status'
    ];
    public function student(){ return $this->belongsTo(Student::class); }
}
