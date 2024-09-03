<?php

namespace App\Http\Controllers;
use App\Models\student_class;
use App\Models\results;
use App\Models\student;
use App\Models\drop_students;
use App\Models\passed_students;
use App\Models\student_course;
use App\Models\instructor;
use App\Models\attendance;



use Illuminate\Http\Request;

class promoteclass extends Controller
{
     public function promote(Request $request)
     {
       
      $programme_check=student_class::where('programme','=',$request->programme)->get();
      $check_programme=sizeof($programme_check);
      if($check_programme<1)
      {
        return back()->with('fail','There are no students in this programme');
      }
      $compile_check=results::where('programme','=',$request->programme)->whereNull('status')->get();
      
      $check=sizeof($compile_check);

     
      if($check>0)
      {
        return back()->with('fail','Please ask  teachers to compile their results');
      }
      else
      {
        // for cgpa compilation 
        $sem = student_class::where('programme','=',$request->programme)->get();
        $sem_total_students=sizeof($sem);

        if($sem_total_students>0)
        {
        $sem_cgpa=array();
        foreach($sem as $semester)
        {
           
      $sem_subjects = results::where('roll_no','=',$semester->roll_no)->get();
     
      $sem_lenght_check=sizeof($sem_subjects); 

            if($sem_lenght_check>0)
      {

        $sem_cr_hrs=array();
        $sem_points=array();
        $sem_gp=array();
        foreach($sem_subjects as $sem_courses)
        {

          $sem_credit_hrs= $sem_courses->theory_cr_hrs+$sem_courses->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
       
             if($sem_courses->total_marks==50)
             {
              $sem_points[]=1;
             }
            else if($sem_courses->total_marks==51)
            {
              $sem_points[]=1.1;
            }
            else if($sem_courses->total_marks==52)
            {
              $sem_points[]=1.2;
            }
            else if($sem_courses->total_marks==53)
            {
              $sem_points[]=1.3;
            }
            else if($sem_courses->total_marks==54)
            {
              $sem_points[]=1.4;
            }
            else if($sem_courses->total_marks==55)
            {
              $sem_points[]=1.5;
            }
            else if($sem_courses->total_marks==56)
            {
              $sem_points[]=1.6;
            }
            else if($sem_courses->total_marks==57)
            {
              $sem_points[]=1.7;
            }
            else if($sem_courses->total_marks==58)
            {
              $sem_points[]=1.8;
            }
            else if($sem_courses->total_marks==59)
            {
              $sem_points[]=1.9;
            }
            else if($sem_courses->total_marks==60)
            {
              $sem_points[]=2;
            }
            else if($sem_courses->total_marks==61)
            {
              $sem_points[]=2.1;
            }
            else if($sem_courses->total_marks==62)
            {
              $sem_points[]=2.2;
            }
            else if($sem_courses->total_marks==63)
            {
              $sem_points[]=2.3;
            }
            else if($sem_courses->total_marks==64)
            {
              $sem_points[]=2.4;
            }
            else if($sem_courses->total_marks==65)
            {
              $sem_points[]=2.5;
            }
            else if($sem_courses->total_marks==66)
            {
              $sem_points[]=2.6;
            }
            else if($sem_courses->total_marks==67)
            {
              $sem_points[]=2.7;
            }
            else if($sem_courses->total_marks==68)
            {
              $sem_points[]=2.8;
            }
            else if($sem_courses->total_marks==69)
            {
              $sem_points[]=2.9;
            }
            else if($sem_courses->total_marks==70)
            {
              $sem_points[]=3;
            }
            else if($sem_courses->total_marks==71)
            {
              $sem_points[]=3.1;
            }
            else if($sem_courses->total_marks==72)
            {
              $sem_points[]=3.2;
            }
            else if($sem_courses->total_marks==73)
            {
              $sem_points[]=3.3;
            }
            else if($sem_courses->total_marks==74)
            {
              $sem_points[]=3.4;
            }
            else if($sem_courses->total_marks==75)
            {
              $sem_points[]=3.5;
            }
            else if($sem_courses->total_marks==76)
            {
              $sem_points[]=3.6;
            }
            else if($sem_courses->total_marks==77)
            {
              $sem_points[]=3.7;
            }
            else if($sem_courses->total_marks==78)
            {
              $sem_points[]=3.8;
            }
            else if($sem_courses->total_marks==79)
            {
              $sem_points[]=3.9;
            }
            else if($sem_courses->total_marks>=80)
            {
              $sem_points[]=4;
            }
            else
            {
              $sem_points[]=0;
            }
            
        }  //inner foreach for all subjects end 

        for($i=0; $i<$sem_lenght_check; $i++)
        {
          $gp= $sem_cr_hrs[$i]*$sem_points[$i];    
          $sem_gp[]=$gp;
        }

        $sem_total_gp=array_sum($sem_gp);
        $sem_total_cr_hrs=array_sum($sem_cr_hrs);

        $sem_gpa= $sem_total_gp/$sem_total_cr_hrs;


        $all_gp=$sem_total_gp;
        $all_cr_hrs=$sem_total_cr_hrs;
        $cgpa=$all_gp/$all_cr_hrs;
        $sem_cgpa[]=$cgpa;
 
      }  //if for subjects lenght check     





        }  //outer foreach for cgpa of class  students end 
         


       for($i=0;$i<$sem_total_students; $i++)
       {
        
        student_class::where('roll_no','=',$sem[$i]->roll_no)->update([
        
          'cgpa'=> $sem_cgpa[$i],
  
        ]);
       }     
      }  //if  for  check that if there is any student in this semester


 //promote  codding start 


 //semester 8
$promote8= student_class::where('programme','=',$request->programme)->where('semester','=','8th')->get();
$class_check=sizeof($promote8);
if($class_check>0)
{
   foreach($promote8 as $promote_sem_8)
   {

        $cgpa= $promote_sem_8->cgpa;
        $semester_count=$promote_sem_8->sem_count;
        $repeat_sem=$promote_sem_8->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_8->roll_no)->where('semester','=','8th')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_8->roll_no)->where('semester','=','8th')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_8->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_8->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_8->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);

   } // if for 50% cr hrs pass  condition end

