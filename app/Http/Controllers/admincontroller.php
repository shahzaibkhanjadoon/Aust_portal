<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\user;
use App\Models\student;
use App\Models\student_class;
use App\Models\course;
use App\Models\faculty;
use App\Models\student_course;
use App\Models\attendance;
use App\Models\instructor;
use App\Models\results;
use App\Models\drop_students;
use App\Models\passed_students;


use Illuminate\Support\facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class admincontroller extends Controller
{
    // logout function start 
    public function admin_logout()
    {
        Auth::logout();
        return Redirect()->route('home');
    }
    // logout function end 

    // change password view page function start 
    public function change_password_view()
    {
        return view('admin dashboard.change password');
    }

    // update password function start 
    public function update_password(Request $request)

    {
        $validateData= $request->validate([
            'oldpassword' => 'required',
            'password' => 'required | confirmed' ,
        ]);

        $hashpassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashpassword))
        {
            $user = user::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('home');
        }
        else
        {
            return redirect()->back()->with('fail','old password not matched');
        }
    }

    // register student view page fuction start 
public function register_student_view()
{
    return view('admin dashboard.register student');
}

// register student view page function end 

// register student function start 
public function student_register(Request $request)
{

    // validation for registration form  
    $validatedData = $request->validate([
       
         'roll_no' => 'required|unique:students',

    
    ],
    [       
        'roll_no.required' => 'Please input student roll number',
        'roll_no.unique' => 'This roll no is already registered',
    ]
); 

    // temporary password coding 
    $requested_password= $request->roll_no;
    $password= hash::make($requested_password);
    // $tempdata=0;

    
    // insert data in student table 
    student::insert([
     
        
        'password'=>$password,
        
        'roll_no'=>$request->roll_no,
        

    ]);
    return back()->with('success','Registration Sucessfull');
}
// register student function end 

// student forgot function start
public function student_forgot(Request $request)
{

$check=student::where('roll_no','=',$request->roll_no)->get();
$check_lenght=sizeof($check);
if($check_lenght>0)
{
  $password= hash::make($request->roll_no);

  student::where('roll_no','=',$request->roll_no)->update([
     
        
    'password'=>$password,
]);
return back()->with('success','roll number is set as default password , student can change it');
}

  else
  {
    return back()->with('fail','roll number is not registered');
  }
} //student forgot ftn end

// assign class view page function start 
public function assign_class_view()
{
    return view('admin dashboard.assign class');
}
// assign class view page function end



// student forgot function start
public function faculty_forgot(Request $request)
{

$check=faculty::where('email','=',$request->email)->get();
$check_lenght=sizeof($check);
if($check_lenght>0)
{
  $password= hash::make($request->email);

  faculty::where('email','=',$request->email)->update([
     
        
    'password'=>$password,
]);
return back()->with('success','email  is set as default password , email can change it');
}

  else
  {
    return back()->with('fail','roll number is not registered');
  }
} //student forgot ftn end



// assign class logic function start
public function assign_class_insert(Request $request)
{
    $validatedData = $request->validate([
        'roll_no' => 'required|unique:student_classes',
        'name' => 'required',
        
       
    
    ],
    [
        'roll_no.required' => 'Please input student roll number',
        'roll_no.unique' => 'This roll number is already enrolled in class',
        'name.required' => 'Please input student name',
        
    ]

    
); 

// insert data in student _class table 
 $student_data=student::where('roll_no','=',$request->roll_no)->first();
if($student_data===null)
{
    return back()->with('fail','This student is not registered, Please register student before assigning class.');

}

else
{
    student_class::insert([
      
        'roll_no' => $request->roll_no,
         'student_name' =>  $request->name,
         'department' =>  $request->department,
         'programme' =>  $request->programme,
         'semester' =>  $request->semester,
         'section' =>  $request->section,
         'session' =>  $request->session,
         'year' =>  $request->year,
         'created_at'=>carbon::now()
 
 ]);
 return back()->with('success','Registration Sucessfull');

}

}
// assign class logic function end 

