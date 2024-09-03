<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class studentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'student',
            'email' => 'student@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        'father_name'=>'sajid ali khan',
        'Gender'=>'male',
        'Nationality'=>'pakistani',
        'Date_of_Birth'=>'25_4_2000',
        'phone_no'=>'03348568255',
        'profie_pic'=>'folder',
        'roll_no'=>'6291',
        'Admission_date'=>'3_9_18',

        'ssc_degree_name'=>'matric',
        'ssc_board_name'=>'Abbottabad',
        'ssc_total_marks'=>'1100',
        'ssc_obt_marks'=>'799',
        'hssc_degree_name'=>'fsc',
        'hssc_board_name'=>'Abbottabad',
        'hssc_total_marks'=>'1100',
        'hssc_obt_marks'=>'700',

        'city'=>'Abbottabad',
        'mailing_adress'=>'basti ayub khan',
        'domicile_district'=>'Abbottabad',
        'domicile_province'=>'kpk',
        ];
    }
}