   else if($semester_count==12 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       student_class::where('roll_no','=',$promote_sem_8->roll_no)->delete();
   }  //else if for 12 semesters end

  else if($repeat_sem==0 && $cgpa<2)
   {
    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_8->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);
   } // else if for resemester end

   else if($repeat_sem==1 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
         student_class::where('roll_no','=',$promote_sem_8->roll_no)->delete();
   } // else if for drop from resemester

   else
   {
    

    passed_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
           student_class::where('roll_no','=',$promote_sem_8->roll_no)->delete();
   }
   } //foreach for promote 8 end 

} //if for class check end





//semester 7
$promote7= student_class::where('programme','=',$request->programme)->where('semester','=','7th')->get();
$class_check=sizeof($promote7);
if($class_check>0)
{
   foreach($promote7 as $promote_sem_7)
   {

        $cgpa= $promote_sem_7->cgpa;
        $semester_count=$promote_sem_7->sem_count;
        $repeat_sem=$promote_sem_7->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_7->roll_no)->where('semester','=','7th')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_7->roll_no)->where('semester','=','7th')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_7->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_7->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_7->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);

   } // if for 50% cr hrs pass  condition end

   else if($semester_count==12 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
       student_class::where('roll_no','=',$promote_sem_7->roll_no)->delete();
   }  //else if for 12 semesters end

  else if($repeat_sem==0 && $cgpa<2)
   {
    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_7->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);
   } // else if for resemester end

   else if($repeat_sem==1 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

         student_class::where('roll_no','=',$promote_sem_7->roll_no)->delete();
   } // else if for drop from resemester

   else if($cgpa>=2)
   {
        $resem=0;
       if($repeat_sem==1)
       {
        student_class::where('roll_no','=',$promote_sem_7->roll_no)->update([
          're_sem'=>$resem,
        ]);
       }
       $sem8='8th';
       student_class::where('roll_no','=',$promote_sem_7->roll_no)->update([
        'semester'=>$sem8,
      ]);

   }
   } //foreach for promote 7 end 

} //if for class check end



//semester 6
$promote6= student_class::where('programme','=',$request->programme)->where('semester','=','6th')->get();
$class_check=sizeof($promote6);
if($class_check>0)
{
   foreach($promote6 as $promote_sem_6)
   {

        $cgpa= $promote_sem_6->cgpa;
        $semester_count=$promote_sem_6->sem_count;
        $repeat_sem=$promote_sem_6->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_6->roll_no)->where('semester','=','6th')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_6->roll_no)->where('semester','=','6th')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_6->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_6->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_6->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);

   } // if for 50% cr hrs pass  condition end

   else if($semester_count==12 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

       student_class::where('roll_no','=',$promote_sem_6->roll_no)->delete();

   }  //else if for 12 semesters end

  else if($repeat_sem==0 && $cgpa<2)
   {
    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_6->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);

   } // else if for resemester end

   else if($repeat_sem==1 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

          student_class::where('roll_no','=',$promote_sem_6->roll_no)->delete();
   } // else if for drop from resemester

   else if($cgpa>=2)
   {
        $resem=0;
       if($repeat_sem==1)
       {
        student_class::where('roll_no','=',$promote_sem_6->roll_no)->update([
          're_sem'=>$resem,
        ]);
       }
       $sem7='7th';
       student_class::where('roll_no','=',$promote_sem_6->roll_no)->update([
        'semester'=>$sem7,
      ]);


   }
   } //foreach for promote 6 end 

} //if for class check end