// semester dates logic function start 
public function semester_date(Request $request)
{
    

      DB::table('student_classes')->where('programme','=',$request->programme)->where('session','=',$request->session)->where('year','=',$request->year)->update([
          
          'start_date'=>$request->start,
          'end_date'=>$request->end,

      ]);
      return back()->with('success','Dates updated successfully');
}
// semester dates logic function end 

// search student logic start  
public function search_student(Request $request)
{
    $validatedData = $request->validate([
        'roll_no' => 'required',
    ],
    [
        'roll_no.required' => 'Please input student roll number to view details',
    ]
    );
    
    
    $student_personal_info_check=student::where('roll_no', '=' , $request->roll_no)->first();
    $student_class_info_check = student_class::where('roll_no', '=' , $request->roll_no)->first();

    if($student_personal_info_check===null)
    {
        return back()->with('fail','This student is not registered');
    }
    else if($student_class_info_check ===null)
    {
        return back()->with('fail',' you have not assigned any class yet');
    }
    else
    {
        $student_personal_info=student::where('roll_no', '=' , $request->roll_no)->get();
    $student_class_info = student_class::where('roll_no', '=' , $request->roll_no)->get();
        return view('admin dashboard.student search',compact(['student_personal_info', 'student_class_info']));

    }

}
// search student logic end 


// edit student view page function start 

public function edit_student_view()
{
    return view('admin dashboard.edit student search');
}
// edit student view page function start 

// edit student function  start 
public function edit_student(Request $request)
{
    $validatedData = $request->validate([
        'roll_no' => 'required',
    
    ],
[
    'roll_no.required' => 'please input student roll number',
    
]);

     $check_roll_no = student::where('roll_no','=', $request->roll_no)->first(); 

     if($check_roll_no===null)
     { 
        return back()->with('fail', 'This roll number is not registerd');

    } 
    else
     {
        $editable_data = student::where('roll_no','=', $request->roll_no)->get();
        return view('admin dashboard.edit student',compact('editable_data'));
     }
}
// edit student function end 

// update student function start 
public function update_student(Request $request ,$id)
{
    
   
                 $old_image= $request->old_image;
                $image= $request->file('image');
                
                
                
                if($image)
                {
                    $name_gen = hexdec(uniqid());
                    $img_extension = strtolower($image->getClientOriginalExtension());
                    $image_name= $name_gen.'.'.$img_extension;
                    $up_location='profile images/student/';
                    $last_img=$up_location.$image_name;
                    $image->move($up_location,$image_name);

                unlink($old_image);
                student::find($id)->update([
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
                    'updated_at'=>carbon::now()
                
                  ]);
             }
            else
            {
                student::find($id)->update([
    
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
        'updated_at'=>carbon::now()

                 ]);
                 
            }
               
        return Redirect()->route('edit_student_view')->with('success','Student data updated successfully');

    
}
// update student function end

// function for delete student view start

public function delete_student_view()
{
    return view('admin dashboard.delete student');
}

// function for delete student view end


// function for delete logic start
public function delete_student(Request $request)
{
    $validatedData = $request->validate([
        'roll_no' => 'required',
    
    ],
[
    'roll_no.required' => 'please input student roll number',
    
]);

$check_roll_no = student::where('roll_no','=', $request->roll_no)->first(); 

if($check_roll_no===null)
{ 
   return back()->with('fail', 'This roll number is not registerd');

} 
else
{
    $delete_student= student::where('roll_no', '=' , $request->roll_no)->first();
    $delete_student->delete();
    
    return back()->with('success','Student deleted successfully');
}
}
// function for delete logic end


// function for register faculty
public function register_faculty(Request $request)
{
   
    // validation for registration form  
    $validatedData = $request->validate([
       
        'email' => 'required|unique:faculties',

   
   ],
   [       
       'email.required' => 'Please input faculty member email',
       'email.unique' => 'This email is already registered',
   ]
); 

   // temporary password coding 
   $requested_password= $request->email;
   $password= hash::make($requested_password);

   
   // insert data in student table 
   faculty::insert([
    

       'password'=>$password,
       'email'=>$request->email,
       

   ]);
   return back()->with('success','Registration Sucessfull');
}

// function for register faculty end 



