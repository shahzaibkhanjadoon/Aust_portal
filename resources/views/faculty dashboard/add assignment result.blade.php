@extends('faculty dashboard.faculty master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/result.css')}}">

<!-- card for  assignment result  start   -->
              
<div id="result" class="card mb-5">
                <span class="card-title text-start mb-2">Assignment result:</span>

                 <div class="card-body">

                  <form action="{{route('add_result_logic')}}" method="post" > <!-- form of assignment result start  -->

                     @csrf

                     <input type="hidden" value="{{$assignment}}" name="type">
                    <!-- assignment no start  -->

                    <label for="ass_no">Assignment No:</label>
                    <select class="form-select form-select-sm mb-4" name="no" aria-label=".form-select-sm example" id="ass_no">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>   
                    @error('no')
  <span class="text-danger">{{ $message }}</span>
  @enderror
                  <!-- assignment no end  -->

                  <!-- total marks start  -->


                  <div class="input mb-4">
                    <label for="total_marks">Total Marks:</label>
                    <input type="number" required name="tot_marks" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Enter Total Marks" id="total_marks">
                  </div>
              


                  <!-- total marks end  -->

        <!-- date of assignment start  -->
        <div class=" mb-4">
        <label for="date">Date:</label>
        <input type="date" id="date" required name="date">
      </div>
     
        <!-- date of assignment end  -->


                 <!-- assignment resutlt table start  -->

               
                 <table id="result_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th class="text-center">Programme</th>
                      <th class="text-center">Roll No</th>
                      <th class="text-center">Student Name</th>
                      <th class="text-center">Semester</th>
                      <th class="text-center">Sesction</th>
                      <th class="text-center"> Session</th>
                      <th class="text-center">Year</th>
                      <th class="text-center">Obt. Marks</th>

                    </tr>
                    @foreach($courses_data as $course)
                    <tr>
                     
                      <td class="text-center">{{$course->programme}}</td>
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
                      <input type="hidden" value="{{$course->course_title}}" name="course[]">
                      <td class="text-center">
                        
                <input type="number" required name="obt_marks[]" step=".01" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks">


                      </td>
                    </tr>
                    @endforeach

                  
                   
                  </tbody>
                </table>

                <input id="submitattendance" type="submit" class="btn btn-success" value="Submit">


                  <!-- Assignment result table end  -->
                </form> <!-- form of assignment result end  -->
                 </div>   <!--card body end -->
               </div>     <!--card for assignment result  end -->

@endsection()