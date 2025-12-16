<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'name',
        'department_id',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
