<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{asset('student files/images/aust logo.png')}}">

    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('student files/css/dashboard.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
    <script>

        

      // function for opening navbar in small screens 
        function openNav() {
          document.getElementById("navbar").style.width = "100%";
          document.getElementById("navbar").style.display="block";
          document.getElementById("contentarea").style.display="none";

}

      // function for closing navbar in small screens 

function closeNav() {
  document.getElementById("navbar").style.width = "0";
  document.getElementById("navbar").style.display="none";
  document.getElementById("contentarea").style.display = "block";
}




 


 
    </script>
    <!-- javascript section end  -->
</head>
<body>
<!-- top  bar  -->
<div id="header" class="container-fluid">
<div class="row">
<div id="logoname" class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
    <button id="sidebarbutton" class="btn btn-outline-light openbtn" onclick="openNav()"><i class="fa-solid fa-bars"></i></button>
    <img src= "{{asset('student files/images/aust logo.png')}}" alt="image not showing">
   <span>Student Dashboard Aust Portal</span> 
</div>

<!-- profile setting section start  -->
<div id="profilesetting" class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
  
  <!-- bootstrap code for dropdown settings start  -->
  
  <div class="dropdown show">
    <a id="profilebutton" class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <img src="{{asset('student files/images/user.png')}}">profile
    </a>
  
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a id="changepassword" class="dropdown-item" href="{{route('student.change_password_view')}}">Change password</a>
      <a id="logout" class="dropdown-item" href="{{route('student.logout')}}">Log Out</a>

    </div>
  </div>



  <!-- bootstrap code for dropdown settings end  -->
</div>
<!-- profile setting section end  -->
</div>
</div>
<!-- top  bar end -->

<!-- content section start -->
<section class="content">
<div class="container-fluid">
    <div class="row">
        <!-- nav  start -->
                <!-- 4 col grid for side bar start  -->
        <div id="navbar" class="col-0 col-sm-0 col-md-0  col-lg-4 col-xl-4"> 
                

            <!-- navbar close button  -->
            <a href="javascript:void(0)" class="closebtn" id="closebutton" onclick="closeNav()"><i class="fa-regular fa-circle-xmark"></i></a>
          
            <!-- profile section start -->
            <div id="profile">
            @foreach($student_personal_info as $personal_data)

             <!-- picture-->  <div id="profilepic"><img class="img  img-responsive img img-thumbnail" src="{{asset($personal_data->profile_pic)}}" alt="not found"></div>
              <!--text-->  <div id="profilename">
                
              

            <span id="username" class="text-bold text-strong text-start">{{$personal_data->name}}</span>
            <span id="semester" class="text-bold text-disabled">Semester {{$student_class_info->semester}}</span>
            @endforeach
            </div>
            <!-- text div end -->

            </div>
           <!-- profile section end -->

           <!-- menu buttons section start -->
           <section id="menubuttons">
           
              <a href="{{route('student_dashboard')}}" class="menubuttons btn btn-primary active" role="button">
                <img src="{{asset('student files/images/dashboard.png')}}"  alt="pic" class="img img-responisive img-thumbnail rounded">
                Dashboard
              </a> 
              <a href="{{route('enroll_courses_view')}}" class="menubuttons btn btn-primary " role="button" >

                <img src="{{asset('student files/images/instructor.png')}}"  alt="pic" class="img img-responisive img-thumbnail rounded">
 
                Register Courses</a>
              <a href="{{route('attendance')}}" type="button" class="menubuttons btn btn-primary" role="button">
                <img src="{{asset('student files/images/courses.png')}}"  class="img img-responisive img-thumbnail rounded">
                Attendance
              </a>
              <a href="{{route('courses')}}" class="menubuttons btn btn-primary " role="button" >

                <img src="{{asset('student files/images/courses.png')}}"  alt="pic" class="img img-responisive img-thumbnail rounded">
 
                Courses</a>
                
                <a href="{{route('result')}}" class="menubuttons btn btn-primary " role="button" >

                <img src="{{asset('student files/images/result.png')}}"  alt="pic" class="img img-responisive img-thumbnail rounded">
  
                Result</a>
                <a href="{{route('transcript')}}" class="menubuttons btn btn-primary" role="button">

                <img src="{{asset('student files/images/transcript.png')}}"  alt="pic" class="img img-responisive img-thumbnail rounded">
 
                Transcript</a>

           </section>
           <!-- menu button  section end -->


         </div> <!-- 4 col grid for sidebar end  -->
              <!-- navbar  section end -->
         






<!-- content bar  start  -->
         <div id="contentarea" class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
              
         @yield('dashboard')
               
         </div><!-- col 8 for  content  area  end  -->         
    </div>    <!-- row for content section end  -->
</div>        <!-- container fluid  content section end  -->
</section>   <!-- content section end-->


    
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>