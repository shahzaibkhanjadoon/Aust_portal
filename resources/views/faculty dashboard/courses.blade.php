@extends('faculty dashboard.faculty master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/courses.css')}}">


<!-- card for  courses  start   -->
              
<div id="courses" class="card">
                  <span class="card-title text-start mb-2">Current Courses:</span>
  
                   <div class="card-body">
  
                   <!-- courses  table start  -->
  
                 
                   <table id="coursetable" class="table table-striped table-hover">
            
                    <tbody class="mt-5" >
                      <tr>
                        <th class="text-center" >programme</th>
                        <th class="text-center" >semester</th>
                        <th class="text-center">Course Title</th>
                        <th class="text-center" >Course Code</th>
                        <th class="text-center" >Theory Cr Hrs</th>
                        <th class="text-center" >Lab Cr Hrs</th>
                      </tr>
                      @foreach($courses as $course)
                      <tr>
                        <td class="text-center">{{$course->programme}}</td>
                        <td class="text-center">{{$course->semester}}</td>
                        <td class="text-center" >{{$course->course_title}}</td>
                        <td class="text-center">{{$course->course_code}}</td>
                        <td class="text-center">{{$course->theory_cr_hrs}}</td>
                        <td class="text-center" >{{$course->lab_cr_hrs}}</td>
                      </tr>
                      @endforeach
                     
                    </tbody>
                  </table>
  
  
                    <!-- courses  table end  -->
              
                   </div>   <!--card body end -->
                 </div>     <!--card for courses  end -->
       


@endsection