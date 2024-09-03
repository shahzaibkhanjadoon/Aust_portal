@extends('admin dashboard.admin master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

  <!-- card for  Ateendance sheet  start   -->
          
  <div id="attendance" class="card mb-5 mt-5">
            <span class="card-title text-start mb-2">Fall 2018 Passed Out Students List:</span>

             <div class="card-body">



              


    


             <!-- Attendance  table start  -->

           
             <table id="attendance_table" class="table table-striped table-hover">
      
              <tbody class="mt-5" >
                <tr style="background-color:green; ">
                  <th class="text-center">Programme</th>     
                  <th class="text-center">Roll No</th>
                  <th class="text-center">Student Name</th>
                  <th class="text-center">Section</th>
                  <th class="text-center"> Session</th>
                  <th class="text-center">Year</th>

                </tr>
                @foreach($passed_students as $passed)
                <tr style="background-color:green; ">
                <td class="text-center">{{$passed->programme}}</td>
                  <td class="text-center">{{$passed->roll_no}}</td>
                  <td class="text-center">{{$passed->name}}</td>
                  <td class="text-center">{{$passed->programme}}</td>
                  <td class="text-center">{{$passed->session}}</td>
                  <td class="text-center">{{$passed->year}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>



              <!-- Attendance  table end  -->
             </div>   <!--card body end -->
           </div>     <!--card for attendance sheet  end -->
@endsection