//semester 5
$promote5= student_class::where('programme','=',$request->programme)->where('semester','=','5th')->get();
$class_check=sizeof($promote5);
if($class_check>0)
{
   foreach($promote5 as $promote_sem_5)
   {

        $cgpa= $promote_sem_5->cgpa;
        $semester_count=$promote_sem_5->sem_count;
        $repeat_sem=$promote_sem_5->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_5->roll_no)->where('semester','=','5th')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_5->roll_no)->where('semester','=','5th')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_5->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_5->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_5->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);


   } // if for 50% cr hrs pass  condition end

   else if($semester_count==12 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

       student_class::where('roll_no','=',$promote_sem_5->roll_no)->delete();
   }  //else if for 12 semesters end

  else if($repeat_sem==0 && $cgpa<2)
   {
    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_5->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);

   } // else if for resemester end

   else if($repeat_sem==1 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

         student_class::where('roll_no','=',$promote_sem_5->roll_no)->delete();
   } // else if for drop from resemester

   else if($cgpa>=2)
   {
        $resem=0;
       if($repeat_sem==1)
       {
        student_class::where('roll_no','=',$promote_sem_5->roll_no)->update([
          're_sem'=>$resem,
        ]);
       }
       $sem6='6th';
       student_class::where('roll_no','=',$promote_sem_5->roll_no)->update([
        'semester'=>$sem6,
      ]);


   }
   } //foreach for promote 5 end 

} //if for class check end




//semester 4
$promote4= student_class::where('programme','=',$request->programme)->where('semester','=','4th')->get();
$class_check=sizeof($promote4);
if($class_check>0)
{
   foreach($promote4 as $promote_sem_4)
   {

        $cgpa= $promote_sem_4->cgpa;
        $semester_count=$promote_sem_4->sem_count;
        $repeat_sem=$promote_sem_4->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_4->roll_no)->where('semester','=','4th')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_4->roll_no)->where('semester','=','4th')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_4->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_4->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_4->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);

   } // if for 50% cr hrs pass  condition end

   else if($semester_count==12 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

       student_class::where('roll_no','=',$promote_sem_4->roll_no)->delete();
   }  //else if for 12 semesters end

  else if($repeat_sem==0 && $cgpa<2)
   {
    $resem=1;
    $sem_count=$semester_count+1;
    student_class::where('roll_no','=',$promote_sem_4->roll_no)->update([
       'sem_count'=>$sem_count,
        're_sem'=>$resem,
    ]);


   } // else if for resemester end

   else if($repeat_sem==1 && $cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    

         student_class::where('roll_no','=',$promote_sem_4->roll_no)->delete();
   } // else if for drop from resemester

   else if($cgpa>=2)
   {
        $resem=0;
       if($repeat_sem==1)
       {
        student_class::where('roll_no','=',$promote_sem_4->roll_no)->update([
          're_sem'=>$resem,
        ]);
       }
       $sem5='5th';
       student_class::where('roll_no','=',$promote_sem_4->roll_no)->update([
        'semester'=>$sem5,
      ]);

   }
   } //foreach for promote 4 end 

} //if for class check end



//semester 3
$promote3= student_class::where('programme','=',$request->programme)->where('semester','=','3rd')->get();
$class_check=sizeof($promote3);
if($class_check>0)
{
   foreach($promote3 as $promote_sem_3)
   {

        $cgpa= $promote_sem_3->cgpa;
        $semester_count=$promote_sem_3->sem_count;
        $repeat_sem=$promote_sem_3->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_3->roll_no)->where('semester','=','3rd')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_3->roll_no)->where('semester','=','3rd')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_3->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_3->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

       drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       
       student_class::where('roll_no','=',$promote_sem_3->roll_no)->delete();


   } // if for 50% cr hrs pass  condition end

   else if($cgpa<2)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       
       student_class::where('roll_no','=',$promote_sem_3->roll_no)->delete();
   }

   else if($cgpa>=2)
   {
        
       
       $sem4='4th';
       student_class::where('roll_no','=',$promote_sem_3->roll_no)->update([
        'semester'=>$sem4,
      ]);


   }
   } //foreach for promote 3 end 

} //if for class check end


