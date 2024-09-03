<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_course extends Model
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
        'student_name',
        'roll_no',
        'semester',
        'section',
        'session',
        'year',
        'course_title',         
        'course_code',
        'theory_cr_hrs',
        'lab_cr_hrs',
       
    ];
}
