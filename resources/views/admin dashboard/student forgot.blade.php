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
      <h2 class="fw-bolder">Forgot Password:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row"><!-- search row start -->
    <div class="col-12">
      <form action="{{route('student_forgot')}}" method="post">
          @csrf
        <input type="number" class="form-control" id="search" name="roll_no" min="1" required placeholder="Search by roll_no">
        <button type="submit" class="btn btn-primary mt-2">Save</button>
      </form>
    </div> 
  </div>  <!-- search row end -->
  

  @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-danger alert-dismissible mt-4" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

          @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-info alert-dismissible mt-4" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
@endsection