//semester 2
$promote2= student_class::where('programme','=',$request->programme)->where('semester','=','2nd')->get();
$class_check=sizeof($promote2);
if($class_check>0)
{
   foreach($promote2 as $promote_sem_2)
   {

        $cgpa= $promote_sem_2->cgpa;
        $semester_count=$promote_sem_2->sem_count;
        $repeat_sem=$promote_sem_2->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_2->roll_no)->where('semester','=','2nd')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_2->roll_no)->where('semester','=','2nd')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_2->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_2->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

       drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       
       student_class::where('roll_no','=',$promote_sem_2->roll_no)->delete();


   } // if for 50% cr hrs pass  condition end

   else if($cgpa<1.5)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       
       student_class::where('roll_no','=',$promote_sem_2->roll_no)->delete();
   }

   else if($cgpa>=1.5)
   {
        
       
       $sem3='3rd';
       student_class::where('roll_no','=',$promote_sem_2->roll_no)->update([
        'semester'=>$sem3,
      ]);


   }
   } //foreach for promote 2 end 

} //if for class check end
  
//semester 1
$promote1= student_class::where('programme','=',$request->programme)->where('semester','=','1st')->get();
$class_check=sizeof($promote1);
if($class_check>0)
{
   foreach($promote1 as $promote_sem_1)
   {

        $cgpa= $promote_sem_1->cgpa;
        $semester_count=$promote_sem_1->sem_count;
        $repeat_sem=$promote_sem_1->re_sem;
        $student_data= results::where('roll_no','=',$promote_sem_1->roll_no)->where('semester','=','1st')->get();

        $sem_cr_hrs=array();
        foreach($student_data as $data)
        {

          $sem_credit_hrs= $data->theory_cr_hrs+$data->lab_cr_hrs;
          $sem_cr_hrs[]=$sem_credit_hrs;
        } //foreach for sem total crhrs end

        $sem_total_cr_hrs=array_sum($sem_cr_hrs);


        $pass_students= results::where('roll_no','=',$promote_sem_1->roll_no)->where('semester','=','1st')->where('status','=','pass')->get();

        $pass_cr_hrs=array();
        foreach($pass_students as $pass)
        {

          $pass_credit_hrs= $pass->theory_cr_hrs+$pass->lab_cr_hrs;
          $pass_cr_hrs[]=$pass_credit_hrs;
        }//foreach for half crhrs end

        $pass_total_cr_hrs=array_sum($pass_cr_hrs);

        $sem_50_cr_hrs=$sem_total_cr_hrs/2;

        
  // 50% cr hrs pass condition
     $stu_info= student::where('roll_no','=',$promote_sem_1->roll_no)->first();
     $stu_class=student_class::where('roll_no','=',$promote_sem_1->roll_no)->first();
   if($pass_total_cr_hrs<$sem_50_cr_hrs)
   {     

       drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       
       student_class::where('roll_no','=',$promote_sem_1->roll_no)->delete();


   } // if for 50% cr hrs pass  condition end

   else if($cgpa<1.5)
   {
    drop_students::insert([
          

      'name'=>$stu_info->name,
      'father_name'=>$stu_info->father_name,
      'Gender'=>$stu_info->Gender,
      'Nationality'=>$stu_info->Nationality,
      'CNIC'=>$stu_info->CNIC,
      'Date_of_Birth'=>$stu_info->Date_of_Birth,
      'phone_no'=>$stu_info->phone_no,
      'Religion'=>$stu_info->Religion,
      'roll_no'=>$stu_info->roll_no,
      'Admission_date'=>$stu_info->Admission_date,
      'ssc_degree_name'=>$stu_info->ssc_degree_name,
      'ssc_board_name'=>$stu_info->ssc_board_name,
      'ssc_total_marks'=>$stu_info->ssc_total_marks,
      'ssc_obt_marks'=>$stu_info->ssc_obt_marks,
      'hssc_degree_name'=>$stu_info->hssc_degree_name,
      'hssc_board_name'=>$stu_info->hssc_board_name,
      'hssc_total_marks'=>$stu_info->hssc_total_marks,
      'hssc_obt_marks'=>$stu_info->hssc_obt_marks,
      'city'=>$stu_info->city,
      'mailing_adress'=>$stu_info->mailing_adress,
      'domicile_district'=>$stu_info->domicile_district,
      'domicile_province'=>$stu_info->domicile_province,
      'programme'=>$stu_class->programme,
      'session'=>$stu_class->session,
      'year'=>$stu_class->year,
      'semester'=>$stu_class->semester,
      'section'=>$stu_class->section,
      'cgpa'=>$stu_class->cgpa,
       ]);
    
       
       student_class::where('roll_no','=',$promote_sem_1->roll_no)->delete();
   }

   else if($cgpa>=1.5)
   {
        
       
       $sem2='2nd';
       student_class::where('roll_no','=',$promote_sem_1->roll_no)->update([
        'semester'=>$sem2,
      ]);


   }
   } //foreach for promote 1 end 

} //if for class check end

student_course::where('programme','=',$request->programme)->delete();
attendance::where('programme','=',$request->programme)->delete();
instructor::where('programme','=',$request->programme)->delete();


return back()->with('success','Promoted Successfully');


} //else  for compile check end 

    } //function end

} //controller class  end

