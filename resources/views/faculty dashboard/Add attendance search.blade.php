@extends('faculty dashboard.faculty master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/result.css')}}
">
@if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

          @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-danger alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

         
<div id="filters" class="card"><!-- card for filters start  -->
            <span class="card-title">Apply  filters to add attendance</span>
            <div class="card-body"> <!-- card body for filters start -->
           <form action="{{route('add_attendance')}}" method="post"> <!-- forms for filters start -->
           @csrf
           
            <select class="form-select form-select-sm" name="programme" aria-label=".form-select-sm example">
              <option value="1" selected>programme</option>
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

            <select class="form-select form-select-sm" name="course" aria-label=".form-select-sm example">
              <option selected>Course</option>
              @foreach($courses as $course)
              <option value="{{$course->course_title}}">{{$course->course_title}}</option>
              @endforeach

            </select>

            
            <button id="search_button" type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i>Search</button>
           
          </form> <!-- forms for filters end -->
            </div> <!-- card body for filters end  -->
          </div> <!-- card for filters end  -->
@endsection()