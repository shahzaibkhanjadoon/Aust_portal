@extends('student dashboard.student master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('student files/css/paper.css')}}">
@if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
<!-- card for  paper start   -->
              
<div id="paper" class="card">
  <span class="card-title text-start mb-2">Social Computing paper:</span>

   <div class="card-body">

   <!-- paper table start  -->

 
   <table id="papertable" class="table table-striped table-hover">

    <tbody class="mt-5" >
      @foreach($results as $result)
      <tr>
        <th >paper.</th>
        <th class="text-center" >Total Marks</th>
        <th class="text-center" >Obtained Marks</th>
      </tr>
      <tr>
        <th class="text-center" scope="row">Mid term</th>
        <td class="text-center" >{{$result->mid_paper_tot_marks}}</td>
        <td class="text-center" >{{$result->mid_paper_obt_marks}}</td>
      </tr>
      <tr>
        <th class="text-center"  scope="row">Terminal</th>
        <td class="text-center" >{{$result->final_paper_tot_marks}}</td>
        <td class="text-center" >{{$result->final_paper_obt_marks}}</td>
      </tr>
      @endforeach
     
    </tbody>
  </table>


    <!-- paper  table end  -->

   </div>   <!--card body end -->
 </div>     <!--card for paper result  end -->
    @endsection         
