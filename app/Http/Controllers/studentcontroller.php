<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use App\Actions\Fortify\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\StudentResponses\LoginResponse;
// use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Auth;
use App\Models\student;
use App\Models\student_class;
use App\Models\course;
use App\Models\student_course;
use App\Models\results;
use App\Models\attendance;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;


class studentcontroller extends Controller
{
    
    // student login view function 
      public function student_login_view()
      {
          return view('student dashboard.login');
      }
    // student login logic function start
    public function student_login(Request $request)
    {
        $request->validate([
             'roll_no' => 'required' ,
             'password' => 'required'
        ]);
         
        $student = student::where('roll_no', '=' , $request->roll_no)->first();

        if($student)
        {
            if(Hash::check($request->password , $student->password))
            {
                $request->session()->put('loginId',$student->id);
                $id= Session('loginId');
                $stu_roll=student::find($id)->roll_no;
                $student_personal_info=student::where('id', '=' , $id)->get();
                $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();

                $student_class=student_class::where('roll_no','=',$stu_roll)->get();
                $student_class_check=sizeof($student_class);

                if($student_class_check<1)
                {
                  return back()->with('login_fail','Class not assigned yet');
                }

                //profile complete check //
                $check=student::find($id)->email;
                if($check===null)
                {
                   return view('student dashboard.profile');
                         
                }

               else
               {

                // attendance details 

    
        

    
     $courses= student_course::where('roll_no','=',$stu_roll)->get();
     $courses_array=array();
     foreach($courses as $course)
     {
      $courses_array[]=$course->course_title;
     }
     $total_courses= sizeof($courses);
   
    
        $present="present";
        $absent="absent";
        $leave="leave";

        $total_classes_array=array();
        $attend_classes_array=array();
        $absent_classes_array=array();
        $leave_classes_array=array();
        $percentage_array=array();

        foreach($courses as $course)
        {

            $total_classes = attendance::where('course_title','=',$course->course_title)->where('semester','=',$student_class_info->semester)->where('section','=',$student_class_info->section)->where('session','=',$student_class_info->session)->where('year','=',$student_class_info->year)->where('roll_no','=',$stu_roll)->count();
            $total_classes_array[]=$total_classes;

            if($total_classes>0)
           {
            $attend_classes=attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$present)->count();

            $attend_classes_array[]=$attend_classes;

            $absent_classes= attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$absent)->count();
            $absent_classes_array[]=$absent_classes;

            $leave_classes= attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$leave)->count();
            $leave_classes_array[]=$leave_classes;

             $percentage= $attend_classes/$total_classes*100;

             $percentage_array[]=($percentage);
            
       


            }
        }
      

$attendance_subjects= sizeof($percentage_array);
        
    
                return view('student dashboard.dashboard',compact(['student_personal_info', 'student_class_info','student_personal_info', 'student_class_info', 'attendance_subjects','courses_array','total_classes_array','attend_classes_array','absent_classes_array','leave_classes_array','percentage_array']));
               }
                
            }

            else
            {
                return back()->with('login_fail','password not matched.');
            }
        }
        else
        {
             return back()->with('login_fail','Invalid Email or Password'); 
        }

    }  //student login function end



        // student dashboard button function start 
      public function dashboard()
      {
        $id= Session('loginId');
        $stu_roll=student::find($id)->roll_no;
        $student_personal_info=student::where('id', '=' , $id)->get();
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();



        // attendance details 

    
        

    
     $courses= student_course::where('roll_no','=',$stu_roll)->get();
     $courses_array=array();
     foreach($courses as $course)
     {
      $courses_array[]=$course->course_title;
     }
     $total_courses= sizeof($courses);
    
    
        $present="present";
        $absent="absent";
        $leave="leave";

        $total_classes_array=array();
        $attend_classes_array=array();
        $absent_classes_array=array();
        $leave_classes_array=array();
        $percentage_array=array();

        foreach($courses as $course)
        {

            $total_classes = attendance::where('course_title','=',$course->course_title)->where('semester','=',$student_class_info->semester)->where('section','=',$student_class_info->section)->where('session','=',$student_class_info->session)->where('year','=',$student_class_info->year)->where('roll_no','=',$stu_roll)->count();
            $total_classes_array[]=$total_classes;

            if($total_classes>0)
           {
            $attend_classes=attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$present)->count();

            $attend_classes_array[]=$attend_classes;

            $absent_classes= attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$absent)->count();
            $absent_classes_array[]=$absent_classes;

            $leave_classes= attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$leave)->count();
            $leave_classes_array[]=$leave_classes;

             $percentage= $attend_classes/$total_classes*100;

             $percentage_array[]=($percentage);
            
       


            }
        }
      

$attendance_subjects= sizeof($percentage_array);
        
    
        return view('student dashboard.dashboard',compact(['student_personal_info', 'student_class_info','student_personal_info', 'student_class_info', 'attendance_subjects','courses_array','total_classes_array','attend_classes_array','absent_classes_array','leave_classes_array','percentage_array']));
      }
        // student dashboard button function end

    // student logout function start

    public function logout()
    {
        if(Session::has('loginId'))
        {
            Session::pull('loginId');
        }
        return redirect()->route('home');
    }

    // student logout function end 

    // student change password view function 
     
    public function change_password_view()
    {
        return view('student dashboard.change password');
    }

    // student change  password update  function start

    public function update_password(Request $request)

    {
        $validateData= $request->validate([
            'oldpassword' => 'required',
            'password' => 'required | confirmed' ,
        ]);
           
        
        $id= Session('loginId');
        // $id = Auth::guard('student')->user()->id;
        $hashpassword = student::find($id)->password;
        if(Hash::check($request->oldpassword,$hashpassword))
        {
        
             $student = student::find($id);
            $student->password = Hash::make($request->password);
            $student->save();
            Auth::guard('student')->logout();
            return redirect()->route('home');
        }
        else
        {
            return redirect()->back()->with('fail','old password not matched');
        }
}
  
    // student change password update function end

    
    
    
    // student attendance view function start

    public function attendance()
    {
        $id= Session('loginId');
        $stu_roll=student::find($id)->roll_no;

        // for side bar info start 
        $student_personal_info=student::where('id', '=' , $id)->get();
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();


        //   for sidebar info end 

    
     $courses= student_course::where('roll_no','=',$stu_roll)->get();
     $courses_array=array();
     foreach($courses as $course)
     {
      $courses_array[]=$course->course_title;
     }
     $total_courses= sizeof($courses);
    if($total_courses<1)
    {
        return back()->with('fail','your have not registered your courses yet');
    }
    else
    {
        $present="present";
        $absent="absent";
        $leave="leave";

        $total_classes_array=array();
        $attend_classes_array=array();
        $absent_classes_array=array();
        $leave_classes_array=array();
        $percentage_array=array();

        foreach($courses as $course)
        {

            $total_classes = attendance::where('course_title','=',$course->course_title)->where('semester','=',$student_class_info->semester)->where('section','=',$student_class_info->section)->where('session','=',$student_class_info->session)->where('year','=',$student_class_info->year)->where('roll_no','=',$stu_roll)->count();
            $total_classes_array[]=$total_classes;
            if($total_classes>0)
           {
            $attend_classes=attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$present)->count();

            $attend_classes_array[]=$attend_classes;

            $absent_classes= attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$absent)->count();
            $absent_classes_array[]=$absent_classes;

            $leave_classes= attendance::where('course_title','=',$course->course_title)->where('roll_no','=',$stu_roll)->where('status','=',$leave)->count();
            $leave_classes_array[]=$leave_classes;

             $percentage= $attend_classes/$total_classes*100;

             $percentage_array[]=($percentage);
            
       


            }
        }
      
