@extends('student dashboard.student master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('student files/css/courses.css')}}">

@if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

 <!--card for courses  start -->
 <div id="courses" class="card">
                <span class="card-title text-start mb-2">Courses:</span>

                 <div class="card-body">

                 <!-- courses table start  -->

               
                 <table id="courses_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th>Course Title</th>
                      <th class="text-center">Course Code</th>
                      <th class="text-center">Theory Credit Hours</th>
                      <th class="text-center">Lab Credit Hours</th>
                    </tr>
                    @foreach($courses as $course)
                    <tr>
                      <td>{{$course->course_title}}</td>
                      <td class="text-center"> {{$course->course_code}}</td>
                      <td class="text-center"> {{$course->theory_cr_hrs}}</td>
                      <td class="text-center"> {{$course->lab_cr_hrs}}</td>

                    </tr>
                   @endforeach
                   
                  </tbody>
                </table>


                  <!-- Information  table end  -->
            
                 </div>   <!--card body end -->
               </div>     <!--card for courses  end -->

@endsection