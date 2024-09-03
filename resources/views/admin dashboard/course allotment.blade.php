@extends('admin dashboard.admin master')
@section('dashboard')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/assign Class</title>
    <link rel="icon" type="image/x-icon" href="images/aust logo.png">

    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
    <script>
    </script>
    <!-- javascript section end  -->
</head>

<!-- content section start -->
<section id="contentarea"> 
  <div class="row mb-5"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Allot Course to Instructors:</h2>
      @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

          @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-danger alert-dismissible" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row" id="assignclass"><!-- assign class row start -->
    <div class="col-12"> <!-- assign class col start -->
      <div class="card"> <!-- card for assign class start -->

      <form action="{{route('course_allotment')}}" method="post"> <!-- assign class form start -->
      @csrf

      <label for="course_title">Course Title:</label>
        <select id="course_title" name="course_title" searchable="Search here..">
        

  <option value="BSCS">course</option>
          @foreach($courses as $course)
          <option value="{{$course->course_title}}">{{$course->course_title}}</option>
          @endforeach
        </select>

        
      

        <label for="programme">Programme:</label>
        <select id="programme" name="programme">
        
  <option value="BSCS">BSCS</option>
          <option value="BSSE">BSSE</option>
          <option value="BSSE">MPHIL SE</option>

        </select>
        <label for="Semester">Semester:</label>
        <select id="semester" name="semester">
       
          <option value="1st">1st</option>
          <option value="2nd">2nd</option>
          <option value="3rd">3rd</option>
          <option value="4th">4th</option>
          <option value="5th">5th</option>
          <option value="6th">6th</option>
          <option value="7th">7th</option>
          <option value="8th">8th</option>
          </select>
          <label for="section">Section:</label>
          <select id="section" name="section">
         
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            </select>
            <label for="session">Session:</label>
            <select id="session" name="session">
           
              <option value="spring">Spring</option>
              <option value="fall">Fall</option>
              </select>
              <label for="year">year:</label>
        <select id="year" name="year">
        
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
          <option value="2031">2031</option>

          </select>

          
        <label for="roll_no">Instructor Email:</label>
        <input type="email" id="roll_no" required name="email" placeholder="Enter Instructor email.">
       
       
         
        <button type="submit" class="btn btn-success mt-4 fw-bolder">Allot Course</button>
      </form><!-- assign class form end -->
      </div><!-- card for assign class end -->
    </div> <!-- assign class col end -->
  </div>  <!-- assign class row end -->
 
<!--content section end-->
</section>


@endsection