// function for editfaculty view 

public function edit_faculty(Request $request)
{
    $validatedData = $request->validate([
        'email' => 'required',
    
    ],
[
    'email.required' => 'please input email to search',
    
]);

     $check_email = faculty::where('email','=', $request->email)->first(); 

     if($check_email===null)
     { 
        return back()->with('fail', 'This roll number is not registerd');

    } 
    else
     {
        $editable_data = faculty::where('email','=', $request->email)->get();
        return view('admin dashboard.edit faculty',compact('editable_data'));
     }
}
// edit faculty function end 

// update faculty function start 
public function update_faculty(Request $request)
{
    
   
                 $image_old= $request->image_old;
                $image= $request->file('image');
                
                
                
                
           
            
                faculty::where('email','=',$request->email)->update([
    
                    'name'=> $request->name,
                    'gender'=>$request->gender,
                    'nationality'=>$request->nationality,
                    'cnic'=>$request->cnic,
                    'phone'=>$request->phone,
                    'religion'=>$request->religion,
                    'Employe_id'=>$request->employe_id,
                    'contract'=>$request->contract,
                    'designation'=>$request->designation,
                    'status'=>$request->status,
                    'updated_at'=>carbon::now()

                 ]);
                 
            
               
        return Redirect()->route('edit_faculty_view')->with('success','Student data updated successfully');



       
}
// update faculty function end

 // search faculty function start 

 public function search_faculty(Request $request)
 {
    $validatedData = $request->validate([
        'email' => 'required',
    ],
    [
        'email.required' => 'Please input faculty member email to view details',
    ]
    );
    
    
    $faculty_personal_info_check=faculty::where('email', '=' , $request->email)->first();

    if($faculty_personal_info_check===null)
    {
        return back()->with('fail','This faculty member is not registered');
    }
    else
    {
        $faculty_personal_info=faculty::where('email', '=' , $request->email)->get();
        return view('admin dashboard.search faculty',compact('faculty_personal_info'));

    }

 }
 // search faculty function end 



// function for student record search view start
public function student_record_search_view()
{
return view('admin dashboard.student record search');
}
// function for student record search view end

// function for student record  start
public function student_record(Request $request)
{
    $validatedData = $request->validate([
        'roll_no' => 'required',
    ],
    [
        'roll_no.required' => 'Please input student roll number to view details',
    ]
    );
    
    
    $student_personal_info_check=student::where('roll_no', '=' , $request->roll_no)->first();
    $student_class_info_check = student_class::where('roll_no', '=' , $request->roll_no)->first();

    if($student_personal_info_check===null)
    {
        return back()->with('fail','This student is not registered');
    }
    // else if($student_class_info_check ===null)
    // {
    //     return back()->with('fail',' you have not assigned any class yet');
    // }
    else
    {
        $student_personal_info=student::where('roll_no', '=' , $request->roll_no)->get();
        $student_class_info = student_class::where('roll_no', '=' , $request->roll_no)->get();
        return view('admin dashboard.student record',compact(['student_personal_info', 'student_class_info']));

    }


}
// function for student record  end

// student_result_report function start

public function student_result_report(Request $request)
{
    $results=results::where('roll_no','=',$request->roll_no)->where('course_title','=',$request->course)->get();
    $check=sizeof($results);
    if($check<1)
    {
        return back()->with('fail','Please apply valid filters');
    }
    else
    {
        return view('admin dashboard.student result',compact('results'));
    }
}
// student_result_report function end

// student_courses_report function start 
public function student_courses_report(Request $request)
{
    $courses=student_course::where('roll_no','=',$request->roll_no)->get();
    $check=sizeof($courses);
    if($check<1)
    {
        return back()->with('fail','This Student not registered his\her courses yet, or this roll number is not accurate');
    }
    else
    {
        return view('admin dashboard.student courses report',compact('courses'));
    }
}
// student_courses_report function end 

// individual drop students details function start 
public function droped_students(Request $request)
{

  $drop_students=drop_students::where('roll_no','=',$request->roll_no)->first();

if(!$drop_students)
{
  return back()->with('fail','This student is not in drop students');
}
else
{
  return view('admin dashboard.drop student report',compact('drop_students'));
}
}
// individual drop students details function end 