$attendance_subjects= sizeof($percentage_array);
}  
 return view('student dashboard.attendance',compact(['student_personal_info', 'student_class_info', 'attendance_subjects','courses_array','total_classes_array','attend_classes_array','absent_classes_array','leave_classes_array','percentage_array']));

    }

    // student attendance view function end

    // student courses view function start

    public function courses()
    {
        $id= Session('loginId');
        $stu_roll=student::find($id)->roll_no;

        // code for side bar info start 
        $student_personal_info=student::where('id', '=' , $id)->get();
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();
        // code for sidebar info end 

        $stu_class=student_class::where('roll_no','=',$stu_roll)->first();
        $stu_sem=$stu_class->semester;
         $courses= student_course:: where('roll_no','=',$stu_roll)->where('semester','=',$stu_sem)->get();

        return view('student dashboard.courses',compact(['student_personal_info', 'student_class_info','courses']));

    }

    // student attendance view function end

    // student result view function start

    public function result()
    {
        $id= Session('loginId');
        $stu_roll=student::find($id)->roll_no;
        $student_personal_info=student::where('id', '=' , $id)->get();
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();

        $courses=student_course::where('roll_no', '=' , $stu_roll)->get();


        return view('student dashboard.result',compact(['student_personal_info', 'student_class_info','courses']));

    }

    // student result view function end

    // student assignment result view function start

    public function assignment_result(Request $request, $id)
    {
        $stu_id= Session('loginId');
        $stu_roll=student::find($stu_id)->roll_no;
        $student_personal_info=student::where('id', '=' , $stu_id)->get();
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();

         $course_title = student_course::find($id)->course_title;
         $results=results::where('roll_no','=',$stu_roll)->where('course_title','=',$course_title)->get();

        return view('student dashboard.assignment result',compact(['student_personal_info', 'student_class_info','results']));

    }

    // student assignment result view function end

     // student quiz result view function start

     public function quiz_result(Request $request ,$id)
     {
         $stu_id= Session('loginId');
         $stu_roll=student::find($stu_id)->roll_no;
         $student_personal_info=student::where('id', '=' , $stu_id)->get();
         $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();
 
         $course_title = student_course::find($id)->course_title;
         $results=results::where('roll_no','=',$stu_roll)->where('course_title','=',$course_title)->get();
         return view('student dashboard.quiz result',compact(['student_personal_info', 'student_class_info','results']));
 
     }
 
     // student quiz result view function end

     // student paper result view function start

     public function paper_result(Request $request , $id)
     {
        $stu_id= Session('loginId');
        $stu_roll=student::find($stu_id)->roll_no;
        $student_personal_info=student::where('id', '=' , $stu_id)->get();
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();

        $course_title = student_course::find($id)->course_title;
        $results=results::where('roll_no','=',$stu_roll)->where('course_title','=',$course_title)->get();
         return view('student dashboard.paper result',compact(['student_personal_info', 'student_class_info','results']));
 
     }
 
     // student paper result view function end


     // student transcript view function start

     public function transcript(Request $request)
     {
        $stu_id= Session('loginId');
        $stu_roll=student::find($stu_id)->roll_no;

        // for info on transcript top 
        $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();


        $sem1_subjects = results::where('roll_no','=',$stu_roll)->where('semester','1st')->get();
       
        $sem1_lenght_check=sizeof($sem1_subjects);

        // for semester 1 


        if($sem1_lenght_check>0)
        {

          $sem1_cr_hrs=array();
          $sem1_points=array();
          $sem1_gp=array();
          $sem1_grades=array();
          $sem1_course_titles=array();
          $sem1_course_codes=array();
          $sem1_obtained_marks=array();
  
          foreach($sem1_subjects as $sem1_courses)
          {
            $sem1_course_title=$sem1_courses->course_title;
            $sem1_course_titles[]=$sem1_course_title;
            
            $sem1_course_code=$sem1_courses->course_code;
            $sem1_course_codes[]=$sem1_courses->course_code;
  
            $sem1_obt_marks=$sem1_courses->total_marks;
            $sem1_obtained_marks[]=$sem1_obt_marks;
  
            $sem1_credit_hrs= $sem1_courses->theory_cr_hrs+$sem1_courses->lab_cr_hrs;
            $sem1_cr_hrs[]=$sem1_credit_hrs;
         


            //for grades
            if($sem1_courses->total_marks>=90)
            {
              $sem1_grades="A+";
            }
           else if($sem1_courses->total_marks>84 && $sem1_courses->total_marks<90)
            {
              $sem1_grades='A';
            }
            else if($sem1_courses->total_marks>79 && $sem1_courses->total_marks<85)
            {
              $sem1_grades='A-';
            }
           else if($sem1_courses->total_marks>79 && $sem1_courses->total_marks<85)
            {
              $sem1_grades='B+';
            }
            else if($sem1_courses->total_marks>72 && $sem1_courses->total_marks<76)
            {
              $sem1_grades='B';
            }
            else if($sem1_courses->total_marks>69 && $sem1_courses->total_marks<73)
            {
              $sem1_grades='B-';
            }
            else if($sem1_courses->total_marks>65 && $sem1_courses->total_marks<70)
            {
              $sem1_grades='C+';
            }
            else if($sem1_courses->total_marks>62 && $sem1_courses->total_marks<66)
            {
              $sem1_grades='C';
            }
            else if($sem1_courses->total_marks>59 && $sem1_courses->total_marks<63)
            {
              $sem1_grades='C-';
            }
            else if($sem1_courses->total_marks>57 && $sem1_courses->total_marks<60)
            {
              $sem1_grades='D+';
            }
            else if($sem1_courses->total_marks>49 && $sem1_courses->total_marks<58)
            {
              $sem1_grades='D';
            }
            else
            {
              $sem1_grades='F';
            }
            // grades code end 
               if($sem1_courses->total_marks==50)
               {
                $sem1_points[]=1;
               }
              else if($sem1_courses->total_marks==51)
              {
                $sem1_points[]=1.1;
              }
              else if($sem1_courses->total_marks==52)
              {
                $sem1_points[]=1.2;
              }
              else if($sem1_courses->total_marks==53)
              {
                $sem1_points[]=1.3;
              }
              else if($sem1_courses->total_marks==54)
              {
                $sem1_points[]=1.4;
              }
              else if($sem1_courses->total_marks==55)
              {
                $sem1_points[]=1.5;
              }
              else if($sem1_courses->total_marks==56)
              {
                $sem1_points[]=1.6;
              }
              else if($sem1_courses->total_marks==57)
              {
                $sem1_points[]=1.7;
              }
              else if($sem1_courses->total_marks==58)
              {
                $sem1_points[]=1.8;
              }
              else if($sem1_courses->total_marks==59)
              {
                $sem1_points[]=1.9;
              }
              else if($sem1_courses->total_marks==60)
              {
                $sem1_points[]=2;
              }
              else if($sem1_courses->total_marks==61)
              {
                $sem1_points[]=2.1;
              }
              else if($sem1_courses->total_marks==62)
              {
                $sem1_points[]=2.2;
              }
              else if($sem1_courses->total_marks==63)
              {
                $sem1_points[]=2.3;
              }
              else if($sem1_courses->total_marks==64)
              {
                $sem1_points[]=2.4;
              }
              else if($sem1_courses->total_marks==65)
              {
                $sem1_points[]=2.5;
              }
              else if($sem1_courses->total_marks==66)
              {
                $sem1_points[]=2.6;
              }
              else if($sem1_courses->total_marks==67)
              {
                $sem1_points[]=2.7;
              }
              else if($sem1_courses->total_marks==68)
              {
                $sem1_points[]=2.8;
              }
              else if($sem1_courses->total_marks==69)
              {
                $sem1_points[]=2.9;
              }
              else if($sem1_courses->total_marks==70)
              {
                $sem1_points[]=3;
              }
              else if($sem1_courses->total_marks==71)
              {
                $sem1_points[]=3.1;
              }
              else if($sem1_courses->total_marks==72)
              {
                $sem1_points[]=3.2;
              }
              else if($sem1_courses->total_marks==73)
              {
                $sem1_points[]=3.3;
              }
              else if($sem1_courses->total_marks==74)
              {
                $sem1_points[]=3.4;
              }
              else if($sem1_courses->total_marks==75)
              {
                $sem1_points[]=3.5;
              }
              else if($sem1_courses->total_marks==76)
              {
                $sem1_points[]=3.6;
              }
              else if($sem1_courses->total_marks==77)
              {
                $sem1_points[]=3.7;
              }
              else if($sem1_courses->total_marks==78)
              {
                $sem1_points[]=3.8;
              }
              else if($sem1_courses->total_marks==79)
              {
                $sem1_points[]=3.9;
              }
              else if($sem1_courses->total_marks>=80)
              {
                $sem1_points[]=4;
              }
              else
              {
                $sem1_points[]=0;
              }
              
          }
  
          for($i=0; $i<$sem1_lenght_check; $i++)
          {
            $gp= $sem1_cr_hrs[$i]*$sem1_points[$i];    
            $sem1_gp[]=$gp;
          }
  
          $sem1_total_gp=array_sum($sem1_gp);
          $sem1_total_cr_hrs=array_sum($sem1_cr_hrs);
  
          $sem1_gpa= $sem1_total_gp/$sem1_total_cr_hrs;
  
  
          $all_gp=$sem1_total_gp;
          $all_cr_hrs=$sem1_total_cr_hrs;
  
          $cgpa=$all_gp/$all_cr_hrs;

        }
       
        else
        {
          return back()->with('fail','Transcript not genrated yet');
        }

       
        // for  semester 2 

        

        $sem2_subjects = results::where('roll_no','=',$stu_roll)->where('semester','2nd')->get();
        $sem2_lenght_check=sizeof($sem2_subjects);

        if($sem2_lenght_check>0)
        {


             $sem2_cr_hrs=array();
        $sem2_points=array();
        $sem2_gp=array();
        $sem2_grades=array();
        $sem2_course_titles=array();
        $sem2_course_codes=array();
        $sem2_obtained_marks=array();

        foreach($sem2_subjects as $sem2_courses)
        {
          $sem2_course_title=$sem2_courses->course_title;
          $sem2_course_titles[]=$sem2_course_title;
          
          $sem2_course_code=$sem2_courses->course_code;
          $sem2_course_codes[]=$sem2_courses->course_code;

          $sem2_obt_marks=$sem2_courses->total_marks;
          $sem2_obtained_marks[]=$sem2_obt_marks;

          $sem2_credit_hrs= $sem2_courses->theory_cr_hrs+$sem2_courses->lab_cr_hrs;
          $sem2_cr_hrs[]=$sem2_credit_hrs;
       

         //for grades
         if($sem2_courses->total_marks>=90)
         {
           $sem2_grades='A+';
         }
        else if($sem2_courses->total_marks>84 && $sem2_courses->total_marks<90)
         {
           $sem2_grades='A';
         }
         else if($sem2_courses->total_marks>79 && $sem2_courses->total_marks<85)
         {
           $sem2_grades='A-';
         }
        else if($sem2_courses->total_marks>79 && $sem2_courses->total_marks<85)
         {
           $sem2_grades='B+';
         }
         else if($sem2_courses->total_marks>72 && $sem2_courses->total_marks<76)
         {
           $sem2_grades='B';
         }
         else if($sem2_courses->total_marks>69 && $sem2_courses->total_marks<73)
         {
           $sem2_grades='B-';
         }
         else if($sem2_courses->total_marks>65 && $sem2_courses->total_marks<70)
         {
           $sem2_grades='C+';
         }
         else if($sem2_courses->total_marks>62 && $sem2_courses->total_marks<66)
         {
           $sem2_grades='C';
         }
         else if($sem2_courses->total_marks>59 && $sem2_courses->total_marks<63)
         {
           $sem2_grades='C-';
         }
         else if($sem2_courses->total_marks>57 && $sem2_courses->total_marks<60)
         {
           $sem2_grades='D+';
         }
         else if($sem2_courses->total_marks>49 && $sem2_courses->total_marks<58)
         {
           $sem2_grades='D';
         }
         else
         {
           $sem2_grades='F';
         }
         // grades code end 





             if($sem2_courses->total_marks==50)
             {
              $sem2_points[]=1;
             }
            else if($sem2_courses->total_marks==51)
            {
              $sem2_points[]=1.1;
            }
            else if($sem2_courses->total_marks==52)
            {
              $sem2_points[]=1.2;
            }
            else if($sem2_courses->total_marks==53)
            {
              $sem2_points[]=1.3;
            }
            else if($sem2_courses->total_marks==54)
            {
              $sem2_points[]=1.4;
            }
            else if($sem2_courses->total_marks==55)
            {
              $sem2_points[]=1.5;
            }
            else if($sem2_courses->total_marks==56)
            {
              $sem2_points[]=1.6;
            }
            else if($sem2_courses->total_marks==57)
            {
              $sem2_points[]=1.7;
            }
            else if($sem2_courses->total_marks==58)
            {
              $sem2_points[]=1.8;
            }
            else if($sem2_courses->total_marks==59)
            {
              $sem2_points[]=1.9;
            }
            else if($sem2_courses->total_marks==60)
            {
              $sem2_points[]=2;
            }
            else if($sem2_courses->total_marks==61)
            {
              $sem2_points[]=2.1;
            }
            else if($sem2_courses->total_marks==62)
            {
              $sem2_points[]=2.2;
            }
            else if($sem2_courses->total_marks==63)
            {
              $sem2_points[]=2.3;
            }
            else if($sem2_courses->total_marks==64)
            {
              $sem2_points[]=2.4;
            }
            else if($sem2_courses->total_marks==65)
            {
              $sem2_points[]=2.5;
            }
            else if($sem2_courses->total_marks==66)
            {
              $sem2_points[]=2.6;
            }
            else if($sem2_courses->total_marks==67)
            {
              $sem2_points[]=2.7;
            }
            else if($sem2_courses->total_marks==68)
            {
              $sem2_points[]=2.8;
            }
            else if($sem2_courses->total_marks==69)
            {
              $sem2_points[]=2.9;
            }
            else if($sem2_courses->total_marks==70)
            {
              $sem2_points[]=3;
            }
            else if($sem2_courses->total_marks==71)
            {
              $sem2_points[]=3.1;
            }
            else if($sem2_courses->total_marks==72)
            {
              $sem2_points[]=3.2;
            }
            else if($sem2_courses->total_marks==73)
            {
              $sem2_points[]=3.3;
            }
            else if($sem2_courses->total_marks==74)
            {
              $sem2_points[]=3.4;
            }
            else if($sem2_courses->total_marks==75)
            {
              $sem2_points[]=3.5;
            }
            else if($sem2_courses->total_marks==76)
            {
              $sem2_points[]=3.6;
            }
            else if($sem2_courses->total_marks==77)
            {
              $sem2_points[]=3.7;
            }
            else if($sem2_courses->total_marks==78)
            {
              $sem2_points[]=3.8;
            }
            else if($sem2_courses->total_marks==79)
            {
              $sem2_points[]=3.9;
            }
            else if($sem2_courses->total_marks>=80)
            {
              $sem2_points[]=4;
            }
            else
            {
              $sem2_points[]=0;
            }
            
        }

        for($i=0; $i<$sem2_lenght_check; $i++)
        {
          $gp= $sem2_cr_hrs[$i]*$sem2_points[$i];    
          $sem2_gp[]=$gp;
        }

        $sem2_total_gp=array_sum($sem2_gp);
        $sem2_total_cr_hrs=array_sum($sem2_cr_hrs);

        $sem2_gpa= $sem2_total_gp/$sem2_total_cr_hrs;

        $all_gp=$sem1_total_gp+$sem2_total_gp;
        $all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs;

        $cgpa=$all_gp/$all_cr_hrs;


        }

        else
        {

          $sem2_course_titles=0;
          $sem2_course_codes=0;
          $sem2_obtained_marks=0;
          $sem2_cr_hrs=0;
          $sem2_points=0;
          $sem2_gp=0;
          $sem2_gpa=0;
          $sem2_lenght_check=0;
          $sem2_total_cr_hrs=0;

          $sem3_course_titles=0;
          $sem3_course_codes=0;
          $sem3_obtained_marks=0;
          $sem3_cr_hrs=0;
          $sem3_points=0;
          $sem3_gp=0;
          $sem3_gpa=0;
          $sem3_lenght_check=0;
          $sem3_total_cr_hrs=0;

          $sem4_course_titles=0;
          $sem4_course_codes=0;
          $sem4_obtained_marks=0;
          $sem4_cr_hrs=0;
          $sem4_points=0;
          $sem4_gp=0;
          $sem4_gpa=0;
          $sem4_lenght_check=0;
          $sem4_total_cr_hrs=0;

          $sem5_course_titles=0;
          $sem5_course_codes=0;
          $sem5_obtained_marks=0;
          $sem5_cr_hrs=0;
          $sem5_points=0;
          $sem5_gp=0;
          $sem5_gpa=0;
          $sem5_lenght_check=0;
          $sem5_total_cr_hrs=0;

          $sem6_course_titles=0;
          $sem6_course_codes=0;
          $sem6_obtained_marks=0;
          $sem6_cr_hrs=0;
          $sem6_points=0;
          $sem6_gp=0;
          $sem6_gpa=0;
          $sem6_lenght_check=0;
          $sem6_total_cr_hrs=0;

          $sem7_course_titles=0;
          $sem7_course_codes=0;
          $sem7_obtained_marks=0;
          $sem7_cr_hrs=0;
          $sem7_points=0;
          $sem7_gp=0;
          $sem7_gpa=0;
          $sem7_lenght_check=0;
          $sem7_total_cr_hrs=0;

          $sem8_course_titles=0;
          $sem8_course_codes=0;
          $sem8_obtained_marks=0;
          $sem8_cr_hrs=0;
          $sem8_points=0;
          $sem8_gp=0;
          $sem8_gpa=0;
          $sem8_lenght_check=0;
          $sem8_total_cr_hrs=0;
          
          return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','cgpa']));
        }




 // for  semester 3 

        

 $sem3_subjects = results::where('roll_no','=',$stu_roll)->where('semester','3rd')->get();
 $sem3_lenght_check=sizeof($sem3_subjects);

 if($sem3_lenght_check>0)
 {


      $sem3_cr_hrs=array();
 $sem3_points=array();
 $sem3_gp=array();
 $sem3_grades=array();
 $sem3_course_titles=array();
 $sem3_course_codes=array();
 $sem3_obtained_marks=array();

 foreach($sem3_subjects as $sem3_courses)
 {
   $sem3_course_title=$sem3_courses->course_title;
   $sem3_course_titles[]=$sem3_course_title;
   
   $sem3_course_code=$sem3_courses->course_code;
   $sem3_course_codes[]=$sem3_courses->course_code;

   $sem3_obt_marks=$sem3_courses->total_marks;
   $sem3_obtained_marks[]=$sem3_obt_marks;

   $sem3_credit_hrs= $sem3_courses->theory_cr_hrs+$sem3_courses->lab_cr_hrs;
   $sem3_cr_hrs[]=$sem3_credit_hrs;


   //for grades
   if($sem3_courses->total_marks>=90)
   {
     $sem3_grades='A+';
   }
  else if($sem3_courses->total_marks>84 && $sem3_courses->total_marks<90)
   {
     $sem3_grades='A';
   }
   else if($sem3_courses->total_marks>79 && $sem3_courses->total_marks<85)
   {
     $sem3_grades='A-';
   }
  else if($sem3_courses->total_marks>79 && $sem3_courses->total_marks<85)
   {
     $sem3_grades='B+';
   }
   else if($sem3_courses->total_marks>72 && $sem3_courses->total_marks<76)
   {
     $sem3_grades='B';
   }
   else if($sem3_courses->total_marks>69 && $sem3_courses->total_marks<73)
   {
     $sem3_grades='B-';
   }
   else if($sem3_courses->total_marks>65 && $sem3_courses->total_marks<70)
   {
     $sem3_grades='C+';
   }
   else if($sem3_courses->total_marks>62 && $sem3_courses->total_marks<66)
   {
     $sem3_grades='C';
   }
   else if($sem3_courses->total_marks>59 && $sem3_courses->total_marks<63)
   {
     $sem3_grades='C-';
   }
   else if($sem3_courses->total_marks>57 && $sem3_courses->total_marks<60)
   {
     $sem3_grades='D+';
   }
   else if($sem3_courses->total_marks>49 && $sem3_courses->total_marks<58)
   {
     $sem3_grades='D';
   }
   else
   {
     $sem3_grades='F';
   }
   // grades code end 





      if($sem3_courses->total_marks==50)
      {
       $sem3_points[]=1;
      }
     else if($sem3_courses->total_marks==51)
     {
       $sem3_points[]=1.1;
     }
     else if($sem3_courses->total_marks==52)
     {
       $sem3_points[]=1.2;
     }
     else if($sem3_courses->total_marks==53)
     {
       $sem3_points[]=1.3;
     }
     else if($sem3_courses->total_marks==54)
     {
       $sem3_points[]=1.4;
     }
     else if($sem3_courses->total_marks==55)
     {
       $sem3_points[]=1.5;
     }
     else if($sem3_courses->total_marks==56)
     {
       $sem3_points[]=1.6;
     }
     else if($sem3_courses->total_marks==57)
     {
       $sem3_points[]=1.7;
     }
     else if($sem3_courses->total_marks==58)
     {
       $sem3_points[]=1.8;
     }
     else if($sem3_courses->total_marks==59)
     {
       $sem3_points[]=1.9;
     }
     else if($sem3_courses->total_marks==60)
     {
       $sem3_points[]=2;
     }
     else if($sem3_courses->total_marks==61)
     {
       $sem3_points[]=2.1;
     }
     else if($sem3_courses->total_marks==62)
     {
       $sem3_points[]=2.2;
     }
     else if($sem3_courses->total_marks==63)
     {
       $sem3_points[]=2.3;
     }
     else if($sem3_courses->total_marks==64)
     {
       $sem3_points[]=2.4;
     }
     else if($sem3_courses->total_marks==65)
     {
       $sem3_points[]=2.5;
     }
     else if($sem3_courses->total_marks==66)
     {
       $sem3_points[]=2.6;
     }
     else if($sem3_courses->total_marks==67)
     {
       $sem3_points[]=2.7;
     }
     else if($sem3_courses->total_marks==68)
     {
       $sem3_points[]=2.8;
     }
     else if($sem3_courses->total_marks==69)
     {
       $sem3_points[]=2.9;
     }
     else if($sem3_courses->total_marks==70)
     {
       $sem3_points[]=3;
     }
     else if($sem3_courses->total_marks==71)
     {
       $sem3_points[]=3.1;
     }
     else if($sem3_courses->total_marks==72)
     {
       $sem3_points[]=3.2;
     }
     else if($sem3_courses->total_marks==73)
     {
       $sem3_points[]=3.3;
     }
     else if($sem3_courses->total_marks==74)
     {
       $sem3_points[]=3.4;
     }
     else if($sem3_courses->total_marks==75)
     {
       $sem3_points[]=3.5;
     }
     else if($sem3_courses->total_marks==76)
     {
       $sem3_points[]=3.6;
     }
     else if($sem3_courses->total_marks==77)
     {
       $sem3_points[]=3.7;
     }
     else if($sem3_courses->total_marks==78)
     {
       $sem3_points[]=3.8;
     }
     else if($sem3_courses->total_marks==79)
     {
       $sem3_points[]=3.9;
     }
     else if($sem3_courses->total_marks>=80)
     {
       $sem3_points[]=4;
     }
     else
     {
       $sem3_points[]=0;
     }
     
 }

 for($i=0; $i<$sem3_lenght_check; $i++)
 {
   $gp= $sem3_cr_hrs[$i]*$sem3_points[$i];    
   $sem3_gp[]=$gp;
 }

 $sem3_total_gp=array_sum($sem3_gp);
 $sem3_total_cr_hrs=array_sum($sem3_cr_hrs);

 $sem3_gpa= $sem3_total_gp/$sem3_total_cr_hrs;

 $all_gp=$sem3_total_gp+$sem3_total_gp;
 $all_cr_hrs=$sem3_total_cr_hrs+$sem3_total_cr_hrs;

 $cgpa=$all_gp/$all_cr_hrs;


 }

 else
 {

   $sem3_course_titles=0;
   $sem3_course_codes=0;
   $sem3_obtained_marks=0;
   $sem3_cr_hrs=0;
   $sem3_points=0;
   $sem3_gp=0;
   $sem3_gpa=0;
   $sem3_lenght_check=0;
   $sem3_total_cr_hrs=0;

   $sem4_course_titles=0;
   $sem4_course_codes=0;
   $sem4_obtained_marks=0;
   $sem4_cr_hrs=0;
   $sem4_points=0;
   $sem4_gp=0;
   $sem4_gpa=0;
   $sem4_lenght_check=0;
   $sem4_total_cr_hrs=0;

   $sem5_course_titles=0;
   $sem5_course_codes=0;
   $sem5_obtained_marks=0;
   $sem5_cr_hrs=0;
   $sem5_points=0;
   $sem5_gp=0;
   $sem5_gpa=0;
   $sem5_lenght_check=0;
   $sem5_total_cr_hrs=0;

   $sem6_course_titles=0;
   $sem6_course_codes=0;
   $sem6_obtained_marks=0;
   $sem6_cr_hrs=0;
   $sem6_points=0;
   $sem6_gp=0;
   $sem6_gpa=0;
   $sem6_lenght_check=0;
   $sem6_total_cr_hrs=0;

   $sem7_course_titles=0;
   $sem7_course_codes=0;
   $sem7_obtained_marks=0;
   $sem7_cr_hrs=0;
   $sem7_points=0;
   $sem7_gp=0;
   $sem7_gpa=0;
   $sem7_lenght_check=0;
   $sem7_total_cr_hrs=0;

   $sem8_course_titles=0;
   $sem8_course_codes=0;
   $sem8_obtained_marks=0;
   $sem8_cr_hrs=0;
   $sem8_points=0;
   $sem8_gp=0;
   $sem8_gpa=0;
   $sem8_lenght_check=0;
   $sem8_total_cr_hrs=0;
   
   return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','cgpa']));
 }


 
 // for  semester 4 

        

 $sem4_subjects = results::where('roll_no','=',$stu_roll)->where('semester','4th')->get();
 $sem4_lenght_check=sizeof($sem4_subjects);

 if($sem4_lenght_check>0)
 {


      $sem4_cr_hrs=array();
 $sem4_points=array();
 $sem4_gp=array();
 $sem4_grades=array();
 $sem4_course_titles=array();
 $sem4_course_codes=array();
 $sem4_obtained_marks=array();

 foreach($sem4_subjects as $sem4_courses)
 {
   $sem4_course_title=$sem4_courses->course_title;
   $sem4_course_titles[]=$sem4_course_title;
   
   $sem4_course_code=$sem4_courses->course_code;
   $sem4_course_codes[]=$sem4_courses->course_code;

   $sem4_obt_marks=$sem4_courses->total_marks;
   $sem4_obtained_marks[]=$sem4_obt_marks;

   $sem4_credit_hrs= $sem4_courses->theory_cr_hrs+$sem4_courses->lab_cr_hrs;
   $sem4_cr_hrs[]=$sem4_credit_hrs;


//for grades
if($sem4_courses->total_marks>=90)
{
  $sem4_grades='A+';
}
else if($sem4_courses->total_marks>84 && $sem4_courses->total_marks<90)
{
  $sem4_grades='A';
}
else if($sem4_courses->total_marks>79 && $sem4_courses->total_marks<85)
{
  $sem4_grades='A-';
}
else if($sem4_courses->total_marks>79 && $sem4_courses->total_marks<85)
{
  $sem4_grades='B+';
}
else if($sem4_courses->total_marks>72 && $sem4_courses->total_marks<76)
{
  $sem4_grades='B';
}
else if($sem4_courses->total_marks>69 && $sem4_courses->total_marks<73)
{
  $sem4_grades='B-';
}
else if($sem4_courses->total_marks>65 && $sem4_courses->total_marks<70)
{
  $sem4_grades='C+';
}
else if($sem4_courses->total_marks>62 && $sem4_courses->total_marks<66)
{
  $sem4_grades='C';
}
else if($sem4_courses->total_marks>59 && $sem4_courses->total_marks<63)
{
  $sem4_grades='C-';
}
else if($sem4_courses->total_marks>57 && $sem4_courses->total_marks<60)
{
  $sem4_grades='D+';
}
else if($sem4_courses->total_marks>49 && $sem4_courses->total_marks<58)
{
  $sem4_grades='D';
}
else
{
  $sem4_grades='F';
}
// grades code end 




      if($sem4_courses->total_marks==50)
      {
       $sem4_points[]=1;
      }
     else if($sem4_courses->total_marks==51)
     {
       $sem4_points[]=1.1;
     }
     else if($sem4_courses->total_marks==52)
     {
       $sem4_points[]=1.2;
     }
     else if($sem4_courses->total_marks==53)
     {
       $sem4_points[]=1.3;
     }
     else if($sem4_courses->total_marks==54)
     {
       $sem4_points[]=1.4;
     }
     else if($sem4_courses->total_marks==55)
     {
       $sem4_points[]=1.5;
     }
     else if($sem4_courses->total_marks==56)
     {
       $sem4_points[]=1.6;
     }
     else if($sem3_courses->total_marks==57)
     {
       $sem3_points[]=1.7;
     }
     else if($sem4_courses->total_marks==58)
     {
       $sem4_points[]=1.8;
     }
     else if($sem4_courses->total_marks==59)
     {
       $sem4_points[]=1.9;
     }
     else if($sem4_courses->total_marks==60)
     {
       $sem4_points[]=2;
     }
     else if($sem4_courses->total_marks==61)
     {
       $sem4_points[]=2.1;
     }
     else if($sem4_courses->total_marks==62)
     {
       $sem4_points[]=2.2;
     }
     else if($sem4_courses->total_marks==63)
     {
       $sem4_points[]=2.3;
     }
     else if($sem4_courses->total_marks==64)
     {
       $sem4_points[]=2.4;
     }
     else if($sem4_courses->total_marks==65)
     {
       $sem4_points[]=2.5;
     }
     else if($sem4_courses->total_marks==66)
     {
       $sem4_points[]=2.6;
     }
     else if($sem4_courses->total_marks==67)
     {
       $sem4_points[]=2.7;
     }
     else if($sem4_courses->total_marks==68)
     {
       $sem4_points[]=2.8;
     }
     else if($sem4_courses->total_marks==69)
     {
       $sem4_points[]=2.9;
     }
     else if($sem4_courses->total_marks==70)
     {
       $sem4_points[]=3;
     }
     else if($sem4_courses->total_marks==71)
     {
       $sem4_points[]=3.1;
     }
     else if($sem4_courses->total_marks==72)
     {
       $sem4_points[]=3.2;
     }
     else if($sem4_courses->total_marks==73)
     {
       $sem4_points[]=3.3;
     }
     else if($sem4_courses->total_marks==74)
     {
       $sem4_points[]=3.4;
     }
     else if($sem4_courses->total_marks==75)
     {
       $sem4_points[]=3.5;
     }
     else if($sem4_courses->total_marks==76)
     {
       $sem4_points[]=3.6;
     }
     else if($sem4_courses->total_marks==77)
     {
       $sem4_points[]=3.7;
     }
     else if($sem4_courses->total_marks==78)
     {
       $sem4_points[]=3.8;
     }
     else if($sem4_courses->total_marks==79)
     {
       $sem4_points[]=3.9;
     }
     else if($sem4_courses->total_marks>=80)
     {
       $sem4_points[]=4;
     }
     else
     {
       $sem4_points[]=0;
     }
     
 }

 for($i=0; $i<$sem4_lenght_check; $i++)
 {
   $gp= $sem4_cr_hrs[$i]*$sem4_points[$i];    
   $sem4_gp[]=$gp;
 }

 $sem4_total_gp=array_sum($sem4_gp);
 $sem4_total_cr_hrs=array_sum($sem4_cr_hrs);

 $sem4_gpa= $sem4_total_gp/$sem4_total_cr_hrs;

 $all_gp=$sem4_total_gp+$sem4_total_gp;
 $all_cr_hrs=$sem4_total_cr_hrs+$sem4_total_cr_hrs;

 $cgpa=$all_gp/$all_cr_hrs;


 }

 else
 {


   $sem4_course_titles=0;
   $sem4_course_codes=0;
   $sem4_obtained_marks=0;
   $sem4_cr_hrs=0;
   $sem4_points=0;
   $sem4_gp=0;
   $sem4_gpa=0;
   $sem4_lenght_check=0;
   $sem4_total_cr_hrs=0;

   $sem5_course_titles=0;
   $sem5_course_codes=0;
   $sem5_obtained_marks=0;
   $sem5_cr_hrs=0;
   $sem5_points=0;
   $sem5_gp=0;
   $sem5_gpa=0;
   $sem5_lenght_check=0;
   $sem5_total_cr_hrs=0;

   $sem6_course_titles=0;
   $sem6_course_codes=0;
   $sem6_obtained_marks=0;
   $sem6_cr_hrs=0;
   $sem6_points=0;
   $sem6_gp=0;
   $sem6_gpa=0;
   $sem6_lenght_check=0;
   $sem6_total_cr_hrs=0;

   $sem7_course_titles=0;
   $sem7_course_codes=0;
   $sem7_obtained_marks=0;
   $sem7_cr_hrs=0;
   $sem7_points=0;
   $sem7_gp=0;
   $sem7_gpa=0;
   $sem7_lenght_check=0;
   $sem7_total_cr_hrs=0;

   $sem8_course_titles=0;
   $sem8_course_codes=0;
   $sem8_obtained_marks=0;
   $sem8_cr_hrs=0;
   $sem8_points=0;
   $sem8_gp=0;
   $sem8_gpa=0;
   $sem8_lenght_check=0;
   $sem8_total_cr_hrs=0;
   
   return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','sem3_grades','cgpa']));
 }






 // for  semester 5

        

 $sem5_subjects = results::where('roll_no','=',$stu_roll)->where('semester','5th')->get();
 $sem5_lenght_check=sizeof($sem5_subjects);

 if($sem5_lenght_check>0)
 {


      $sem5_cr_hrs=array();
 $sem5_points=array();
 $sem5_gp=array();
 $sem5_grades=array();
 $sem5_course_titles=array();
 $sem5_course_codes=array();
 $sem5_obtained_marks=array();

 foreach($sem5_subjects as $sem5_courses)
 {
   $sem5_course_title=$sem5_courses->course_title;
   $sem5_course_titles[]=$sem5_course_title;
   
   $sem5_course_code=$sem5_courses->course_code;
   $sem5_course_codes[]=$sem5_courses->course_code;

   $sem5_obt_marks=$sem5_courses->total_marks;
   $sem5_obtained_marks[]=$sem5_obt_marks;

   $sem5_credit_hrs= $sem5_courses->theory_cr_hrs+$sem5_courses->lab_cr_hrs;
   $sem5_cr_hrs[]=$sem5_credit_hrs;


//for grades
if($sem5_courses->total_marks>=90)
{
  $sem5_grades='A+';
}
else if($sem5_courses->total_marks>84 && $sem5_courses->total_marks<90)
{
  $sem5_grades='A';
}
else if($sem5_courses->total_marks>79 && $sem5_courses->total_marks<85)
{
  $sem5_grades='A-';
}
else if($sem5_courses->total_marks>79 && $sem5_courses->total_marks<85)
{
  $sem5_grades='B+';
}
else if($sem5_courses->total_marks>72 && $sem5_courses->total_marks<76)
{
  $sem5_grades='B';
}
else if($sem5_courses->total_marks>69 && $sem5_courses->total_marks<73)
{
  $sem5_grades='B-';
}
else if($sem5_courses->total_marks>65 && $sem5_courses->total_marks<70)
{
  $sem5_grades='C+';
}
else if($sem5_courses->total_marks>62 && $sem5_courses->total_marks<66)
{
  $sem5_grades='C';
}
else if($sem5_courses->total_marks>59 && $sem5_courses->total_marks<63)
{
  $sem5_grades='C-';
}
else if($sem5_courses->total_marks>57 && $sem5_courses->total_marks<60)
{
  $sem5_grades='D+';
}
else if($sem5_courses->total_marks>49 && $sem5_courses->total_marks<58)
{
  $sem5_grades='D';
}
else
{
  $sem5_grades='F';
}
// grades code end 



      if($sem5_courses->total_marks==50)
      {
       $sem5_points[]=1;
      }
     else if($sem5_courses->total_marks==51)
     {
       $sem5_points[]=1.1;
     }
     else if($sem5_courses->total_marks==52)
     {
       $sem5_points[]=1.2;
     }
     else if($sem5_courses->total_marks==53)
     {
       $sem5_points[]=1.3;
     }
     else if($sem5_courses->total_marks==54)
     {
       $sem5_points[]=1.4;
     }
     else if($sem5_courses->total_marks==55)
     {
       $sem5_points[]=1.5;
     }
     else if($sem5_courses->total_marks==56)
     {
       $sem5_points[]=1.6;
     }
     else if($sem5_courses->total_marks==57)
     {
       $sem5_points[]=1.7;
     }
     else if($sem5_courses->total_marks==58)
     {
       $sem5_points[]=1.8;
     }
     else if($sem5_courses->total_marks==59)
     {
       $sem5_points[]=1.9;
     }
     else if($sem5_courses->total_marks==60)
     {
       $sem5_points[]=2;
     }
     else if($sem5_courses->total_marks==61)
     {
       $sem5_points[]=2.1;
     }
     else if($sem5_courses->total_marks==62)
     {
       $sem5_points[]=2.2;
     }
     else if($sem5_courses->total_marks==63)
     {
       $sem5_points[]=2.3;
     }
     else if($sem5_courses->total_marks==64)
     {
       $sem5_points[]=2.4;
     }
     else if($sem5_courses->total_marks==65)
     {
       $sem5_points[]=2.5;
     }
     else if($sem5_courses->total_marks==66)
     {
       $sem5_points[]=2.6;
     }
     else if($sem5_courses->total_marks==67)
     {
       $sem5_points[]=2.7;
     }
     else if($sem_courses->total_marks==68)
     {
       $sem5_points[]=2.8;
     }
     else if($sem5_courses->total_marks==69)
     {
       $sem5_points[]=2.9;
     }
     else if($sem5_courses->total_marks==70)
     {
       $sem5_points[]=3;
     }
     else if($sem5_courses->total_marks==71)
     {
       $sem5_points[]=3.1;
     }
     else if($sem5_courses->total_marks==72)
     {
       $sem5_points[]=3.2;
     }
     else if($sem5_courses->total_marks==73)
     {
       $sem5_points[]=3.3;
     }
     else if($sem5_courses->total_marks==74)
     {
       $sem5_points[]=3.4;
     }
     else if($sem5_courses->total_marks==75)
     {
       $sem5_points[]=3.5;
     }
     else if($sem5_courses->total_marks==76)
     {
       $sem5_points[]=3.6;
     }
     else if($sem5_courses->total_marks==77)
     {
       $sem5_points[]=3.7;
     }
     else if($sem5_courses->total_marks==78)
     {
       $sem5_points[]=3.8;
     }
     else if($sem5_courses->total_marks==79)
     {
       $sem5_points[]=3.9;
     }
     else if($sem5_courses->total_marks>=80)
     {
       $sem5_points[]=4;
     }
     else
     {
       $sem5_points[]=0;
     }
     
 }

 for($i=0; $i<$sem5_lenght_check; $i++)
 {
   $gp= $sem5_cr_hrs[$i]*$sem5_points[$i];    
   $sem5_gp[]=$gp;
 }

 $sem5_total_gp=array_sum($sem5_gp);
 $sem5_total_cr_hrs=array_sum($sem5_cr_hrs);

 $sem5_gpa= $sem5_total_gp/$sem5_total_cr_hrs;

 $all_gp=$sem5_total_gp+$sem5_total_gp;
 $all_cr_hrs=$sem5_total_cr_hrs+$sem5_total_cr_hrs;

 $cgpa=$all_gp/$all_cr_hrs;


 }

 else
 {

  

   $sem5_course_titles=0;
   $sem5_course_codes=0;
   $sem5_obtained_marks=0;
   $sem5_cr_hrs=0;
   $sem5_points=0;
   $sem5_gp=0;
   $sem5_gpa=0;
   $sem5_lenght_check=0;
   $sem5_total_cr_hrs=0;

   $sem6_course_titles=0;
   $sem6_course_codes=0;
   $sem6_obtained_marks=0;
   $sem6_cr_hrs=0;
   $sem6_points=0;
   $sem6_gp=0;
   $sem6_gpa=0;
   $sem6_lenght_check=0;
   $sem6_total_cr_hrs=0;

   $sem7_course_titles=0;
   $sem7_course_codes=0;
   $sem7_obtained_marks=0;
   $sem7_cr_hrs=0;
   $sem7_points=0;
   $sem7_gp=0;
   $sem7_gpa=0;
   $sem7_lenght_check=0;
   $sem7_total_cr_hrs=0;

   $sem8_course_titles=0;
   $sem8_course_codes=0;
   $sem8_obtained_marks=0;
   $sem8_cr_hrs=0;
   $sem8_points=0;
   $sem8_gp=0;
   $sem8_gpa=0;
   $sem8_lenght_check=0;
   $sem8_total_cr_hrs=0;
   
   return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','sem3_grades','sem4_grades','cgpa']));
 }




 // for  semester 6 

        

 $sem6_subjects = results::where('roll_no','=',$stu_roll)->where('semester','6th')->get();
 $sem6_lenght_check=sizeof($sem6_subjects);

 if($sem6_lenght_check>0)
 {


      $sem6_cr_hrs=array();
 $sem6_points=array();
 $sem6_gp=array();
 $sem6_grades=array();
 $sem6_course_titles=array();
 
 $sem6_course_codes=array();
 $sem6_obtained_marks=array();

 foreach($sem6_subjects as $sem6_courses)
 {
   $sem6_course_title=$sem6_courses->course_title;
   $sem6_course_titles[]=$sem6_course_title;
   
   $sem6_course_code=$sem6_courses->course_code;
   $sem6_course_codes[]=$sem6_courses->course_code;

   $sem6_obt_marks=$sem6_courses->total_marks;
   $sem6_obtained_marks[]=$sem6_obt_marks;

   $sem6_credit_hrs= $sem6_courses->theory_cr_hrs+$sem6_courses->lab_cr_hrs;
   $sem6_cr_hrs[]=$sem6_credit_hrs;


//for grades
if($sem6_courses->total_marks>=90)
{
  $sem6_grades='A+';
}
else if($sem6_courses->total_marks>84 && $sem6_courses->total_marks<90)
{
  $sem6_grades='A';
}
else if($sem6_courses->total_marks>79 && $sem6_courses->total_marks<85)
{
  $sem6_grades='A-';
}
else if($sem6_courses->total_marks>79 && $sem6_courses->total_marks<85)
{
  $sem6_grades='B+';
}
else if($sem6_courses->total_marks>72 && $sem6_courses->total_marks<76)
{
  $sem6_grades='B';
}
else if($sem6_courses->total_marks>69 && $sem6_courses->total_marks<73)
{
  $sem6_grades='B-';
}
else if($sem6_courses->total_marks>65 && $sem6_courses->total_marks<70)
{
  $sem6_grades='C+';
}
else if($sem6_courses->total_marks>62 && $sem6_courses->total_marks<66)
{
  $sem6_grades='C';
}
else if($sem6_courses->total_marks>59 && $sem6_courses->total_marks<63)
{
  $sem6_grades='C-';
}
else if($sem6_courses->total_marks>57 && $sem6_courses->total_marks<60)
{
  $sem6_grades='D+';
}
else if($sem6_courses->total_marks>49 && $sem6_courses->total_marks<58)
{
  $sem6_grades='D';
}
else
{
  $sem6_grades='F';
}
// grades code end 



      if($sem6_courses->total_marks==50)
      {
       $sem6_points[]=1;
      }
     else if($sem6_courses->total_marks==51)
     {
       $sem6_points[]=1.1;
     }
     else if($sem6_courses->total_marks==52)
     {
       $sem6_points[]=1.2;
     }
     else if($sem6_courses->total_marks==53)
     {
       $sem6_points[]=1.3;
     }
     else if($sem6_courses->total_marks==54)
     {
       $sem6_points[]=1.4;
     }
     else if($sem6_courses->total_marks==55)
     {
       $sem6_points[]=1.5;
     }
     else if($sem6_courses->total_marks==56)
     {
       $sem6_points[]=1.6;
     }
     else if($sem6_courses->total_marks==57)
     {
       $sem6_points[]=1.7;
     }
     else if($sem6_courses->total_marks==58)
     {
       $sem6_points[]=1.8;
     }
     else if($sem6_courses->total_marks==59)
     {
       $sem6_points[]=1.9;
     }
     else if($sem6_courses->total_marks==60)
     {
       $sem6_points[]=2;
     }
     else if($sem6_courses->total_marks==61)
     {
       $sem6_points[]=2.1;
     }
     else if($sem6_courses->total_marks==62)
     {
       $sem6_points[]=2.2;
     }
     else if($sem6_courses->total_marks==63)
     {
       $sem6_points[]=2.3;
     }
     else if($sem6_courses->total_marks==64)
     {
       $sem6_points[]=2.4;
     }
     else if($sem6_courses->total_marks==65)
     {
       $sem6_points[]=2.5;
     }
     else if($sem6_courses->total_marks==66)
     {
       $sem6_points[]=2.6;
     }
     else if($sem6_courses->total_marks==67)
     {
       $sem6_points[]=2.7;
     }
     else if($sem6_courses->total_marks==68)
     {
       $sem6_points[]=2.8;
     }
     else if($sem6_courses->total_marks==69)
     {
       $sem6_points[]=2.9;
     }
     else if($sem6_courses->total_marks==70)
     {
       $sem6_points[]=3;
     }
     else if($sem6_courses->total_marks==71)
     {
       $sem6_points[]=3.1;
     }
     else if($sem6_courses->total_marks==72)
     {
       $sem6_points[]=3.2;
     }
     else if($sem6_courses->total_marks==73)
     {
       $sem6_points[]=3.3;
     }
     else if($sem6_courses->total_marks==74)
     {
       $sem6_points[]=3.4;
     }
     else if($sem6_courses->total_marks==75)
     {
       $sem6_points[]=3.5;
     }
     else if($sem6_courses->total_marks==76)
     {
       $sem6_points[]=3.6;
     }
     else if($sem6_courses->total_marks==77)
     {
       $sem6_points[]=3.7;
     }
     else if($sem6_courses->total_marks==78)
     {
       $sem6_points[]=3.8;
     }
     else if($sem6_courses->total_marks==79)
     {
       $sem6_points[]=3.9;
     }
     else if($sem6_courses->total_marks>=80)
     {
       $sem6_points[]=4;
     }
     else
     {
       $sem6_points[]=0;
     }
     
 }

 for($i=0; $i<$sem6_lenght_check; $i++)
 {
   $gp= $sem6_cr_hrs[$i]*$sem6_points[$i];    
   $sem6_gp[]=$gp;
 }

 $sem6_total_gp=array_sum($sem6_gp);
 $sem6_total_cr_hrs=array_sum($sem6_cr_hrs);

 $sem6_gpa= $sem6_total_gp/$sem6_total_cr_hrs;

 $all_gp=$sem6_total_gp+$sem6_total_gp;
 $all_cr_hrs=$sem6_total_cr_hrs+$sem6_total_cr_hrs;

 $cgpa=$all_gp/$all_cr_hrs;


 }

 else
 {


   $sem6_course_titles=0;
   $sem6_course_codes=0;
   $sem6_obtained_marks=0;
   $sem6_cr_hrs=0;
   $sem6_points=0;
   $sem6_gp=0;
   $sem6_gpa=0;
   $sem6_lenght_check=0;
   $sem6_total_cr_hrs=0;

   $sem7_course_titles=0;
   $sem7_course_codes=0;
   $sem7_obtained_marks=0;
   $sem7_cr_hrs=0;
   $sem7_points=0;
   $sem7_gp=0;
   $sem7_gpa=0;
   $sem7_lenght_check=0;
   $sem7_total_cr_hrs=0;

   $sem8_course_titles=0;
   $sem8_course_codes=0;
   $sem8_obtained_marks=0;
   $sem8_cr_hrs=0;
   $sem8_points=0;
   $sem8_gp=0;
   $sem8_gpa=0;
   $sem8_lenght_check=0;
   $sem8_total_cr_hrs=0;
   
   return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','sem3_grades','sem4_grades','sem5_grades','cgpa']));
 }

    
 
 // for  semester 7 

        

 $sem7_subjects = results::where('roll_no','=',$stu_roll)->where('semester','7th')->get();
 $sem7_lenght_check=sizeof($sem7_subjects);

 if($sem7_lenght_check>0)
 {


      $sem7_cr_hrs=array();
 $sem7_points=array();
 $sem7_gp=array();
 $sem7_grades=array();
 $sem7_course_titles=array();
 $sem7_course_codes=array();
 $sem7_obtained_marks=array();

 foreach($sem7_subjects as $sem7_courses)
 {
   $sem7_course_title=$sem7_courses->course_title;
   $sem7_course_titles[]=$sem7_course_title;
   
   $sem7_course_code=$sem7_courses->course_code;
   $sem7_course_codes[]=$sem7_courses->course_code;

   $sem7_obt_marks=$sem7_courses->total_marks;
   $sem7_obtained_marks[]=$sem7_obt_marks;

   $sem7_credit_hrs= $sem7_courses->theory_cr_hrs+$sem7_courses->lab_cr_hrs;
   $sem7_cr_hrs[]=$sem7_credit_hrs;


//for grades
if($sem7_courses->total_marks>=90)
{
  $sem7_grades='A+';
}
else if($sem7_courses->total_marks>84 && $sem7_courses->total_marks<90)
{
  $sem7_grades='A';
}
else if($sem7_courses->total_marks>79 && $sem7_courses->total_marks<85)
{
  $sem7_grades='A-';
}
else if($sem7_courses->total_marks>79 && $sem7_courses->total_marks<85)
{
  $sem7_grades='B+';
}
else if($sem7_courses->total_marks>72 && $sem7_courses->total_marks<76)
{
  $sem7_grades='B';
}
else if($sem7_courses->total_marks>69 && $sem7_courses->total_marks<73)
{
  $sem7_grades='B-';
}
else if($sem7_courses->total_marks>65 && $sem7_courses->total_marks<70)
{
  $sem7_grades='C+';
}
else if($sem7_courses->total_marks>62 && $sem7_courses->total_marks<66)
{
  $sem7_grades='C';
}
else if($sem7_courses->total_marks>59 && $sem7_courses->total_marks<63)
{
  $sem7_grades='C-';
}
else if($sem7_courses->total_marks>57 && $sem7_courses->total_marks<60)
{
  $sem7_grades='D+';
}
else if($sem7_courses->total_marks>49 && $sem7_courses->total_marks<58)
{
  $sem7_grades='D';
}
else
{
  $sem7_grades='F';
}
// grades code end 




      if($sem7_courses->total_marks==50)
      {
       $sem7_points[]=1;
      }
     else if($sem7_courses->total_marks==51)
     {
       $sem7_points[]=1.1;
     }
     else if($sem7_courses->total_marks==52)
     {
       $sem7_points[]=1.2;
     }
     else if($sem7_courses->total_marks==53)
     {
       $sem7_points[]=1.3;
     }
     else if($sem7_courses->total_marks==54)
     {
       $sem7_points[]=1.4;
     }
     else if($sem7_courses->total_marks==55)
     {
       $sem7_points[]=1.5;
     }
     else if($sem7_courses->total_marks==56)
     {
       $sem7_points[]=1.6;
     }
     else if($sem7_courses->total_marks==57)
     {
       $sem7_points[]=1.7;
     }
     else if($sem7_courses->total_marks==58)
     {
       $sem7_points[]=1.8;
     }
     else if($sem7_courses->total_marks==59)
     {
       $sem7_points[]=1.9;
     }
     else if($sem7_courses->total_marks==60)
     {
       $sem7_points[]=2;
     }
     else if($sem7_courses->total_marks==61)
     {
       $sem7_points[]=2.1;
     }
     else if($sem7_courses->total_marks==62)
     {
       $sem7_points[]=2.2;
     }
     else if($sem7_courses->total_marks==63)
     {
       $sem7_points[]=2.3;
     }
     else if($sem7_courses->total_marks==64)
     {
       $sem7_points[]=2.4;
     }
     else if($sem7_courses->total_marks==65)
     {
       $sem7_points[]=2.5;
     }
     else if($sem7_courses->total_marks==66)
     {
       $sem7_points[]=2.6;
     }
     else if($sem7_courses->total_marks==67)
     {
       $sem7_points[]=2.7;
     }
     else if($sem7_courses->total_marks==68)
     {
       $sem7_points[]=2.8;
     }
     else if($sem7_courses->total_marks==69)
     {
       $sem7_points[]=2.9;
     }
     else if($sem7_courses->total_marks==70)
     {
       $sem7_points[]=3;
     }
     else if($sem7_courses->total_marks==71)
     {
       $sem7_points[]=3.1;
     }
     else if($sem7_courses->total_marks==72)
     {
       $sem7_points[]=3.2;
     }
     else if($sem7_courses->total_marks==73)
     {
       $sem7_points[]=3.3;
     }
     else if($sem7_courses->total_marks==74)
     {
       $sem7_points[]=3.4;
     }
     else if($sem7_courses->total_marks==75)
     {
       $sem7_points[]=3.5;
     }
     else if($sem7_courses->total_marks==76)
     {
       $sem7_points[]=3.6;
     }
     else if($sem7_courses->total_marks==77)
     {
       $sem7_points[]=3.7;
     }
     else if($sem7_courses->total_marks==78)
     {
       $sem7_points[]=3.8;
     }
     else if($sem7_courses->total_marks==79)
     {
       $sem7_points[]=3.9;
     }
     else if($sem7_courses->total_marks>=80)
     {
       $sem7_points[]=4;
     }
     else
     {
       $sem7_points[]=0;
     }
     
 }

 for($i=0; $i<$sem7_lenght_check; $i++)
 {
   $gp= $sem7_cr_hrs[$i]*$sem7_points[$i];    
   $sem7_gp[]=$gp;
 }

 $sem7_total_gp=array_sum($sem7_gp);
 $sem7_total_cr_hrs=array_sum($sem7_cr_hrs);

 $sem7_gpa= $sem7_total_gp/$sem7_total_cr_hrs;

 $all_gp=$sem7_total_gp+$sem7_total_gp;
 $all_cr_hrs=$sem7_total_cr_hrs+$sem7_total_cr_hrs;

 $cgpa=$all_gp/$all_cr_hrs;


 }

 else
 {

   
   $sem7_course_titles=0;
   $sem7_course_codes=0;
   $sem7_obtained_marks=0;
   $sem7_cr_hrs=0;
   $sem7_points=0;
   $sem7_gp=0;
   $sem7_gpa=0;
   $sem7_lenght_check=0;
   $sem7_total_cr_hrs=0;

   $sem8_course_titles=0;
   $sem8_course_codes=0;
   $sem8_obtained_marks=0;
   $sem8_cr_hrs=0;
   $sem8_points=0;
   $sem8_gp=0;
   $sem8_gpa=0;
   $sem8_lenght_check=0;
   $sem8_total_cr_hrs=0;
   
   return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','sem3_grades','sem4_grades','sem5_grades','sem6_grades','cgpa']));
 }


 
 // for  semester 8

        

 $sem8_subjects = results::where('roll_no','=',$stu_roll)->where('semester','8th')->get();
 $sem8_lenght_check=sizeof($sem8_subjects);

 if($sem8_lenght_check>0)
 {


      $sem8_cr_hrs=array();
 $sem8_points=array();
 $sem8_gp=array();
 $sem8_grades=array();
 $sem8_course_titles=array();
 $sem8_course_codes=array();
 $sem8_obtained_marks=array();

 foreach($sem8_subjects as $sem8_courses)
 {
   $sem8_course_title=$sem8_courses->course_title;
   $sem8_course_titles[]=$sem8_course_title;
   
   $sem8_course_code=$sem8_courses->course_code;
   $sem8_course_codes[]=$sem8_courses->course_code;

   $sem8_obt_marks=$sem8_courses->total_marks;
   $sem8_obtained_marks[]=$sem8_obt_marks;

   $sem8_credit_hrs= $sem8_courses->theory_cr_hrs+$sem8_courses->lab_cr_hrs;
   $sem8_cr_hrs[]=$sem8_credit_hrs;


//for grades
if($sem8_courses->total_marks>=90)
{
  $sem8_grades='A+';
}
else if($sem8_courses->total_marks>84 && $sem8_courses->total_marks<90)
{
  $sem8_grades='A';
}
else if($sem8_courses->total_marks>79 && $sem8_courses->total_marks<85)
{
  $sem8_grades='A-';
}
else if($sem8_courses->total_marks>79 && $sem8_courses->total_marks<85)
{
  $sem8_grades='B+';
}
else if($sem8_courses->total_marks>72 && $sem8_courses->total_marks<76)
{
  $sem8_grades='B';
}
else if($sem8_courses->total_marks>69 && $sem8_courses->total_marks<73)
{
  $sem8_grades='B-';
}
else if($sem8_courses->total_marks>65 && $sem8_courses->total_marks<70)
{
  $sem8_grades='C+';
}
else if($sem8_courses->total_marks>62 && $sem8_courses->total_marks<66)
{
  $sem8_grades='C';
}
else if($sem8_courses->total_marks>59 && $sem8_courses->total_marks<63)
{
  $sem8_grades='C-';
}
else if($sem8_courses->total_marks>57 && $sem8_courses->total_marks<60)
{
  $sem8_grades='D+';
}
else if($sem8_courses->total_marks>49 && $sem8_courses->total_marks<58)
{
  $sem8_grades='D';
}
else
{
  $sem8_grades='F';
}
// grades code end 




      if($sem8_courses->total_marks==50)
      {
       $sem8_points[]=1;
      }
     else if($sem8_courses->total_marks==51)
     {
       $sem8_points[]=1.1;
     }
     else if($sem8_courses->total_marks==52)
     {
       $sem8_points[]=1.2;
     }
     else if($sem8_courses->total_marks==53)
     {
       $sem8_points[]=1.3;
     }
     else if($sem8_courses->total_marks==54)
     {
       $sem8_points[]=1.4;
     }
     else if($sem8_courses->total_marks==55)
     {
       $sem8_points[]=1.5;
     }
     else if($sem8_courses->total_marks==56)
     {
       $sem8_points[]=1.6;
     }
     else if($sem8_courses->total_marks==57)
     {
       $sem8_points[]=1.7;
     }
     else if($sem8_courses->total_marks==58)
     {
       $sem8_points[]=1.8;
     }
     else if($sem8_courses->total_marks==59)
     {
       $sem8_points[]=1.9;
     }
     else if($sem8_courses->total_marks==60)
     {
       $sem8_points[]=2;
     }
     else if($sem8_courses->total_marks==61)
     {
       $sem8_points[]=2.1;
     }
     else if($sem8_courses->total_marks==62)
     {
       $sem8_points[]=2.2;
     }
     else if($sem8_courses->total_marks==63)
     {
       $sem8_points[]=2.3;
     }
     else if($sem8_courses->total_marks==64)
     {
       $sem8_points[]=2.4;
     }
     else if($sem8_courses->total_marks==65)
     {
       $sem8_points[]=2.5;
     }
     else if($sem8_courses->total_marks==66)
     {
       $sem8_points[]=2.6;
     }
     else if($sem8_courses->total_marks==67)
     {
       $sem8_points[]=2.7;
     }
     else if($sem8_courses->total_marks==68)
     {
       $sem8_points[]=2.8;
     }
     else if($sem8_courses->total_marks==69)
     {
       $sem8_points[]=2.9;
     }
     else if($sem8_courses->total_marks==70)
     {
       $sem8_points[]=3;
     }
     else if($sem8_courses->total_marks==71)
     {
       $sem8_points[]=3.1;
     }
     else if($sem8_courses->total_marks==72)
     {
       $sem8_points[]=3.2;
     }
     else if($sem8_courses->total_marks==73)
     {
       $sem8_points[]=3.3;
     }
     else if($sem8_courses->total_marks==74)
     {
       $sem8_points[]=3.4;
     }
     else if($sem8_courses->total_marks==75)
     {
       $sem8_points[]=3.5;
     }
     else if($sem8_courses->total_marks==76)
     {
       $sem8_points[]=3.6;
     }
     else if($sem8_courses->total_marks==77)
     {
       $sem8_points[]=3.7;
     }
     else if($sem8_courses->total_marks==78)
     {
       $sem8_points[]=3.8;
     }
     else if($sem8_courses->total_marks==79)
     {
       $sem8_points[]=3.9;
     }
     else if($sem8_courses->total_marks>=80)
     {
       $sem8_points[]=4;
     }
     else
     {
       $sem8_points[]=0;
     }
     
 }

 for($i=0; $i<$sem8_lenght_check; $i++)
 {
   $gp= $sem8_cr_hrs[$i]*$sem8_points[$i];    
   $sem8_gp[]=$gp;
 }

 $sem8_total_gp=array_sum($sem8_gp);
 $sem8_total_cr_hrs=array_sum($sem8_cr_hrs);

 $sem8_gpa= $sem8_total_gp/$sem8_total_cr_hrs;

 $all_gp=$sem8_total_gp+$sem8_total_gp;
 $all_cr_hrs=$sem8_total_cr_hrs+$sem8_total_cr_hrs;

 $cgpa=$all_gp/$all_cr_hrs;


 }

 else
 {

   $sem8_course_titles=0;
   $sem8_course_codes=0;
   $sem8_obtained_marks=0;
   $sem8_cr_hrs=0;
   $sem8_points=0;
   $sem8_gp=0;
   $sem8_gpa=0;
   $sem8_lenght_check=0;
   $sem8_total_cr_hrs=0;
   
   return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','sem3_grades','sem4_grades','sem5_grades','sem6_grades','sem7_grades','cgpa']));
 }
         

 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','sem1_grades','sem2_grades','sem3_grades','sem4_grades','sem5_grades','sem6_grades','sem7_grades','sem8_grades','cgpa']));
     }
 
     // student transcript view function end

     // student enroll courses view function start

     public function enroll_courses_view()
     {
         $id= Session('loginId');
         $stu_roll=student::find($id)->roll_no;
         $stu_class=student_class::where('roll_no','=',$stu_roll)->first();
        $stu_sem=$stu_class->semester;
        $stu_programme=$stu_class->programme;

        //  for student profile on side bar 
          $student_personal_info=student::where('id', '=' , $id)->get();
          $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();
        //  for student profile on side bar logic end


         $pre_courses = student_course::where('roll_no',$stu_roll)->count();

        $pre_course_code=$pre_courses;
        if($pre_course_code<1)
      {
        // current semester courses 
        $courses = course::where('semester',$stu_sem)->where('programme','=',$stu_programme)->get();
         $fail="fail";
        //  previous failed courses 
         $failed_courses = results::where('roll_no','=',$stu_roll)->where('status','=',$fail)->get();
        // $failed_lenght =sizeof($failed_courses);
       

          return view('student dashboard.enroll courses',compact(['student_personal_info', 'student_class_info','courses','failed_courses']));
      }

           else
           {
            return back()->with('fail','your courses are already registered');
           }
       
     }


 
     // student enroll courses view function end

     // student enroll courses  function start

     public function enroll_courses(Request $request)
     {
         $id= Session('loginId');



         $stu_roll=student::find($id)->roll_no;
         $stu_class=student_class::where('roll_no','=',$stu_roll)->first();


         $stu_sem=$stu_class->semester;
         $stu_programme=$stu_class->programme;


        
         //  code for personal info on sidebar start
         $student_personal_info=student::where('id', '=' , $id)->get();
         $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();

        // code for personal info on sidebar  end
          
    

          $selected_courses = $request->current_course;
          $total_courses=sizeof($selected_courses);
          
          for($i=0; $i<$total_courses; $i++)
          {
            $selected_courses_data=course::where('course_title','=',$selected_courses[$i])->first();
            $lab_courses=course::where('course_title','=',$selected_courses[$i])->where('lab_cr_hrs','>','0')->count();
            $theory_cr_hrs[$i]=$selected_courses_data->theory_cr_hrs;
            $lab_cr_hrs[$i]=$selected_courses_data->lab_cr_hrs;     
          }

          
          $theory_total=(array_sum($theory_cr_hrs));
          $lab_total=(array_sum($lab_cr_hrs));
          $total_cr_hrs = $theory_total+$lab_total;

          if($total_courses>6)
          {
            return back()->with('fail', 'you can not pick more than six courses');
          }
          else if($total_cr_hrs>18)
          {
            return back()->with('fail','you can not pick more than 18 credit hours');
          }

          else if($lab_total>3)
          {
            return back()->with('fail','You can not pic more then three lab courses');
          }
          
         else
         {
            for($i=0; $i<$total_courses; $i++)
            {
              $selected_courses_data=course::where('course_title','=',$selected_courses[$i])->first();
              $course_code[$i]=$selected_courses_data->course_code;
              $theory_cr_hrs[$i]=$selected_courses_data->theory_cr_hrs;
              $lab_cr_hrs[$i]=$selected_courses_data->lab_cr_hrs;
         
              $fail="fail";
              $delete_failed= results::where('course_title','=',$selected_courses[$i])->where('status','=',$fail)->where('roll_no',$stu_roll)->count();

              if($delete_failed>0)
              {
                DB::table('results')->where('course_title','=',$selected_courses[$i])->where('status','=',$fail)->where('roll_no',$stu_roll)->delete();
              }


              student_course::insert([
                  'department'=> $stu_class->department,
                  'programme'=> $stu_class->programme,
                  'student_name'=> $stu_class->student_name,
                  'roll_no'=> $stu_class->roll_no,
                  'semester'=> $stu_class->semester,
                  'section'=> $stu_class->section,
                  'session'=> $stu_class->session,
                  'year'=> $stu_class->year,
                  'course_title'=> $request->current_course[$i],
                  'course_code'=> $course_code[$i],
                  'theory_cr_hrs'=> $theory_cr_hrs[$i],
                  'lab_cr_hrs'=> $lab_cr_hrs[$i],
                ]);

                results::insert([
                    'department'=> $stu_class->department,
                    'programme'=> $stu_class->programme,
                    'stu_name'=> $stu_class->student_name,
                    'roll_no'=> $stu_class->roll_no,
                    'semester'=> $stu_class->semester,
                    'section'=> $stu_class->section,
                    'session'=> $stu_class->session,
                    'year'=> $stu_class->year,
                    'course_title'=> $request->current_course[$i],
                    'course_code'=> $course_code[$i],
                    'theory_cr_hrs'=> $theory_cr_hrs[$i],
                    'lab_cr_hrs'=> $lab_cr_hrs[$i],
                  ]);         
            }
          
         }
       
         return redirect()->route('student_dashboard')->with('success','course registered successfully');
     }


 
     // student enroll courses  function end

     

     // student complete profile function start
     public function complete_profile(Request $request)
     {

    // image insert coding 

    $image=  $request->file('image');
    $name_gen = hexdec(uniqid());
    $img_extension = strtolower($image->getClientOriginalExtension());
    $image_name= $name_gen.'.'.$img_extension;
    $up_location='profile images/student/';
    $last_img=$up_location.$image_name;
    $image->move($up_location,$image_name);
  
    $id= Session('loginId');

   
    DB::table('students')
            ->where('id', $id)
            ->update([
                
                'name'=> $request->name,
                'email'=>$request->email,
                'father_name'=>$request->father_name,
                'Gender'=>$request->gender,
                'Nationality'=>$request->nationality,
                'CNIC'=>$request->cnic,
                'Date_of_Birth'=>$request->dob,
                'phone_no'=>$request->phone,
                'Religion'=>$request->religion,
                'Admission_date'=>$request->admission_date,
                'ssc_degree_name'=>$request->ssc_degree_name,
                'ssc_board_name'=>$request->ssc_board_name,
                'ssc_total_marks'=>$request->ssc_tot_marks,
                'ssc_obt_marks'=>$request->ssc_obt_marks,
                'hssc_degree_name'=>$request->hssc_degree_name,
                'hssc_board_name'=>$request->hssc_board_name,
                'hssc_total_marks'=>$request->hssc_tot_marks,
                'hssc_obt_marks'=>$request->hssc_obt_marks,
                'city'=>$request->city,
                'mailing_adress'=>$request->mailing_adress,
                'domicile_district'=>$request->domicile_dist,
                'domicile_province'=>$request->domicile_prov,
                'profile_pic'=>$last_img,
                'created_at'=>carbon::now()
            ]);
    
   

    return view('student dashboard.login')->with('success','Profile completed successfully, please Login');
      }
     // student complete profile function end


} //    controller class end 


