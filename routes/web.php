<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\studentcontroller;
use App\Http\controllers\facultycontroller;
use App\Http\controllers\admincontroller;
use App\Http\controllers\promoteclass;
use App\Models\student;
use App\Models\course;
use App\Models\faculty;
use App\Models\student_class;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// home route 
Route::get('/', function () {
    return view('index');
})->name('home');

 // admin authentication 
 Route::middleware(['auth:sanctum,web','verified'])->get('/dashboard', function () {

    $CS="BSCS";
    $SE="BSSE";
    
    $total_students= student::count();
    $total_courses=course::count();
    $total_faculty=faculty::where('status','=','Active')->count();

    $cs1_total= student_class::where('programme','=',$CS)->where('semester','=','1st')->count();
    $cs2_total= student_class::where('programme','=',$CS)->where('semester','=','2nd')->count();
    $cs3_total= student_class::where('programme','=',$CS)->where('semester','=','3rd')->count();
    $cs4_total= student_class::where('programme','=',$CS)->where('semester','=','4th')->count();
    $cs5_total= student_class::where('programme','=',$CS)->where('semester','=','5th')->count();
    $cs6_total= student_class::where('programme','=',$CS)->where('semester','=','6th')->count();
    $cs7_total= student_class::where('programme','=',$CS)->where('semester','=','7th')->count();
    $cs8_total= student_class::where('programme','=',$CS)->where('semester','=','8th')->count();

    $se1_total= student_class::where('programme','=',$SE)->where('semester','=','1st')->count();
    $se2_total= student_class::where('programme','=',$SE)->where('semester','=','2nd')->count();
    $se3_total= student_class::where('programme','=',$SE)->where('semester','=','3rd')->count();
    $se4_total= student_class::where('programme','=',$SE)->where('semester','=','4th')->count();
    $se5_total= student_class::where('programme','=',$SE)->where('semester','=','5th')->count();
    $se6_total= student_class::where('programme','=',$SE)->where('semester','=','6th')->count();
    $se7_total= student_class::where('programme','=',$SE)->where('semester','=','7th')->count();
    $se8_total= student_class::where('programme','=',$SE)->where('semester','=','8th')->count();

    $MPHIL_SE1_total= student_class::where('programme','=','MPHIL SE')->where('semester','=','1st')->count();
    $MPHIL_SE2_total= student_class::where('programme','=','MPHIL SE')->where('semester','=','2nd')->count();
    $MPHIL_SE3_total= student_class::where('programme','=','MPHIL SE')->where('semester','=','3rd')->count();
    $MPHIL_SE4_total= student_class::where('programme','=','MPHIL SE')->where('semester','=','4th')->count();

    return view('admin dashboard.dashboard',compact(['total_students','total_courses','total_faculty','cs1_total','cs2_total','cs3_total','cs4_total','cs5_total','cs6_total','cs7_total','cs8_total','se1_total','se2_total','se3_total','se4_total','se5_total','se6_total','se7_total','se8_total','MPHIL_SE1_total','MPHIL_SE2_total','MPHIL_SE3_total','MPHIL_SE4_total']));
})->name('dashboard');

// student login view 
Route::get('student login',[studentcontroller::class,'student_login_view'])->name('student_login_view');
// student login logic
Route::post('student dashboard',[studentcontroller::class,'student_login'])->name('student_login');

// route group for faculty auth default
// Route::group(['prefix'=>'faculty','middleware'=>['faculty:faculty']],function(){
//     Route::get('/login', [facultycontroller::class , 'loginform']);
//     Route::post('/login',[facultycontroller::class , 'store'])->name('faculty.login');
//     });

//     // faculty authentication default
//  Route::middleware(['auth:sanctum,faculty', 'verified'])->get('/faculty/dashboard', function () { 
//         return view('faculty dashboard.dashboard');
//     })->name('dashboard');


// faculty login view 
Route::get('faculty login',[facultycontroller::class,'faculty_login_view'])->name('faculty_login_view');