// class droped students  function start 
public function class_droped_students(Request $request)
{
  
  $drop_students=drop_students::where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->get();

if(!$drop_students)
{
  return back()->with('fail','Please apply accurate filters');
}
else
{
   return view('admin dashboard.class droped students',compact('drop_students'));
}
}
// class droped students  function end 

// individual passed students details function start 
public function passed_students(Request $request)
{

  $passed_students=passed_students::where('roll_no','=',$request->roll_no)->first();

if(!$passed_students)
{
  return back()->with('fail','This student is not in passed students');
}
else
{
  return view('admin dashboard.passed out student',compact('passed_students'));
}
}
  
// individual passed students details function end 

// class passed students  function start 
public function class_passed_students(Request $request)
{

  $passed_students=passed_students::where('programme','=',$request->programme)->where('session','=',$request->session)->where('year','=',$request->year)->get();

  if(!$passed_students)
  {
    return back()->with('fail','Please apply accurate filters');
  }
  else
  {
    return view('admin dashboard.class passed out students',compact('passed_students'));
  }
}
// class passed students  function end 



// course attendance report search function start 
public function attendance_search()
{
    $courses=course::get();
    return view('admin dashboard.admin attendance search',compact('courses'));
}
// course attendance report search function end

// course attendance report view function start 
public function course_attendance_report(Request $request)
{

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
        
         return view('admin dashboard.course attendance report',compact(['attendance','total_classes','attend_classes','absent_classes','leave_classes','percentage']));
    }
   

    
   
}
// course attendance report view function end

// admin view class function start 
public function view_class(Request $request)
{
    $class_details=student_class::where('programme','=',$request->programme)->where('semester','=',$request->semester)->where('section','=',$request->section)->where('session','=',$request->session)->where('year','=',$request->year)->get();

    $check=sizeof($class_details);
    if($check<1)
    {
        return back()->with('fail','No record found against these filters, Please try another');
    }
    else
    {
        return view('admin dashboard.view class',compact('class_details'));
    }
}
// admin view class   function end


//  admin register course logic function start
     public function register_course(Request $request)
     {
        $validatedData = $request->validate([
       
            'dep' => 'required',
            'programme' => 'required',
            'semester' => 'required',
            'course_code' => 'required',
            'course_title' => 'required',
            'theory_cr_hrs' => 'required',
            'lab_cr_hrs' => 'required',
            
       
       ],
       [       
        'dep.required' => 'please select department',
        'programme.required' => 'please select programme',
        'semester.required' => 'please select semester',
        'course_code.required' => 'please insert course code',
        'course_title.required' => 'Please insert course title',
        'theory_cr_hrs.required' => 'Please insert theory credit hours',
        'lab_cr_hrs.required' => 'Please insert lab credit hours',
       
       ]
   ); 
   
     
       
       // insert data in student table 
       course::insert([
        
           
        'department' => $request->dep,
        'programme' => $request->programme,
        'semester' =>  $request->semester,
        'course_code' => $request->course_code,
        'course_title' =>  $request->course_title,
        'theory_cr_hrs' =>  $request->theory_cr_hrs,
        'lab_cr_hrs' =>  $request->lab_cr_hrs,
        'prerequsite_title' =>  $request->pre_title,
        'prerequsite_code' =>  $request->pre_code,

       ]);
       return back()->with('success','Registration Sucessfull');
     }
//  admin register course logic function end


// edit_course_view function start 
 public function edit_course_view(Request $request)
 {
    $validatedData = $request->validate([
       
        'code' => 'required',
        
   
   ],
   [       
    'code.required' => 'please enter course code',
   
   
   ]);
   $course_data=course::where('course_code','=',$request->code)->first();
   if($course_data===null)
   {
            return back()->with('fail','please enter valid course code');
   }
   else
   {
    return view('admin dashboard.edit course',compact('course_data'));
   }


 }
// edit_course_view function end 


