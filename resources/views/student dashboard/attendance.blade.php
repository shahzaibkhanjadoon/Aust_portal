@extends('student dashboard.student master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('student files/css/attendance.css')}}">

@if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
<!-- card for attendance start   -->
              
<div id="attendance" class="card">
    <span class="card-title text-start mb-2">Attendance:</span>

     <div class="card-body">

     <!-- attendance table start  -->

   
     <table id="attendancetable" class="table table-striped table-hover">

      <tbody class="mt-5" >
        <tr>
          <th scope="row">Subjects</th>
          <!-- <th class="text-center" >Total Classes</td> -->
          <th class="text-center" >Presents</th>
          <th class="text-center" >Abbsents</td>
          <th class="text-center" >Leaves</td>
          <th class="text-center" >Percentage</td>
        </tr>
        
        @for($i=0; $i<$attendance_subjects; $i++)

        <tr>
          <th scope="row">{{$courses_array[$i]}}</th>
          <!-- <td class="text-center" >{{$total_classes_array[$i]}}</td> -->
          <td class="text-center" >{{$attend_classes_array[$i]}}</td>
          <td class="text-center">{{$absent_classes_array[$i]}}</td>
          <td class="text-center">{{$leave_classes_array[$i]}}</td>
          <td class="text-center">{{$percentage_array[$i]}}</td>

        </tr>
       @endfor
        
       
      </tbody>
    </table>


      <!-- attendance  table end  -->

     </div>   <!--card body end -->
   </div>     <!--card for attendace   end -->
@endsection