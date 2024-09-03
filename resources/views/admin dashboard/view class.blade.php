@extends('admin dashboard.admin master')
@section('dashboard')

<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

 <!-- card 1 for class details  start   -->
          
 <div id="class" class="card mb-5 mt-5">
            <span class="card-title text-center bg-primary mb-2">CS 8th , Section A , spring 2022</span>

             <div class="card-body">

             <!-- Attendance  table start  -->

           
             <table id="attendance_table" class="table table-striped table-hover">
              <tbody class="mt-5" >
                <thead><span class=" fw-bolder">Students List</span></thead>
@foreach($class_details as $class)
                <tr>
                  <th class="text-center">{{$class->roll_no}}</th>
                  <th class="text-center">{{$class->student_name}}</th>
                </tr>
               
@endforeach
              </tbody>

            </table>



              <!-- class details  table end  -->
             </div>   <!--card body end -->
           </div>     <!--card 1 for class details  end -->

           <!-- card 2 for class details  start   -->
          
           
@endsection