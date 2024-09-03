@extends('student dashboard.student master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('student files/css/result.css')}}">
@if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

  <!-- card for  result start   -->
              
  <div id="result" class="card">
                <span class="card-title text-start mb-2">Results:</span>

                 <div class="card-body">

                 <!-- result  table start  -->

               
                 <table id="#infotable" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th class="text-center">Subject</th>
                      <th class="text-center">Assignment</th>
                      <th class="text-center">Quiz</th>
                      <th class="text-center">Paper</th>

                    </tr>
                    @foreach($courses as $course)
                    <tr>
                      <th>{{$course->course_title}}</th>
                      <td>
                        <a href="{{url('assignment result'.$course->id)}}">  <button class="btn btn-primary">Assignment</button> </a>
                     
                      </td>
                      <td>
                      <a href="{{url('quiz result'.$course->id)}}"><button class="btn btn-primary">Quiz</button></a>
                      </td>
                      <td>
                       <a href="{{url('paper result').$course->id}}"><button class="btn btn-primary">Paper</button></a>
                      </td>
                    </tr>
                   @endforeach
                   
                   
                  </tbody>
                </table>


                  <!-- result table end  -->
            
                 </div>   <!--card body end -->
               </div>     <!--card for result  end -->



@endsection
