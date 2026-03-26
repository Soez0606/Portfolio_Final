<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'school',
        'degree',
        'field_of_study',
        'start_date',
        'end_date'
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