// student login logic
Route::post('faculty dashboard',[facultycontroller::class,'faculty_login'])->name('faculty_login');


// route for faculty dashboard button 
Route::get('faculty dashboard', [facultycontroller::class,'dashboard'])->name('faculty_dashboard');

// route for faculty dashboard button 
Route::post('complete faculty profile', [facultycontroller::class,'complete_profile'])->name('complete_faculty_profile');


// route for student logout 
 Route::get('/student logout', [studentcontroller::class , 'logout'])->name('student.logout');

// route for faculty logout 
Route::get('/faculty logout', [facultycontroller::class , 'logout'])->name('faculty.logout');

//route for admin logout
Route::get('/admin logout',[admincontroller::class , 'admin_logout'])->name('admin.logout');

// Route for student change password view page 
Route::get('/student change password',[studentcontroller::class , 'change_password_view'])->name('student.change_password_view');

// Route for student update password 

Route::post('/student update password',[studentcontroller::class , 'update_password'])->name('student.update_password');

// Route for faculty change password view page 
Route::get('/faculty change password',[facultycontroller::class , 'change_password_view'])->name('faculty.change_password_view');

// Route for faculty update password 

Route::post('/faculty update password',[facultycontroller::class , 'update_password'])->name('faculty.update_password');

// Route for admin change password view page 
Route::get('/admin change password',[admincontroller::class , 'change_password_view'])->name('admin.change_password_view');

// Route for admin update password 

Route::post('/admin update password',[admincontroller::class , 'update_password'])->name('admin.update_password');

// student registration page route 
Route::get('student registration page',[admincontroller::class,'register_student_view'])->name('student_register_view');

// route for student registration logic 
Route::post('register student',[admincontroller::class,'student_register'])->name('student_registration');


// route for student forgot password view
Route::get('student_forgot',function()
    {
        return view('admin dashboard.student forgot');
    }
)->name('student_forgot_view');


// route for faculty forgot password logic
Route::post('student_forgot',[admincontroller::class,'faculty_forgot'])->name('student_forgot');

// route for student forgot password view
Route::get('faculty_forgot',function()
    {
        return view('admin dashboard.faculty forgot');
    }
)->name('faculty_forgot_view');


// route for student forgot password logic
Route::post('faculty_forgot',[admincontroller::class,'faculty_forgot'])->name('faculty_forgot');



// Route for assign class view page in admin dashboard 
Route::get('assign class page',[admincontroller::class,'assign_class_view'])->name('assign_class_view');

// Route for semester dates view page in admin dashboard 
Route::get('dates',function()
{
  return view('admin dashboard.semester dates');
})->name('semester_dates');

//Route for semester date logic 
Route::post('semester dates',[admincontroller::class,'semester_date'])->name('semester_date');

// Route for assign class insert logic in admin dashboard 
Route::post('assign class',[admincontroller::class,'assign_class_insert'])->name('assign_class_insert');

// Route for search student logic 
Route::post('search student',[admincontroller::class,'search_student'])->name('search_student');

// Route for student dashboard button 
Route::get('student dashboard', [studentcontroller::class,'dashboard'])->name('student_dashboard');

// Route for Admin edit student search page view 

Route::get('edit student' ,[admincontroller::class,'edit_student_view'])->name('edit_student_view');

// Route for Admin edit student form page view 

Route::post('edit/student',[admincontroller::class , 'edit_student'])->name('edit_student');

// Route for Admin edit student update logic

Route::post('updatestudent{id}' , [admincontroller::class , 'update_student'])->name('update_student');

// Route for Admin delete student form page view 
Route::get('delete student' , [admincontroller::class , 'delete_student_view'])->name('delete_view');

// Route for Admin delete student logic
Route::post('delete student',[admincontroller::class,'delete_student'])->name('delete_student');

// Route for Admin  student record search page view 
Route::get('student record' , [admincontroller::class , 'student_record_search_view'])->name('student_record_search');