// edit_course function start 
 public function edit_course(Request $request)
 {
    $validatedData = $request->validate([
       
        'dep' => 'required',
            'programme' => 'required',
            'semester' => 'required',
            'course_code' => 'required',
            'course_title' => 'required',
            'theory_cr_hrs' => 'required',
            'lab_cr_hrs' => 'required',
        
   
   ],
   [       
    'dep.required' => 'please select department',
        'programme.required' => 'please select programme',
        'semester.required' => 'please select semester',
        'course_code.required' => 'please insert course code',
        'course_title.required' => 'Please insert course title',
        'theory_cr_hrs.required' => 'Please insert theory credit hours',
        'lab_cr_hrs.required' => 'Please insert lab credit hours',
   
   
   ]);

   $code=$request->search_code;
    DB::table('courses')
    ->where('course_code', $code)
    ->update([
    'department' => $request->dep,
    'programme' => $request->programme,
    'semester' =>  $request->semester,
    'course_code' => $request->course_code,
    'course_title' =>  $request->course_title,
    'theory_cr_hrs' =>  $request->theory_cr_hrs,
    'lab_cr_hrs' =>  $request->lab_cr_hrs,
    'prerequsite_title' =>  $request->pre_title,
    'prerequsite_code' =>  $request->pre_code,
   ]);
   
         
   return redirect()->route('edit_course_search')->with('success', 'Update Successfully');
  

   
 }
// edit_course function end 


// course allotment view start 
public function course_allotment_view()
{
   $courses= course::get();
   return view('admin dashboard.course allotment',compact('courses'));
}
// course course_allotment_view function end


