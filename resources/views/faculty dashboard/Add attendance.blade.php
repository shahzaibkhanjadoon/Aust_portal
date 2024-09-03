@extends('faculty dashboard.faculty master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/attendance.css')}}">
  <!-- card for  Ateendance sheet  start   -->
              
  <div id="attendance" class="card mb-5">
                <span class="card-title text-start mb-2">Attendance Sheet:</span>

                 <div class="card-body">

                  <form action="{{route('add_attendance_logic')}}" method="post"> <!-- form of attendance start  -->
                  @csrf

                  


        <!-- date of attendance start  -->
        <div class=" mb-4">
        <label for="date">Date:</label>
        <input type="date" id="date" required name="date">
      </div>
        <!-- date of attendance end  -->


                 <!-- Attendance  table start  -->

               
                 <table id="attendance_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th class="text-center">Roll No</th>
                      <th class="text-center">Student Name</th>
                      <th class="text-center">Programme</th>
                      <th class="text-center">Class</th>
                      <th class="text-center">Sesction</th>
                      <th class="text-center"> Session</th>
                      <th class="text-center">Year</th>
                      <th class="text-center">Status</th>

                    </tr>
                    @foreach($list as $students)
                    <tr>
                      
                      </td>
                      <td class="text-center">{{$students->roll_no}}</td>
                      <input type="hidden" value="{{$students->roll_no}}" name="roll_no[]">
                      <td class="text-center">{{$students->student_name}}</td>
                      <input type="hidden" value="{{$students->student_name}}" name="name[]">
                      
                      <td class="text-center">{{$students->programme}}</td>
                      <input type="hidden" value="{{$students->programme}}" name="programme[]">

                      <td class="text-center">{{$students->semester}}</td>
                      <input type="hidden" value="{{$students->semester}}" name="semester[]">

                      <td class="text-center">{{$students->section}}</td>
                      <input type="hidden" value="{{$students->section}}" name="section[]">

                      <td class="text-center">{{$students->session}}</td>
                      <input type="hidden" value="{{$students->session}}" name="session[]">

                      <td class="text-center">{{$students->year}}</td>
                      <input type="hidden" value="{{$students->year}}" name="year[]">
                      <input type="hidden" value="{{$students->course_title}}" name="course">
                      <td class="text-center">
                      

                      <select class="form-select form-select-sm" name="status[]" aria-label=".form-select-sm example">
              <option selected value="present">present</option>
              <option value="absent">absent</option>
              <option value="leave">leave</option>
            </select>
                    </tr>
                   
                   @endforeach
                  </tbody>
                </table>

                <input id="submitattendance" type="submit" class="btn btn-success" value="Submit">


                  <!-- Attendance  table end  -->
                </form> <!-- form of attendance end  -->
                 </div>   <!--card body end -->
               </div>     <!--card for attendance sheet  end -->
@endsection