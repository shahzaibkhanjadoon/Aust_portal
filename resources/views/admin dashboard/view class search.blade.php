@extends('admin dashboard.admin master')
@section('dashboard')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/Attendance</title>
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
@if(Session::has('fail'))
          <!-- bootstrap alert  code  -->

<div class="alert alert-danger alert-dismissible" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
<div class="row"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Search Class:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row"><!-- attendance row start -->
    <div class="col-12">
      <div id="filters" class="card"><!-- card for filters start  -->
        <span class="card-title">Search Class by using  Filters</span>
        <div class="card-body"> <!-- card body for filters start -->
       <form action="{{route('view_class')}}" method="post"> <!-- forms for filters start -->
       @csrf
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
          <option value="1" selected>CS</option>
        </select>

        <select class="form-select form-select-sm" name="programme" aria-label=".form-select-sm example">
        <option value="CS" selected>Programme</option>
          <option value="BSCS">BSCS</option>
          <option value="BSSE">BSSE</option>
          <option value="BSSE">MPHIL SE</option>

        </select>

        

        <select class="form-select form-select-sm" name="semester" aria-label=".form-select-sm example">
          <option> Semester</option>
          <option value="1st">1st</option>
          <option value="2nd">2nd</option>
          <option value="3rd">3rd</option>
          <option value="4th">4th</option>
          <option value="5th">5th</option>
          <option value="6th">6th</option>
          <option value="7th">7th</option>
          <option value="8th">8th</option>
          
        </select>

        <select class="form-select form-select-sm" name="section" aria-label=".form-select-sm example">
          <option> Section</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
        </select>

        <select class="form-select form-select-sm" name="session" aria-label=".form-select-sm example">
          <option>Session</option>
          <option value="fall">Fall</option>
          <option value="spring">spring</option>
        </select>

        <select class="form-select form-select-sm" name="year" aria-label=".form-select-sm example">
          <option> Year</option>
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

        

        <button id="search_button" type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i>Search</button>
       </form> <!-- forms for filters end -->
        </div> <!-- card body for filters end  -->
      </div> <!-- card for filters end  -->
    



        
    </div> 
  </div>  <!-- attendance row end -->
 
@endsection