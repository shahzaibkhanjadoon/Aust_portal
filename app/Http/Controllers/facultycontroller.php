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
use App\Http\facultyResponses\LoginResponse;
// use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Auth;
use App\Models\student;
use App\Models\faculty;
use App\Models\results;
use App\Models\student_class;
use App\Models\student_course;
use App\Models\attendance;
use App\Models\instructor;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



class facultycontroller extends Controller
{
//     /**   default auth start
//      * The guard implementation.
//      *
//      * @var \Illuminate\Contracts\Auth\StatefulGuard
//      */
//     protected $guard;

//     /**
//      * Create a new controller instance.
//      *
//      * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
//      * @return void
//      */
//     public function __construct(StatefulGuard $guard)
//     {
//         $this->guard = $guard;
//     }

//     public function loginform()
//     {
//         return view('faculty dashboard.login' , ['guard' => 'faculty']);
//     }
//     /**
//      * Show the login view.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Laravel\Fortify\Contracts\LoginViewResponse
//      */
//     public function create(Request $request): LoginViewResponse
//     {
//         return app(LoginViewResponse::class);
//     }

//     /**
//      * Attempt to authenticate a new session.
//      *
//      * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
//      * @return mixed
//      */
//     public function store(LoginRequest $request)
//     {
//         return $this->loginPipeline($request)->then(function ($request) {
//             return app(LoginResponse::class);
//         });
//     }

//     /**
//      * Get the authentication pipeline instance.
//      *
//      * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
//      * @return \Illuminate\Pipeline\Pipeline
//      */
//     protected function loginPipeline(LoginRequest $request)
//     {
//         if (Fortify::$authenticateThroughCallback) {
//             return (new Pipeline(app()))->send($request)->through(array_filter(
//                 call_user_func(Fortify::$authenticateThroughCallback, $request)
//             ));
//         }

//         if (is_array(config('fortify.pipelines.login'))) {
//             return (new Pipeline(app()))->send($request)->through(array_filter(
//                 config('fortify.pipelines.login')
//             ));
//         }

//         return (new Pipeline(app()))->send($request)->through(array_filter([
//             config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
//             Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
//             AttemptToAuthenticate::class,
//             PrepareAuthenticatedSession::class,
//         ]));
//     }

//     /**
//      * Destroy an authenticated session.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Laravel\Fortify\Contracts\LogoutResponse
//      */
//     public function destroy(Request $request): LogoutResponse
//     {
//         $this->guard->logout();

//         $request->session()->invalidate();

//         $request->session()->regenerateToken();

//         return app(LogoutResponse::class);
//     }


//     // faculty change password view function 
// public function change_password_view()
// {
//     return view('faculty dashboard.change password');
// }


//  // faculty password update  function

//  public function update_password(Request $request)

//  {
//      $validateData= $request->validate([
//          'oldpassword' => 'required',
//          'password' => 'required | confirmed' ,
//      ]);
        
//      // $passworddata=DB::table('student')->Where('id','=' , 4)->get()->all();
//      //  $hashpassword= $passworddata->password;

//      $id = Auth::guard('faculty')->user()->id;
//      $hashpassword = faculty::find($id)->password;
//      if(Hash::check($request->oldpassword,$hashpassword))
//      {
//          // $student = DB::table('student')->Where('id','=' , 4)->get()->all();
     
//           $student = faculty::find($id);
//          $student->password = Hash::make($request->password);
//          $student->save();
//          Auth::guard('faculty')->logout();
//          return redirect()->route('home');
//      }
//      else
//      {
//          return redirect()->back();
//      }
//  } dafault auth end


  
    // student login view function 
    public function faculty_login_view()
    {
        return view('faculty dashboard.login');
    }


// faculty login logic function start
public function faculty_login(Request $request)
{
    $request->validate([
         'email' => 'required' ,
         'password' => 'required'
    ]);
     
    $faculty = faculty::where('email', '=' , $request->email)->first();

    if($faculty)
    {
        if(Hash::check($request->password , $faculty->password))
        {
            $request->session()->put('loginId',$faculty->id);
            $id= Session('loginId');
            $faculty_personal_info=faculty::where('id', '=' , $id)->get();
            $faculty_email=faculty::find($id)->email;


            //profile complete check //
            $check=faculty::find($id)->phone;
            if($check===null)
            {
               return view('faculty dashboard.profile');                     
            }

           else
           {
            return view('faculty dashboard.dashboard',compact('faculty_personal_info'));
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



}  //faculty login function end

// faculty logout function start

public function logout()
{
    if(Session::has('loginId'))
    {
        Session::pull('loginId');
    }
    return redirect()->route('home');
}

// faculty logout function end 

// student change password view function 
     
public function change_password_view()
{
    return view('faculty dashboard.change password');
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
    $hashpassword = faculty::find($id)->password;
    if(Hash::check($request->oldpassword,$hashpassword))
    {
    
         $faculty = faculty::find($id);
        $faculty->password = Hash::make($request->password);
        $faculty->save();
        Auth::guard('faculty')->logout();
        return redirect()->route('home');
    }
    else
    {
        return redirect()->back()->with('fail','old password not matched');
    }
}

// student change password update function end

// faculty dashboard button function start 
public function dashboard()
{
  $id= Session('loginId');
  $faculty_personal_info=faculty::where('id', '=' , $id)->get();
  return view('faculty dashboard.dashboard',compact('faculty_personal_info'));
}
  // faculty dashboard button function end


  // student complete profile function start
  public function complete_profile(Request $request)
  {

//  image insert coding 

 $image=  $request->file('image');
 $name_gen = hexdec(uniqid());
 $img_extension = strtolower($image->getClientOriginalExtension());
 $image_name= $name_gen.'.'.$img_extension;
 $up_location='profile images/faculty/';
 $last_img=$up_location.$image_name;
 $image->move($up_location,$image_name);

 $id= Session('loginId');


 DB::table('faculties')
         ->where('id', $id)
         ->update([
             
             'name'=> $request->name,
             'gender'=>$request->gender,
             'nationality'=>$request->nationality,
             'cnic'=>$request->cnic,
             'phone'=>$request->phone,
             'religion'=>$request->religion,
             'profile_photo_path'=>$last_img,
             'Employe_id'=>$request->employe_id,
             'contract'=>$request->contract,
             'designation'=>$request->designation,
             'status'=>$request->status,
             'created_at'=>carbon::now()
         ]);
 


 return view('faculty dashboard.login')->with('success','Profile completed successfully, please Login');
  }
  // student complete profile function end

//   function for courses start 
  public function courses(){
    // code for personal info on side bar start
    $id= Session('loginId');
    $email = faculty::find($id)->email;
    $faculty_personal_info=faculty::where('id', '=' , $id)->get();
    // code for personal info on side bar end

    $courses= instructor::where('instructor_email','=',$email)->get();
    return view('faculty dashboard.courses',compact(['faculty_personal_info','courses']));
  }
//   function for courses end 

//  add_result search function start 
 public function add_result_search()
 {
    // code for personal info on side bar start
    $id= Session('loginId');
    $faculty_personal_info=faculty::where('id', '=' , $id)->get();
    // code for personal info on side bar end

    $email = faculty::find($id)->email;
    $courses= instructor::where('instructor_email','=',$email)->get();

    return view('faculty dashboard.add result search',compact(['faculty_personal_info','courses']));
 }
// add result search function end 


//  add_result function start 
public function add_result(Request $request)
{
   // code for personal info on side bar start
   $id= Session('loginId');
   $faculty_personal_info=faculty::where('id', '=' , $id)->get();
   // code for personal info on side bar end

  
      $courses_data = results::where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)->get();

  
   $result=$request->result;
   $assignment='Assignment';
   $quiz='Quiz';
   $mid='Mid';
   $terminal='Terminal';

   if($result==$assignment)
   {

     return view('faculty dashboard.add assignment result',compact(['faculty_personal_info','courses_data','assignment']));

   }
   if($result==$quiz)
   {
     return view('faculty dashboard.add quiz result',compact(['faculty_personal_info','courses_data','quiz']));
}

   if($result==$mid)
   {
    return view('faculty dashboard.add mid result',compact(['faculty_personal_info','courses_data','mid']));
}
   if($result==$terminal)
   {
    return view('faculty dashboard.add terminal result',compact(['faculty_personal_info','courses_data','terminal']));
}

}
// add result function end 



// add result logic function start 
public function add_result_logic(Request $request)
{

    $type=$request->type;
    $number=$request->no;
    $assignment='Assignment';
    $quiz='Quiz';
    $mid='Mid';
    $terminal='Terminal';


    $roll_no=$request->roll_no;
    $semester=$request->semester;
    $session=$request->session;
    $year=$request->year;
    $course=$request->course;
    $obt_marks = $request->obt_marks;
    $total_students=sizeof($roll_no);


     for($i=0; $i<$total_students; $i++)
     {
       

    if($type==$assignment)
    {
        if($number==1)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
             ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course[$i])->update([
                   
                'assignment_1_date'=>$request->date,
                'assignment_1_tot_marks'=>$request->tot_marks,
                'assignment_1_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
       else if($number==2)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
            ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course[$i])->update([
                   
                'assignment_2_date'=>$request->date,
                'assignment_2_tot_marks'=>$request->tot_marks,
                'assignment_2_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
       else if($number==3)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
            ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course[$i])->update([
                   
                'assignment_3_date'=>$request->date,
                'assignment_3_tot_marks'=>$request->tot_marks,
                'assignment_3_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
     else if($number==4)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
            ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course[$i])->update([
                   
                'assignment_4_date'=>$request->date,
                'assignment_4_tot_marks'=>$request->tot_marks,
                'assignment_4_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
        else
        {
            echo "please try again";
        }

   
    }
if($type==$quiz)
{

    if($number==1)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
             ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course)->update([
                   
                'quiz_1_date'=>$request->date,
                'quiz_1_tot_marks'=>$request->tot_marks,
                'quiz_1_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
        if($number==2)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
            ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course)->update([
                   
                'quiz_2_date'=>$request->date,
                'quiz_2_tot_marks'=>$request->tot_marks,
                'quiz_2_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
        if($number==3)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
            ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course)->update([
                   
                'quiz_3_date'=>$request->date,
                'quiz_3_tot_marks'=>$request->tot_marks,
                'quiz_3_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
      if($number==4)
        {
            DB::table('results')->where('roll_no','=',$roll_no[$i])
            ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course)->update([
                   
                'quiz_4_date'=>$request->date,
                'quiz_4_tot_marks'=>$request->tot_marks,
                'quiz_4_obt_marks'=>$request->obt_marks[$i],
             ]);
        }
}
   if($type==$mid)
   {
    DB::table('results')->where('roll_no','=',$roll_no[$i])
    ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course)->update([
           
        'mid_paper_date'=>$request->date,
        'mid_paper_tot_marks'=>$request->tot_marks,
        'mid_paper_obt_marks'=>$request->obt_marks[$i],
     ]);
   }

   if($type==$terminal)
   {
    DB::table('results')->where('roll_no','=',$roll_no[$i])
    ->where('semester','=',$semester[$i])->where('session','=',$session[$i])->where('year','=',$year[$i])->where('course_title','=',$course)->update([
           
        'final_paper_date'=>$request->date,
        'final_paper_tot_marks'=>$request->tot_marks,
        'final_paper_obt_marks'=>$request->obt_marks[$i],
     ]);
   }

    
   }    

  return Redirect()->route('Add_result_search')->with('success','Result added successfully');

}
// add result logic function end 


//  add_result search function start 
public function compile_result_search()
{
   // code for personal info on side bar start
   $id= Session('loginId');
   $faculty_personal_info=faculty::where('id', '=' , $id)->get();
   // code for personal info on side bar end

   $email = faculty::find($id)->email;
   $courses= instructor::where('instructor_email','=',$email)->get();  
    return view('faculty dashboard.compile result search',compact(['faculty_personal_info','courses']));
}
// add result search function end 

//  compile_result function start 
public function compile_result(Request $request)
{
   // code for personal info on side bar start
   $id= Session('loginId');
   $faculty_personal_info=faculty::where('id', '=' , $id)->get();
   // code for personal info on side bar end

   $filters = DB::table('results')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
    ->get();
   $filter_check=sizeof($filters);
    if($filter_check==0)
    {
        return back()->with('fail','Please apply accurate filters');
    }
   
    else
    {
   $ass_1_check = DB::table('results')
                    ->whereNull('assignment_1_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $ass_1_lenght = sizeof($ass_1_check);

  $ass_2_check = DB::table('results')
                    ->whereNull('assignment_2_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $ass_2_lenght = sizeof( $ass_2_check);
    $ass_3_check = DB::table('results')
                    ->whereNull('assignment_3_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $ass_3_lenght = sizeof($ass_3_check);    
     $ass_4_check = DB::table('results')
                    ->whereNull('assignment_4_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $ass_4_lenght = sizeof($ass_4_check);             

     $quiz_1_check = DB::table('results')
                    ->whereNull('quiz_1_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $quiz_1_lenght = sizeof($quiz_1_check);   
       
    $quiz_2_check = DB::table('results')
                    ->whereNull('quiz_2_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $quiz_2_lenght = sizeof($quiz_2_check);   
    $quiz_3_check = DB::table('results')
                    ->whereNull('quiz_3_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $quiz_3_lenght = sizeof($quiz_3_check);
    $quiz_4_check = DB::table('results')
                    ->whereNull('quiz_4_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $quiz_4_lenght = sizeof($quiz_4_check);      
    $mid_check = DB::table('results')
                    ->whereNull('mid_paper_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $mid_lenght = sizeof($mid_check);   
    $final_check = DB::table('results')
                    ->whereNull('final_paper_obt_marks')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
                    ->get();
                    $final_lenght = sizeof($final_check);  
    }               
                    
    if($ass_1_lenght || $ass_2_lenght || $ass_3_lenght || $ass_4_lenght || $quiz_1_lenght || $quiz_2_lenght || $quiz_3_lenght || $quiz_4_lenght || $mid_lenght || $final_lenght >0)
    {
        return back()->with('fail','Results not complete, please go to view result and check which result is not entered yet.');
    }
   else
   {
    $results = DB::table('results')->where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)
    ->get();

    foreach($results as $result)
    {
        
        $assignment_1_total_marks=$result->assignment_1_tot_marks;
        $assignment_2_total_marks=$result->assignment_2_tot_marks;
        $assignment_3_total_marks=$result->assignment_3_tot_marks;
        $assignment_4_total_marks=$result->assignment_4_tot_marks;
        $assignment_1_marks=$result->assignment_1_obt_marks;
        $assignment_2_marks=$result->assignment_2_obt_marks;
        $assignment_3_marks=$result->assignment_3_obt_marks;
        $assignment_4_marks=$result->assignment_4_obt_marks;

        $quiz_1_total_marks=$result->quiz_1_tot_marks;
        $quiz_2_total_marks=$result->quiz_2_tot_marks;
        $quiz_3_total_marks=$result->quiz_3_tot_marks;
        $quiz_4_total_marks=$result->quiz_4_tot_marks;
        $quiz_1_marks=$result->quiz_1_obt_marks;
        $quiz_2_marks=$result->quiz_2_obt_marks;
        $quiz_3_marks=$result->quiz_3_obt_marks;
        $quiz_4_marks=$result->quiz_4_obt_marks;

        $mid_total_marks=$result->mid_paper_tot_marks;
        $mid_obtained_marks=$result->mid_paper_obt_marks;

        $final_total_marks=$result->final_paper_tot_marks;
        $final_obtained_marks=$result->final_paper_obt_marks;

        //  for assignment aggregate start 
     $all_assignments_total = $assignment_1_total_marks+$assignment_2_total_marks+$assignment_3_total_marks+$assignment_4_total_marks;
     $all_assignments_obtained = $assignment_1_marks+$assignment_2_marks+$assignment_3_marks+$assignment_4_marks;
     $assignments_percentage = ($all_assignments_obtained/$all_assignments_total)*100;
     $assignments_aggregate= ($assignments_percentage/100)*10;
        //  for assignment aggregate end 

         //  for quiz aggregate start 
     $all_quizes_total = $quiz_1_total_marks+$quiz_2_total_marks+$quiz_3_total_marks+$quiz_4_total_marks;
     $all_quizes_obtained = $quiz_1_marks+$quiz_2_marks+$quiz_3_marks+$quiz_4_marks;
     $quizes_percentage = ($all_quizes_obtained/$all_quizes_total)*100;
     $quizes_aggregate= ($assignments_percentage/100)*10;
        //  for quiz aggregate end 

        //  for mid aggregate start 
     $mid_percentage = ($mid_obtained_marks/$mid_total_marks)*100;
     $mid_aggregate= ($mid_percentage/100)*30;
        //  for mid aggregate end 

        //  for final aggregate start 
     $final_percentage = ($final_obtained_marks/$final_total_marks)*100;
     $final_aggregate= ($final_percentage/100)*50;
        //  for final aggregate end 

        // total marks 
       $total = $assignments_aggregate + $quizes_aggregate + $mid_aggregate + $final_aggregate;
       $total=(int)$total;
       $pass="pass";
       $fail="fail";
       $id = array($result->id);
       
       if($total>=50)
       {
        DB::table('results')->where('id',$id)->update([
          
            'total_marks'=>$total,
            'status'=>$pass,
           ]);
       }
       else
       {
        DB::table('results')->where('id',$id)->update([
          
            'total_marks'=>$total,
            'status'=>$fail,
           ]);
       }
       
    }
      return back()->with('success','Results compile successfully');
   }    
}
// compile result function end 



// add attendance search function start 
public function add_attendance_search()
{
    // code for personal info on side bar start
    $id= Session('loginId');
    $faculty_personal_info=faculty::where('id', '=' , $id)->get();
    // code for personal info on side bar end
    $email = faculty::find($id)->email;
    $courses= instructor::where('instructor_email','=',$email)->get();    return view('faculty dashboard.Add attendance search',compact(['faculty_personal_info','courses']));
}
// add attendance search function end

// add attendance function start 
public function add_attendance_view(Request $request)
{
    // code for personal info on side bar start
    $id= Session('loginId');
    $faculty_personal_info=faculty::where('id', '=' , $id)->get();
    // code for personal info on side bar end



$list= student_course::where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->where('course_title','=',$request->course)->get();

$filter_check=sizeof($list);
if($filter_check<1)
{
    return back()->with('fail','please apply accurate filters');
}
     return view('faculty dashboard.Add attendance',compact(['faculty_personal_info','list']));
}
// add attendance function end


// add attendance logic function start 
public function add_attendance_logic(Request $request)
{
    
     $selected_students = $request->roll_no;
     $total_students=sizeof($selected_students);
     $department = "cs";
     
    
        for($i=0; $i<$total_students; $i++)
        {
 
         attendance::insert([
             'department'=> $department,
             'programme'=> $request->programme[$i],
             'stu_name'=> $request->name[$i],
             'roll_no'=> $request->roll_no[$i],
             'semester'=> $request->semester[$i],
             'section'=> $request->section[$i],
             'session'=> $request->session[$i],
             'year'=> $request->year[$i],
             'course_title'=> $request->course,
             'date'=> $request->date,
             'status'=> $request->status[$i],
           ]);        
       }
          
       return redirect()->route('add_attendance_search')->with('success','attendance added successfully');
 
}
// add attendance logic function end


// view result search function start 
public function view_result_search()
{
 // code for personal info on side bar start
 $id= Session('loginId');
 $faculty_personal_info=faculty::where('id', '=' , $id)->get();


    $email = faculty::find($id)->email;
    $courses= instructor::where('instructor_email','=',$email)->get(); // code for personal info on side bar end
 return view('faculty dashboard.view result search',compact(['faculty_personal_info','courses']));
}
// view result search function end

// view result function start 
public function view_result(Request $request)
{
 // code for personal info on side bar start
 $id= Session('loginId');
 $faculty_personal_info=faculty::where('id', '=' , $id)->get();
 // code for personal info on side bar end

// echo $request->roll_no;
// echo $request->course;

 $results=results::where('roll_no','=',$request->roll_no)->where('course_title','=',$request->course)->get();
// echo $results;


 return view('faculty dashboard.view result',compact(['faculty_personal_info','results']));
}
// view result  function end

// view attendance search function start 
public function view_attendance_search()
{
    // code for personal info on side bar start
    $id= Session('loginId');
    $faculty_personal_info=faculty::where('id', '=' , $id)->get();
    // code for personal info on side bar end
    
    $email = faculty::find($id)->email;
    $courses= instructor::where('instructor_email','=',$email)->get();
    return view('faculty dashboard.view attendance search',compact(['faculty_personal_info','courses']));
}
// view attendance search function end

// view attendance search function start 
public function view_attendance(Request $request)
{
    // code for personal info on side bar start
    $id= Session('loginId');
    $faculty_personal_info=faculty::where('id', '=' , $id)->get();
    // code for personal info on side bar end
    
    $attendance=attendance::where('roll_no','=',$request->roll_no)->where('course_title','=',$request->course)->get();
 
    $total_classes=sizeof($attendance);

    
    if($total_classes<1)
    {
        return back()->with('fail','Please apply accurate filters');
    }

    else
    {
        $present="present";
        $absent="absent";
        $leave="leave";
    
         $attend_classes=attendance::where('roll_no','=',$request->roll_no)->where('course_title','=',$request->course)->where('status','=',$present)->count();
    
        
         $absent_classes=attendance::where('roll_no','=',$request->roll_no)->where('course_title','=',$request->course)->where('status','=',$absent)->count();
    
       
         $leave_classes=attendance::where('roll_no','=',$request->roll_no)->where('course_title','=',$request->course)->where('status','=',$leave)->count();
    
    
         $percentage= ($attend_classes/$total_classes)*100;

         return view('faculty dashboard.view attendance',compact(['faculty_personal_info','attendance','total_classes','attend_classes','absent_classes','leave_classes','percentage']));
        
    }
    

   
}
// view attendance search function end

} // controller class end

