<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_class extends Model
{
    public $timestamps = false;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'roll_no',
        'student_name',
        'department',
        'programme',
        'semester',
        'section',
        'session',
        'year',
    ];

}
