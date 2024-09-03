@extends('faculty dashboard.faculty master')
@section('dashboard')
<div class="row"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder">Search Student Result:</h2>
    </div> 
  </div>  <!-- heading row end -->
 
  <div class="row"><!-- search row start -->
      <form action="{{route('faculty_view_result')}}" method="post">
        @csrf
      <div class="col-12">
        <input type="number" class="form-control" required id="search" name="roll_no" min="1" placeholder="Search by roll_no">
        </div> <!--col 1 end -->
        <div class="col-12">
        <select class="form-select form-select-sm mt-3" required name="course" aria-label=".form-select-sm example">
        <option value="CS" selected>Course</option>
        @foreach($courses as $title)
          <option value="{{$title->course_title}}">{{$title->course_title}}</option>
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