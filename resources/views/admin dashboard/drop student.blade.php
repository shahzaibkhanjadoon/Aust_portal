@extends('admin dashboard.admin master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

<div class="col-12">
      <h2 class="fw-bolder">Drop Student:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row"><!-- search row start -->
    <div class="col-12">
      <form action="#">
        <input type="number" class="form-control" id="search" placeholder="Search by roll_no">
        <button type="submit" class="btn btn-danger mt-2"><i class="fa-solid fa-trash"></i>&nbsp;Drop student</button>
      </form>
    </div> 
  </div>  <!-- search row end -->

@endsection