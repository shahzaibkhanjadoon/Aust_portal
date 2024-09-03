@extends('admin dashboard.admin master')
@section('dashboard')
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/Register student</title>
    <link rel="icon" type="image/x-icon" href="images/aust logo.png">
    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         
<!-- external css -->

 <link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

 <!-- font awesome link  -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
     <script>
    </script> 
    <!-- javascript section end  -->
</head> 
<body>


<!-- content section start -->
  <div class="row"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Register New  Student:</h2>
      @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
    </div> 
  </div>  <!-- heading row end -->
 
  <!-- registeration form start -->
  <form action="{{route('student_registration')}}" method="post" enctype="multipart/form-data"> 
      @csrf 

  <div id="regform" class="row"> <!-- row 1 for registration form start -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <!-- col for registration form start -->
      <div class="card"> <!-- card for personal info form start -->
       <h2 class="fw-bolder card-title text-center bg-primary">Enter student roll number to register </h2>
       <div class="card-body"><!-- card body for personal info form start -->
        
            <input type="number" class="form-control" id="roll_no" name="roll_no" placeholder="Enter Student roll no">
            @error('roll_no')
  <span class="text-danger fw-bolder">{{ $message }}</span>
  @enderror
            <div class="card-footer text-end"><button type="submit" class="btn btn-success">Save</button>
      
          </div>
           

            
</form>
            
       </div> <!-- card body for personal info form end-->
      </div> <!-- card for personal info form end -->
    </div> <!-- col 1 for registration form end -->



    
</section>
<!--content section end-->
    
   
@endsection