@extends('student dashboard.student master')
@section('dashboard')

@if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
<link rel="stylesheet" href="{{asset('student files/css/quiz.css')}}">
<div id="quiz" class="card">
  <span class="card-title text-start mb-2">Social Computing Quizes:</span>

   <div class="card-body">

   <!-- assignment table start  -->

 
   <table id="#infotable" class="table table-striped table-hover">

    <tbody class="mt-5" >
      <tr>
        <th >Quiz no.</th>
        <th class="text-center" >Total Marks</th>
        <th class="text-center" >Obtained Marks</th>
        
        @foreach($results as $result)
      <tr>
        <th class="text-center" scope="row">1</th>
        <td class="text-center" >{{$result->quiz_1_tot_marks}}</td>
        <td class="text-center" >{{$result->quiz_1_obt_marks}}</td>
      </tr>
      <tr>
        <th class="text-center" scope="row">2</th>
        <td class="text-center" >{{$result->quiz_2_tot_marks}}</td>
        <td class="text-center" >{{$result->quiz_2_obt_marks}}</td>
      </tr>
      <tr>
        <th class="text-center" scope="row">3</th>
        <td class="text-center" >{{$result->quiz_3_tot_marks}}</td>
        <td class="text-center" >{{$result->quiz_3_obt_marks}}</td>
      </tr>
      <tr>
        <th class="text-center" scope="row">4</th>
        <td class="text-center" >{{$result->quiz_4_tot_marks}}</td>
        <td class="text-center" >{{$result->quiz_4_obt_marks}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>


    <!-- assignment  table end  -->

   </div>   <!--card body end -->
 </div>     <!--card for assignment result  end -->

@endsection