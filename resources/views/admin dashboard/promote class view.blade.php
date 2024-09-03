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
      <h2 class="fw-bolder">Promote Class:</h2>
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
 
  <div class="row" id="assignclass"><!-- semester dates row start -->
    <div class="col-12"> <!-- semester dates col start -->
      <div class="card"> <!-- card for semester start -->

      <form action="{{route('promote')}}" method="post"> <!-- semester dates form start -->
      @csrf
        
        <label for="programme">Programme:</label>
        <select id="programme" required name="programme">
        
        <option value="BSCS">BSCS</option>
          <option value="BSSE">BSSE</option>
          <option value="BSSE">MPHIL SE</option>

        </select>
        
          
           
         

  
        <button type="submit" class="btn btn-success mt-4 fw-bolder">Compile and Promote</button>
      </form><!-- assign class form end -->
      </div><!-- card for assign class end -->
    </div> <!-- assign class col end -->
  </div>  <!-- assign class row end -->
 
<!--content section end-->
</section>


@endsection