// Route for Admin  student record 
Route::post('student record' , [admincontroller::class , 'student_record'])->name('student_record');

// Route for back from student record 
Route::get('student/record',function()
{
  return view('admin dashboard.student record search');
})->name('back_from_student_record');



// Route for admin view class search page
Route::get('admin view class',function()
{
    $courses=course::get();
  return view('admin dashboard.view class search',compact('courses'));
})->name('admin_view_class_search');

// Route for Admin  view class
Route::post('view class' , [admincontroller::class , 'view_class'])->name('view_class');

// Route for admin drop student view page
Route::get('drop student view',function()
{
  return view('admin dashboard.drop student');
})->name('drop_student_view');

// Route for admin register course view page
Route::get('register course view',function()
{
  return view('admin dashboard.register course');
})->name('register_course_view');
// Route for admin register course function
Route::post('register course',[admincontroller::class,'register_course'])->name('register_course');
// Route for admin edit course search view page
Route::get('edit course search',function()
{
  return view('admin dashboard.edit course search');
})->name('edit_course_search');

// Route for Admin edit course view 
Route::post('edit course view' , [admincontroller::class , 'edit_course_view'])->name('edit_course_view');

// Route for Admin edit course 
Route::post('edit course' , [admincontroller::class , 'edit_course'])->name('edit_course');

// Route for Admin  course allottment view
Route::get('course allotment view',[admincontroller::class,'course_allotment_view'])->name('course_allotment_view');


// Route for Admin  course allotment
Route::post('course allotment' , [admincontroller::class , 'course_allotment'])->name('course_allotment');

// route for register faculty 
Route::get('register faculty', function()
    {
        return view('admin dashboard.register faculty');
    }
)->name('register_faculty_view');


// Route for register faculty
Route::post('register/faculty' , [admincontroller::class , 'register_faculty'])->name('register_faculty');


// route for edit faculty view
Route::get('edit faculty view', function()
    {
        return view('admin dashboard.edit faculty search');
    }
)->name('edit_faculty_view');
// route for edit faculty  
Route::post('edit faculty', [admincontroller::class , 'edit_faculty'])->name('edit_faculty');

// Route for update faculty
Route::post('update faculty' , [admincontroller::class , 'update_faculty'])->name('update_faculty');


// Route for update faculty
Route::post('search faculty' , [admincontroller::class , 'search_faculty'])->name('search_faculty');

// route for register course view page 
Route::get('assign course', function()
    {
        return view('admin dashboard.register course');
    }
)->name('register_course_view');

// route for attendance report search view page 
Route::get('course attendance search',[admincontroller::class,'attendance_search'])->name('course_attendance_report_search');

// route for attendance report view page 
Route::post('course attendance report',[admincontroller::class,'course_attendance_report'])->name('course_attendance_report');

// route for student result report search view  page 
Route::get('student result search', function()
    {
        $courses=course::get();
        return view('admin dashboard.student result search',compact('courses'));
    }
)->name('student_result_search_view');

// route for student resutl report 
Route::post('student result report', [admincontroller::class,'student_result_report'])->name('student_result_report');


// route for student courses report search view  page 
Route::get('student courses search', function()
    {
        return view('admin dashboard.student courses search');
    }
)->name('student_courses_search');

// route for student courses report 
Route::post('student courses',[admincontroller::class,'student_courses_report'])->name('student_courses_report');

// route for drop student search 
Route::get('drop student search', function()
    {
        return view('admin dashboard.drop student search');
    }
)->name('drop_student_search');

// route for individual droped students reports 
Route::post('droped students',[admincontroller::class,'droped_students'])->name('droped_student');

// route for class droped students record 
Route::post('class droped students',[admincontroller::class,'class_droped_students'])->name('class_droped_students');

// route for passed students search 

Route::get('passed student search', function()
    {
        return view('admin dashboard.passed out students search');
    }
)->name('passed_out_students_search');

// route for individual passed students reports 
Route::post('passed students',[admincontroller::class,'passed_students'])->name('passed_student');

