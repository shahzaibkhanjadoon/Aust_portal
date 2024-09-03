<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{asset('admin files/images/aust logo.png')}}">

    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('admin files/css/dashboard.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
    <script>
 
    </script>
    <!-- javascript section end  -->
</head>
<body>
<!-- top  bar  -->
<div id="header" class="container-fluid">
<div class="row">
<div id="logoname" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">




      <!-- code and  button  for  left offcanvas start  -->



      
      <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="fa-solid fa-bars"></i>
      </button>
      
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
          <!-- offcanvas header start  -->
        <div class="offcanvas-header"> 
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          <!-- offcanvas header end  -->
        </div> 
        <div class="offcanvas-body">
           <!-- profile section start -->
           <!-- <div id="profile"> -->
               
            <!-- picture-->  
            <!-- <div id="profilepic"><img class="img  img-responsive img img-thumbnail" src="{{asset('admin files/images/dp.jpeg')}}" alt="not found"></div> -->
             <!--text-->  
             <!-- <div id="profilename"> -->
           <!-- <span id="username" class="text-dark">Shahzaib Khan</span> -->
           <!-- </div> -->
           <!-- text div end -->

           <!-- </div> -->
          <!-- profile section end -->
          

 <!-- menu buttons section start -->
 <div id="navbar">
     <a href="{{route('dashboard')}}">
   <button class="buttons" type="button"><i class="fa-solid fa-address-card"></i>Dashboard</button>
</a>

         
          <h4 class="text-strong text-dark mt-5 mb-2">Student Management:</h4>
          <div class="card card-body text-dark rounded"> 
         <a href="{{route('student_register_view')}}">
          <button class="subbuttons"><i class="fa-solid fa-up-right-from-square"></i>Register Student</button>
        </a>
        <a href="{{route('edit_student_view')}}">
          <button class="subbuttons"><i class="fa-solid fa-pen-to-square"></i>Edit student</button>
        </a>
        <a href="{{route('dashboard')}}">
          <button class="subbuttons"><i class="fa-solid fa-magnifying-glass-plus"></i>Search Student</button>
        </a>

        <a href="{{route('student_forgot_view')}}">
        <button class="subbuttons form-label"><i class="fa-solid fa-up-right-from-square"></i></i>Forgot Password</button>
    </a>
        </div>


        <h4 class="text-dark mt-5 mb-2">Faculty Management:</h4>
      <div class="card card-body text-dark">
        <a href="{{route('register_faculty_view')}}">
        <button class="subbuttons"><i class="fa-solid fa-up-right-from-square"></i>Register Faculty</button>
    </a>
    <a href="{{route('edit_faculty_view')}}">
        <button class="subbuttons"><i class="fa-solid fa-pen-to-square"></i>Edit Faculty</button>
    </a>
    <a href="{{route('dashboard')}}">
        <button class="subbuttons form-label"><i class="fa-solid fa-magnifying-glass-plus"></i>Search Faculty</button>
    </a>
    <a href="{{route('faculty_forgot_view')}}">
        <button class="subbuttons form-label"><i class="fa-solid fa-up-right-from-square"></i>Forgot Password</button>
    </a>
      </div>


      <h4 class="text-dark mt-5 mb-2">Class Management:</h4>
    
      <div class="card card-body text-dark">
        <a href="{{route('admin_view_class_search')}}">
          <button class="subbuttons"><i class="fa-solid fa-eye"></i>View Class</button>
          </a>
          <a href="{{route('assign_class_view')}}">
        <button class="subbuttons"><i class="fa-solid fa-up-right-from-square"></i>Assign Class</button>
        </a>

        <a href="{{route('semester_dates')}}">
        <button class="subbuttons"><i class="fa-solid fa-up-right-from-square"></i>Semester Dates</button>
        </a>
        <a href="{{route('promote_class_view')}}">
        <button class="subbuttons"><i class="fa-solid fa-pen-to-square"></i>Promote Classes</button>
        </a>
       
        
      </div>



    <h4 class="text-dark mt-5 mb-2">Course Management:</h4>
    
      <div class="card card-body text-dark">
          <a href="{{route('register_course_view')}}">
        <button class="subbuttons"><i class="fa-solid fa-up-right-from-square"></i>Register Course</button>
        </a>

        <a href="{{route('edit_course_search')}}">
        <button class="subbuttons"><i class="fa-solid fa-pen-to-square"></i>Edit Course</button>
        </a>

        
        <a href="{{route('course_allotment_view')}}">
        <button class="subbuttons"><i class="fa-solid fa-pen-to-square"></i>Course Allotment</button>
        </a>
        

      </div>

      <h4 class="text-dark mt-5 mb-2">Report Management:</h4>
    
      <div class="card card-body text-dark">
      <a href="{{route('student_record_search')}}">
          <button class="subbuttons"><i class="fa-solid fa-magnifying-glass-plus"></i>Student Record</button>
        </a>

        <a href="{{route('course_attendance_report_search')}}">
        <button class="subbuttons"><i class="fa-solid fa-user-check"></i>Course Attendance Report</button>
        </a>
        <a href="{{route('student_result_search_view')}}">
        <button class=" subbuttons"><i class="fa-solid fa-square-poll-horizontal"></i>Student Result Report</button>
        </a>

        <a href="{{route('transcript_search')}}">
        <button class="subbuttons"><i class="fa-solid fa-square-poll-vertical"></i>Student Transcript Report</button>
        </a>

        <a href="{{route('student_courses_search')}}">
        <button class="subbuttons"><i class="fa-solid fa-book"></i>Student Courses Report</button>
        </a>
        <a href="{{route('drop_student_search')}}">
        <button class=" subbuttons"><i class="fa-solid fa-trash"></i>Drop Students Report</button>
        </a>

        <a href="{{route('passed_out_students_search')}}">
        <button class="subbuttons"><i class="fa-solid fa-up-right-from-square"></i>Passed Out Student Report</button>
        </a>

      </div>



 <!-- menu button  section end --> 
 </div>


          <!-- offcanvas body end  -->
        </div> 
      </div>      
      


      <!-- code and  button for left offcanvas end  -->




    <img src= "{{asset('admin files/images/aust logo.png')}}" alt="image not showing">
   <span>Admin Dashboard Aust Portal</span> 
</div>

<!-- profile setting section start  -->
<div id="profilesetting" class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
  
  <!-- bootstrap code for dropdown settings start  -->
  

  <div class="dropdown show">
    <a id="profilebutton" class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <img src="{{asset('admin files/images/user.png')}}">profile
    </a>
  
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a id="changepassword" class="dropdown-item" href="{{route('admin.change_password_view')}}">Change password</a>
      <a id="logout" class="dropdown-item" href="{{route('admin.logout')}}">Log Out</a>

    </div>
  </div>



  <!-- bootstrap code for dropdown settings end  -->
</div>
<!-- profile setting section end  -->
</div>
</div>
<!-- top  bar end -->

<!-- content section start -->
<section id="contentarea">
  

@yield('dashboard')
  
</section>
<!--content section end-->
    
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>