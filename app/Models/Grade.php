<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
   protected $fillable = [
    'student_id',
    'subject_id',
    'teacher_id',
    'quiz',
    'project',
    'exam',
    'final_grade',
    'status',
    'locked',
    'locked_at',
    'locked_by'
];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
