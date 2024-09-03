<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    
/**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        // 'name',
        // 'email',
        // 'password',
        // 'father_name',
        // 'Gender',
        // 'Nationality',
        // 'Date_of_Birth',
        // 'phone_no',
        // 'profile_pic', 
        'roll_no',
        // 'Admission_date',

        // 'ssc_degree_name',
        // 'ssc_board_name',
        // 'ssc_total_marks',
        // 'ssc_obt_marks',
        // 'hssc_degree_name',
        // 'hssc_board_name',
        // 'hssc_total_marks',
        // 'hssc_obt_marks',

        // 'city',
        // 'mailing_adress',
        // 'domicile_district',
        // 'domicile_province',
    ];

}