// route for class admin passed students record 
Route::post('class passed students',[admincontroller::class,'class_passed_students'])->name('class_passed_students');

// route for student transcript view  
Route::get('transcript', [studentcontroller::class , 'transcript'])->name('transcript');

// route for admin transcript search 
Route::get('search transcript', function()
    {
        return view('admin dashboard.student transcript search');
    }
)->name('transcript_search');

// route for admin  transcript view  
Route::post('transcript', [admincontroller::class , 'transcript'])->name('admin_transcript');

// route for promote class view function 
Route::get('promote class', function()
    {
        return view('admin dashboard.promote class view');
    }
)->name('promote_class_view');

// route for promote class logic  
Route::post('promote', [promoteclass::class , 'promote'])->name('promote');


// route for faculty view result search view  page 
Route::get('faculty result view', [facultycontroller::class,'view_result_search']
)->name('view_result_search');

// route for faculty view result
Route::post('facult view result',[facultycontroller::class,'view_result'])->name('faculty_view_result');


// route for faculty courses  page 
Route::get('faculty courses',[facultycontroller::class, 'courses']
)->name('faculty_courses');

// route for faculty add result search  page view 
Route::get('faculty result',[facultycontroller::class,'add_result_search']
)->name('Add_result_search');

// route for faculty add result  
Route::post('add result',[facultycontroller::class,'add_result'])->name('add_result');



// route for faculty add result logic  
Route::post('add result logic',[facultycontroller::class,'add_result_logic'])->name('add_result_logic');

// // route for faculty modify result search  page view 
// Route::get('modify result search',[facultycontroller::class,'modify_result_search'])->name('modify_result_search');

// // route for faculty modify result  
// Route::post('modify result',[facultycontroller::class,'modify_result'])->name('modify_result');



// route for faculty compile result search  page view 
Route::get('compile result',[facultycontroller::class,'compile_result_search']
)->name('compile_result_search');

// route for faculty compile result  
Route::post('compile result',[facultycontroller::class,'compile_result'])->name('compile_result');

// route for faculty add attendance search  page view 
Route::get('add attendance search',[facultycontroller::class,'add_attendance_search'])->name('add_attendance_search');

// route for faculty add attendance  
Route::post('attendance',[facultycontroller::class,'add_attendance_view'])->name('add_attendance');

// route for faculty add attendance logic  
Route::post('add attendance',[facultycontroller::class,'add_attendance_logic'])->name('add_attendance_logic');


// route for faculty view attendance search  page view 
Route::get('view attendance search',[facultycontroller::class,'view_attendance_search'])->name('view_attendance_search');

// route for faculty view attendance  
Route::post('view attendance',[facultycontroller::class,'view_attendance'])->name('view_attendance');

// route for student view attendance  
Route::get('attendance',[studentcontroller::class,'attendance'])->name('attendance');

// route for student view courses  
Route::get('courses',[studentcontroller::class,'courses'])->name('courses');

// route for student  result view 
Route::get('result', [studentcontroller::class , 'result'])->name('result');

// route for student assignment result view 
Route::get('assignment result{id}', [studentcontroller::class , 'assignment_result'])->name('assignment_result');

// route for student quiz result view 
Route::get('quiz result{id}', [studentcontroller::class , 'quiz_result'])->name('quiz_result');

// route for student paper result view  
Route::get('paper result{id}', [studentcontroller::class , 'paper_result'])->name('paper_result');


// route for student transcript view  
Route::get('transcript', [studentcontroller::class , 'transcript'])->name('transcript');


// route for student enroll courses  view  
Route::get('enroll courses view', [studentcontroller::class , 'enroll_courses_view'])->name('enroll_courses_view');

// route for student enroll courses  logic 
Route::post('enroll courses', [studentcontroller::class , 'enroll_courses'])->name('enroll_courses');

 // Route for student complete profile 
 Route::post('complete profile',[studentcontroller::class,'complete_profile'])->name('complete_profile');