// course allotment logic function start 
public function course_allotment(Request $request)
{

    
   $courses= course::where('programme','=',$request->programme)->where('course_title','=',$request->course_title)->first();
    
   if($courses==null)
   {
     return back()->with('fail','Please select course');
   }
   else
   {
    $lab_cr_hrs=$courses->lab_cr_hrs;
    $theory_cr_hrs=$courses->theory_cr_hrs;
    $course_code=$courses->course_code;
    $requested_total_cr_hrs = $lab_cr_hrs+$theory_cr_hrs;
   }
  


   $instructor = faculty::where('email','=',$request->email)->first();

   if($instructor==null)
   {
     return back()->with('fail','This instructor is not registered');
   }
   else
   {
    $designation = $instructor->designation;
    $name=$instructor->name;


    $lecturer = "Lecturer";
   $assistant ="Assistant Professor";
   $assosiate="Assosiate Professor";
   $professor=" Professor";
  
  
   $check_if_already_enrolled= instructor::where('instructor_email','=',$request->email)->first();
   if($check_if_already_enrolled==null)
   {
    if($designation==$lecturer)
    {
            if($requested_total_cr_hrs>12)
            {
              return back()->with('fail','Lecturer can only pick 12 credit hours');
            }
 
            else
            {
               instructor::insert([
                      'course_title'=>$request->course_title,
                      'course_code'=>$course_code,
                      'programme'=>$request->programme,
                      'semester'=>$request->semester,
                      'section'=>$request->section,
                      'session'=>$request->session,
                      'year'=>$request->year,
                      'theory_cr_hrs'=>$theory_cr_hrs,
                      'lab_cr_hrs'=>$lab_cr_hrs,
                      'designation'=>$designation,
                      'instructor_name'=>$name,
                      'instructor_email'=>$request->email,
                    ]);
                         return back()->with('success','Course Allotement Successfull');
            }
     }
     
     else if($designation==$assistant)
     {
         if($requested_total_cr_hrs>9)
         {
           return back()->with('fail','Assistant Professor can only pick 9 credit hours');
         }
 
         else
         {
            instructor::insert([
                   'course_title'=>$request->course_title,
                   'course_code'=>$course_code,
                   'programme'=>$request->programme,
                   'semester'=>$request->semester,
                   'section'=>$request->section,
                   'session'=>$request->session,
                   'year'=>$request->year,
                   'theory_cr_hrs'=>$theory_cr_hrs,
                   'lab_cr_hrs'=>$lab_cr_hrs,
                   'designation'=>$designation,
                   'instructor_name'=>$name,
                   'instructor_email'=>$request->email,
                 ]);
                      return back()->with('success','Course Allotement Successfull');
         }
 
     }
 
     else if($designation==$assosiate)
     {
         if($requested_total_cr_hrs>6)
         {
           return back()->with('fail','Assosiate professor can only pick 6 credit hours');
         }
 
         else
         {
            instructor::insert([
                   'course_title'=>$request->course_title,
                   'course_code'=>$course_code,
                   'programme'=>$request->programme,
                   'semester'=>$request->semester,
                   'section'=>$request->section,
                   'session'=>$request->session,
                   'year'=>$request->year,
                   'theory_cr_hrs'=>$theory_cr_hrs,
                   'lab_cr_hrs'=>$lab_cr_hrs,
                   'designation'=>$designation,
                   'instructor_name'=>$name,
                   'instructor_email'=>$request->email,
                 ]);
                      return back()->with('success','Course Allotement Successfull');
         }
 
     }
 
     else
     {
         if($requested_total_cr_hrs>3)
         {
           return back()->with('fail','Professor can only pick 3 credit hours');
         }
 
         else
         {
            instructor::insert([
                   'course_title'=>$request->course_title,
                   'course_code'=>$course_code,
                   'programme'=>$request->programme,
                   'semester'=>$request->semester,
                   'section'=>$request->section,
                   'session'=>$request->session,
                   'year'=>$request->year,
                   'theory_cr_hrs'=>$theory_cr_hrs,
                   'lab_cr_hrs'=>$lab_cr_hrs,
                   'designation'=>$designation,
                   'instructor_name'=>$name,
                   'instructor_email'=>$request->email,
                 ]);
                      return back()->with('success','Course Allotement Successfull');
         }
 
     }
   }
   else
   {

    $check_credit_hrs= instructor::where('instructor_email','=',$request->email)->get();
    $total_courses = instructor::where('instructor_email','=',$request->email)->count();
    for($i=0; $i<$total_courses; $i++)
    {
      $theory[$i] = $check_credit_hrs[$i]->theory_cr_hrs;
      $lab[$i]=$check_credit_hrs[$i]->lab_cr_hrs;
    
    }
    $theory_total=(array_sum($theory));
    $lab_total=(array_sum($lab));
    $before_cr_hrs = $theory_total+$lab_total;
    
    $total_cr_hrs= $before_cr_hrs+$requested_total_cr_hrs;
    if($designation==$lecturer)
    {
            if($total_cr_hrs>12)
            {
              return back()->with('fail','Lecturer can only pick 12 credit hours');
            }
 
            else
            {
               instructor::insert([
                      'course_title'=>$request->course_title,
                      'course_code'=>$course_code,
                      'programme'=>$request->programme,
                      'semester'=>$request->semester,
                      'section'=>$request->section,
                      'session'=>$request->session,
                      'year'=>$request->year,
                      'theory_cr_hrs'=>$theory_cr_hrs,
                      'lab_cr_hrs'=>$lab_cr_hrs,
                      'designation'=>$designation,
                      'instructor_name'=>$name,
                      'instructor_email'=>$request->email,
                    ]);
                         return back()->with('success','Course Allotement Successfull');
            }
     }
     
     else if($designation==$assistant)
     {
         if($total_cr_hrs>9)
         {
           return back()->with('fail','Assistant Professor can only pick 9 credit hours');
         }
 
         else
         {
            instructor::insert([
                   'course_title'=>$request->course_title,
                   'course_code'=>$course_code,
                   'programme'=>$request->programme,
                   'semester'=>$request->semester,
                   'section'=>$request->section,
                   'session'=>$request->session,
                   'year'=>$request->year,
                   'theory_cr_hrs'=>$theory_cr_hrs,
                   'lab_cr_hrs'=>$lab_cr_hrs,
                   'designation'=>$designation,
                   'instructor_name'=>$name,
                   'instructor_email'=>$request->email,
                 ]);
                      return back()->with('success','Course Allotement Successfull');
         }
 
     }
 
     else if($designation==$assosiate)
     {
         if($total_cr_hrs>6)
         {
           return back()->with('fail','Assosiate professor can only pick 6 credit hours');
         }
 
         else
         {
            instructor::insert([
                   'course_title'=>$request->course_title,
                   'course_code'=>$course_code,
                   'programme'=>$request->programme,
                   'semester'=>$request->semester,
                   'section'=>$request->section,
                   'session'=>$request->session,
                   'year'=>$request->year,
                   'theory_cr_hrs'=>$theory_cr_hrs,
                   'lab_cr_hrs'=>$lab_cr_hrs,
                   'designation'=>$designation,
                   'instructor_name'=>$name,
                   'instructor_email'=>$request->email,
                 ]);
                      return back()->with('success','Course Allotement Successfull');
         }
 
     }
 
     else
     {
         if($total_cr_hrs>3)
         {
           return back()->with('fail','Professor can only pick 3 credit hours');
         }
 
         else
         {
            instructor::insert([
                   'course_title'=>$request->course_title,
                   'course_code'=>$course_code,
                   'programme'=>$request->programme,
                   'semester'=>$request->semester,
                   'section'=>$request->section,
                   'session'=>$request->session,
                   'year'=>$request->year,
                   'theory_cr_hrs'=>$theory_cr_hrs,
                   'lab_cr_hrs'=>$lab_cr_hrs,
                   'designation'=>$designation,
                   'instructor_name'=>$name,
                   'instructor_email'=>$request->email,
                 ]);
                      return back()->with('success','Course Allotement Successfull');
         }
 
     }
    
   }
  
  } // else of if instructor null 
   
}
// course allotment logic function end

   // controller class end




   // student transcript view function start

   public function transcript(Request $request)
   {


    $stu_roll=$request->roll_no;

    $student_check=student::where('roll_no','=',$stu_roll)->first();
if(!$student_check)
{
  return back()->with('fail','This student is not registered');
}

      // for info on transcript top 
      $student_class_info=student_class::where('roll_no', '=' , $stu_roll)->first();



      $sem1_subjects = results::where('roll_no','=',$stu_roll)->where('semester','1st')->get();
     
      $sem1_lenght_check=sizeof($sem1_subjects);

      // for semester 1 

      if(!$student_class_info)
      {
        return back()->with('fail','Class not assigned yet');
      }

      if($sem1_lenght_check>0)
      {

        $sem1_cr_hrs=array();
        $sem1_points=array();
        $sem1_gp=array();
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
        
        return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
      }




// for  semester 3 

      

$sem3_subjects = results::where('roll_no','=',$stu_roll)->where('semester','3rd')->get();
$sem3_lenght_check=sizeof($sem3_subjects);

if($sem3_lenght_check>0)
{


    $sem3_cr_hrs=array();
$sem3_points=array();
$sem3_gp=array();
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

$all_gp=$sem1_total_gp+$sem2_total_gp+$sem3_total_gp;
$all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs+$sem3_total_cr_hrs;

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
 
 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
}



// for  semester 4 

      

$sem4_subjects = results::where('roll_no','=',$stu_roll)->where('semester','4th')->get();
$sem4_lenght_check=sizeof($sem4_subjects);

if($sem4_lenght_check>0)
{


    $sem4_cr_hrs=array();
$sem4_points=array();
$sem4_gp=array();
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

$all_gp=$sem1_total_gp+$sem2_total_gp+$sem3_total_gp+$sem4_total_gp;
$all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs+$sem3_total_cr_hrs+$sem4_total_cr_hrs;
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
 
 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
}






// for  semester 5

      

$sem5_subjects = results::where('roll_no','=',$stu_roll)->where('semester','5th')->get();
$sem5_lenght_check=sizeof($sem5_subjects);

if($sem5_lenght_check>0)
{


    $sem5_cr_hrs=array();
$sem5_points=array();
$sem5_gp=array();
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

$all_gp=$sem1_total_gp+$sem2_total_gp+$sem3_total_gp+$sem4_total_gp+$sem5_total_gp;
$all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs+$sem3_total_cr_hrs+$sem4_total_cr_hrs+$sem5_total_cr_hrs;

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
 
 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
}




// for  semester 6 

      

$sem6_subjects = results::where('roll_no','=',$stu_roll)->where('semester','6th')->get();
$sem6_lenght_check=sizeof($sem6_subjects);

if($sem6_lenght_check>0)
{


    $sem6_cr_hrs=array();
$sem6_points=array();
$sem6_gp=array();
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

$all_gp=$sem1_total_gp+$sem2_total_gp+$sem3_total_gp+$sem4_total_gp+$sem5_total_gp+$sem6_total_gp;
$all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs+$sem3_total_cr_hrs+$sem4_total_cr_hrs+$sem5_total_cr_hrs+$sem6_total_cr_hrs;

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
 
 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
}

  

// for  semester 7 

      

$sem7_subjects = results::where('roll_no','=',$stu_roll)->where('semester','7th')->get();
$sem7_lenght_check=sizeof($sem7_subjects);

if($sem7_lenght_check>0)
{


    $sem7_cr_hrs=array();
$sem7_points=array();
$sem7_gp=array();
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

$all_gp=$sem1_total_gp+$sem2_total_gp+$sem3_total_gp+$sem4_total_gp+$sem5_total_gp+$sem6_total_gp+$sem7_total_gp;
$all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs+$sem3_total_cr_hrs+$sem4_total_cr_hrs+$sem5_total_cr_hrs+$sem6_total_cr_hrs+$sem7_total_cr_hrs;

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
 
 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
}



// for  semester 8

      

$sem8_subjects = results::where('roll_no','=',$stu_roll)->where('semester','8th')->get();
$sem8_lenght_check=sizeof($sem8_subjects);

if($sem8_lenght_check>0)
{


    $sem8_cr_hrs=array();
$sem8_points=array();
$sem8_gp=array();
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

$all_gp=$sem1_total_gp+$sem2_total_gp+$sem3_total_gp+$sem4_total_gp+$sem5_total_gp+$sem6_total_gp+$sem7_total_gp+$sem8_total_gp;
$all_cr_hrs=$sem1_total_cr_hrs+$sem2_total_cr_hrs+$sem3_total_cr_hrs+$sem4_total_cr_hrs+$sem5_total_cr_hrs+$sem6_total_cr_hrs+$sem7_total_cr_hrs+$sem8_total_cr_hrs;

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
 
 return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
}
       

return view('student dashboard.transcript',compact(['student_class_info','sem1_course_titles','sem1_course_codes', 'sem1_obtained_marks','sem1_cr_hrs','sem1_points','sem1_gp','sem1_gpa','sem1_lenght_check','sem1_total_cr_hrs','sem2_course_titles','sem2_course_codes', 'sem2_obtained_marks','sem2_cr_hrs','sem2_points','sem2_gp','sem2_gpa','sem2_total_cr_hrs','sem2_lenght_check','sem3_course_titles','sem3_course_codes', 'sem3_obtained_marks','sem3_cr_hrs','sem3_points','sem3_gp','sem3_gpa','sem3_total_cr_hrs','sem3_lenght_check','sem4_course_titles','sem4_course_codes', 'sem4_obtained_marks','sem4_cr_hrs','sem4_points','sem4_gp','sem4_gpa','sem4_total_cr_hrs','sem4_lenght_check','sem5_course_titles','sem5_course_codes', 'sem5_obtained_marks','sem5_cr_hrs','sem5_points','sem5_gp','sem5_gpa','sem5_total_cr_hrs','sem5_lenght_check','sem6_course_titles','sem6_course_codes', 'sem6_obtained_marks','sem6_cr_hrs','sem6_points','sem6_gp','sem6_gpa','sem6_total_cr_hrs','sem6_lenght_check','sem7_course_titles','sem7_course_codes', 'sem7_obtained_marks','sem7_cr_hrs','sem7_points','sem7_gp','sem7_gpa','sem7_total_cr_hrs','sem7_lenght_check','sem8_course_titles','sem8_course_codes', 'sem8_obtained_marks','sem8_cr_hrs','sem8_points','sem8_gp','sem8_gpa','sem8_total_cr_hrs','sem8_lenght_check','cgpa']));
   }

   // student transcript view function end



   
}     // controller class end



