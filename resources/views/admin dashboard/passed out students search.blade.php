@extends('admin dashboard.admin master')
@section('dashboard')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/Student Record</title>
    
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
<div class="row mb-4"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Search Passed Out Student Report:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row"><!-- search row start -->
    <div class="col-12">
      <form action="{{route('passed_student')}}" method="post">
          @csrf
        <input type="number" class="form-control" id="search" name="roll_no" required min="1" placeholder="Search by roll_no">
        <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-magnifying-glass-plus text-dark"></i>&nbsp;Search Record</button>
      </form>
    </div> 
  </div>  <!-- search row end -->
  @error('roll_no')
  <span class="text-danger mt-2">{{ $message }}</span>
  @enderror

  @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-info alert-dismissible mt-4" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif


          <div class="row"><!-- attendance row start -->
    <div class="col-12">
      <div id="filters" class="card"><!-- card for filters start  -->
        <span class="card-title">Search passed out students from class by using  Filters</span>
        <div class="card-body"> <!-- card body for filters start -->
       <form action="{{route('class_passed_students')}}" method="post"> <!-- forms for filters start -->
       @csrf
       

        <select class="form-select form-select-sm" name="programme" aria-label=".form-select-sm example">
        <option value="CS" selected>Programme</option>
        <option value="BSCS">BSCS</option>
          <option value="BSSE">BSSE</option>
          <option value="BSSE">MPHIL SE</option>

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

      @if(Session::has('filter_fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-info alert-dismissible mt-4" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
          <hr>

@endsection