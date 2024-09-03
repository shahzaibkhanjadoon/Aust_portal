@extends('faculty dashboard.faculty master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/result.css')}}">

<!-- card for  assignment result  start   -->
              
<div id="result" class="card mb-5">
                <span class="card-title text-start mb-2">Mid result:</span>

                 <div class="card-body">

                  <form action="{{route('add_result_logic')}}" method="post"> <!-- form of assignment result start  -->

                   @csrf

                   <input type="hidden" value="{{$mid}}" name="type">
                  

                  <!-- total marks start  -->


                  <div class="input mb-4">
                    <label for="total_marks">Total Marks:</label>
                    <input type="number" required name="tot_marks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Enter Total Marks" id="total_marks">
                  </div>


                  <!-- total marks end  -->

        <!-- date of assignment start  -->
        <div class=" mb-4">
        <label for="date">Date:</label>
        <input type="date" required id="date" name="date">
      </div>
        <!-- date of assignment end  -->


                 <!-- assignment resutlt table start  -->

               
                 <table id="result_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th class="text-center">Programme</th>
                      <th class="text-center">Roll No</th>
                      <th class="text-center">Student Name</th>
                      <th class="text-center">Class</th>
                      <th class="text-center">Sesction</th>
                      <th class="text-center"> Session</th>
                      <th class="text-center">Year</th>
                      <th class="text-center">Obt. Marks</th>

                    </tr>
                    @foreach($courses_data as $course)
                    <tr>
                      
                      <th class="text-center">{{$course->programme}}</th>
                      <input type="hidden" value="{{$course->programme}}" name="programme[]">
                      <td class="text-center">{{$course->roll_no}}</td>
                      <input type="hidden" value="{{$course->roll_no}}" name="roll_no[]">
                      <td class="text-center">{{$course->stu_name}}</td>
                      <input type="hidden" value="{{$course->stu_name}}" name="name[]">
                      <td class="text-center">{{$course->semester}}</td>
                      <input type="hidden" value="{{$course->semester}}" name="semester[]">
                      <td class="text-center">{{$course->section}}</td>
                      <input type="hidden" value="{{$course->section}}" name="section[]">
                      <td class="text-center">{{$course->session}}</td>
                      <input type="hidden" value="{{$course->session}}" name="session[]">
                      <td class="text-center">{{$course->year}}</td>
                      <input type="hidden" value="{{$course->year}}" name="year[]">
                      <td class="text-center">
                        

                <input type="number" step=".01" required name="obt_marks[]" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks">



                      </td>
</tr>
<input type="hidden" name="course" value="{{$course->course_title}}">
@endforeach
                   
                  </tbody>
                </table>

                <input id="submitattendance" type="submit" class="btn btn-success" value="Submit">


                  <!-- Assignment result table end  -->
                </form> <!-- form of assignment result end  -->
                 </div>   <!--card body end -->
               </div>     <!--card for assignment result  end -->

@endsection()