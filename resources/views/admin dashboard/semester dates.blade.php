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
      <h2 class="fw-bolder">Semester Dates:</h2>
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

      <form action="{{route('semester_date')}}" method="post"> <!-- semester dates form start -->
      @csrf
        
        <label for="programme">Programme:</label>
        <select id="programme" required name="programme">
        
  <option value="BSCS">BSCS</option>
          <option value="BSSE">BSSE</option>
          <option value="BSSE">MPHIL SE</option>

        </select>
        
          
            <label for="session">Session:</label>
            <select id="session" required name="session">
            
              <option value="spring">Spring</option>
              <option value="fall">Fall</option>
              </select>
              <label for="year">year:</label>
        <select id="year" required name="year">
        
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
         

  <label for="dob" class="form-label mt-3">Start Date</label>
          <input type="date" class="form-control" id="dob" required name="start">

          <label for="dob" class="form-label mt-3">End Date</label>
          <input type="date" class="form-control" id="dob" required name="end">
        <button type="submit" class="btn btn-success mt-4 fw-bolder">Save</button>
      </form><!-- assign class form end -->
      </div><!-- card for assign class end -->
    </div> <!-- assign class col end -->
  </div>  <!-- assign class row end -->
 
<!--content section end-->
</section>


@endsection