<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department',
        'programme',
        'semester',

        'course_code',
        'course_title',
        'theory_cr_hrs',

        'lab_cr_hrs',
        'prerequsite_title',
        'prerequsite_code',
    ];
}
