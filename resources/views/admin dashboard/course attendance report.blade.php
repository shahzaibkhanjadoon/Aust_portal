@extends('admin dashboard.admin master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/attendance.css')}}">


 
  <div class="row"><!-- attendance row start -->
    <div class="col-12">
     
        <!-- card for  Ateendance sheet  start   -->
          
           <div id="attendance" class="card mb-5 mt-5">

            <span class="card-title text-start mb-2">Attendance Sheet:</span>

             <div class="card-body">


             <!-- Attendance  table start  -->

           
             <table id="attendance_table" class="table table-striped table-hover">
      
              <tbody class="mt-5" >
                <tr>
                  <th class="text-center">Roll No</th>
                  <th class="text-center">Semester</th>
                  <th class="text-center">Sesction</th>
                  <th class="text-center"> Session</th>
                
                  <th class="text-center">Year</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">present</th>
                  <th class="text-center">Absent</th>
                  <th class="text-center"> Leave</th>
                  <th class="text-center">Percentage</th>

                </tr>
                @foreach($attendance as $list)
                <tr>
                  
                  <td class="text-center">{{$list->roll_no}}</td>
                  <td class="text-center">{{$list->semester}}</td>
                  <td class="text-center">{{$list->section}}</td>
                  <td class="text-center">{{$list->session}}</td>
                  <td class="text-center">{{$list->year}}</td>
                  <td class="text-center">{{$total_classes}}</td>
                  <td class="text-center">{{$attend_classes}}</td>
                  <td class="text-center">{{$absent_classes}}</td>
                  <td class="text-center">{{$leave_classes}}</td>

                  
                   

                  <td class="text-center">{{$percentage}}%</td>
                 
                  </tr>
                  @break
                
               @endforeach
              
              </tbody>
            </table>



              <!-- Attendance  table end  -->
             </div>   <!--card body end -->
           </div>     <!--card for attendance sheet  end -->
    </div> 
  </div>  <!-- attendance row end -->
 
@endsection