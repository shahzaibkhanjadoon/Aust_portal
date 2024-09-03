@extends('admin dashboard.admin master')
@section('dashboard')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/Assign Course</title>
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
<div class="row mb-5"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Edit Course:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row" id="assignclass"><!-- assign class row start -->
    <div class="col-12"> <!-- assign class col start -->
      <div class="card"> <!-- card for assign class start -->

     
      
      <form action="{{route('edit_course')}}" method="post"> <!-- assign class form start -->
        @csrf
        <input type="hidden" name="search_code" value="{{$course_data->course_code}}" >
        <label for="dep">Department:</label>
        <select id="dep" name="dep">
        <option selected>CS</option>
        </select>
        <label for="programe">Programme:</label>
        <select id="programe" name="programme">
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
        <label for="code">Course Code:</label>
        <input type="number" id="code" name="course_code" value="{{$course_data->course_code}}" placeholder="Enter Course Code">
        <label for="title">Course Title:</label>
        <input type="text" id="title" name="course_title" value="{{$course_data->course_title}}" placeholder="Enter Course Title">
        <label for="title">prerequsite Title:</label>
        <input type="text" id="title" name="pre_title" value="{{$course_data->prerequsite_title}}" placeholder="Enter prerequsite Course Title">

        <label for="title">Prerequsite Code:</label>
        <input type="text" id="title" name="pre_code" value="{{$course_data->prerequsite_code}}" placeholder="Enter prerequsite Course code">
        <label for="theory">Theory Cr_Hrs:</label>
        <input type="number" id="theory" name="theory_cr_hrs" value="{{$course_data->theory_cr_hrs}}" placeholder="Enter Theory Credit hours">
        <label for="lab">Lab Credit hours</label>
        <input type="number" id="lab" name="lab_cr_hrs" value="{{$course_data->lab_cr_hrs}}" placeholder="Enter Lab Credit hours">
        <button type="submit" class="btn btn-success mt-4 fw-bolder">Save</button>
      </form><!-- assign class form end -->
      </div><!-- card for assign class end -->
    </div> <!-- assign class col end -->
  </div>  <!-- assign class row end -->
@endsection