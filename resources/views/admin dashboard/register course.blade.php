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
      <h2 class="fw-bolder">Register Course:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row" id="assignclass"><!-- assign class row start -->
    <div class="col-12"> <!-- assign class col start -->
      <div class="card"> <!-- card for assign class start -->

      @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

      <form action="{{route('register_course')}}" method="post"> <!-- assign class form start -->
        @csrf
        <label for="dep">Department:</label>
        <select id="dep" name="dep">
        <option selected value="CS">CS</option>
        </select>
        @error('dep')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="programe">Programme:</label>
        <select id="programe" name="programme">

        <option value="BSCS">BSCS</option>
          <option value="BSSE">BSSE</option>
          <option value="BSSE">MPHIL SE</option>

        </select>
        @error('programme')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="Semester" >Semester:</label>
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
          @error('semester')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="code">Course Code:</label>
        <input type="number" id="code" name="course_code" placeholder="Enter Course Code">
        @error('course_code')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="title">Course Title:</label>
        <input type="text" id="title" name="course_title" placeholder="Enter Course Title">
        @error('course_title')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="title">prerequsite Title:</label>
        <input type="text" id="title" name="pre_title" placeholder="Enter prerequsite Title">
        @error('pre_title')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="title">Prerequsite Code:</label>
        <input type="text" id="title" name="pre_code" placeholder="Enter prerequsite code">
        @error('pre_code')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="theory">Theory Cr_Hrs:</label>
        <input type="number" id="theory" name="theory_cr_hrs" placeholder="Enter Theory Credit hours">
        @error('theory_cr_hrs')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <label for="lab">Lab Credit hours</label>
        <input type="number" id="lab" name="lab_cr_hrs" placeholder="Enter Lab Credit hours">
        @error('lab_cr_hrs')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
        <button type="submit" class="btn btn-success mt-4 fw-bolder">Register Course</button>
      </form><!-- assign class form end -->
      </div><!-- card for assign class end -->
    </div> <!-- assign class col end -->
  </div>  <!-- assign class row end -->
@endsection