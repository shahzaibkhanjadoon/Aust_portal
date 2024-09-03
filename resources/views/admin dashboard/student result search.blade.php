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


<div class="row"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Search Student Result:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row"><!-- search row start -->
      <form action="{{route('student_result_report')}}" method="post">
        @csrf
      <div class="col-6">
        <input type="number" class="form-control" id="search" name="roll_no" min="1" placeholder="Search by roll_no">
        </div> <!--col 1 end -->
        <div class="col-6">
        <select class="form-select form-select-sm mt-3" name="course" aria-label=".form-select-sm example">
        <option value="CS" selected>Course</option>
        @foreach($courses as $course)
          <option value="{{$course->course_title}}">{{$course->course_title}}</option>
         @endforeach 
        </select>
        <button type="submit" class="btn btn-primary mt-2" style="width: 100px;">Search</button>
</div> <!--col 2 end -->
      </form>
      @error('roll_no')
  <span class="text-danger mt-2">{{ $message }}</span>
  @enderror
     
  </div>  <!-- search row end -->
  <br>
  <br>
  @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->

<div class="alert alert-danger alert-dismissible" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
@endsection