@extends('faculty dashboard.faculty master')
@section('dashboard')

<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

<!-- card for  assignment  start   -->
              
<div id="studentresult" class="card">
  <span class="card-title text-start mb-2"> Assignments:</span>

   <div class="card-body">

   <!-- assignment table start  -->

 
   <table id="#infotable" class="table table-striped table-hover">

    <tbody class="mt-5" >
      <tr>
        <th >Assignment no.</th>
        <th class="text-center" >Total Marks</th>
        <th class="text-center" >Obtained Marks</th>
      </tr>
      @foreach($results as $result)
      <tr>
        <th class="text-center" scope="row">1</th>
        
        <td class="text-center" >{{$result->assignment_1_tot_marks}}</td>

        <td class="text-center" >{{$result->assignment_1_obt_marks}}</td>
        

      </tr>
      <tr>
        <th class="text-center" scope="row">2</th>
        <td class="text-center" >{{$result->assignment_2_tot_marks}}</td>
        <td class="text-center" >{{$result->assignment_2_obt_marks}}</td>
      </tr>
      <tr>
        <th class="text-center" scope="row">3</th>
        <td class="text-center" >{{$result->assignment_3_tot_marks}}</td>
        <td class="text-center" >{{$result->assignment_3_obt_marks}}</td>
      </tr>
      <tr>
        <th class="text-center" scope="row">4</th>
        <td class="text-center" >{{$result->assignment_4_tot_marks}}</td>
        <td class="text-center" >{{$result->assignment_4_obt_marks}}</td>
      </tr>   
      @endforeach
    </tbody>
  </table>


    <!-- assignment  table end  -->

    

   </div>   <!--card body end -->
 </div>     <!--card for assignment result  end -->


 <!-- card for  quiz  start   -->
              
<div id="studentresult" class="card">
  <span class="card-title text-start mb-2"> Quizes:</span>

   <div class="card-body">

   <!-- quiz table start  -->

 
   <table id="#infotable" class="table table-striped table-hover">

    <tbody class="mt-5" >
      
      <tr>
        <th >Quiz no.</th>
        <th class="text-center" >Total Marks</th>
        <th class="text-center" >Obtained Marks</th>
      </tr>
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


    <!-- quiz  table end  -->

    

   </div>   <!--card body end -->
 </div>     <!--card for quiz result  end -->


 <!-- paper result start   -->
              
<div id="studentresult" class="card">
  <span class="card-title text-start mb-2"> paper:</span>

   <div class="card-body">

   <!-- paper result table start  -->

 
   <table id="#infotable" class="table table-striped table-hover">

    <tbody class="mt-5" >
      <tr>
        <th > Paper.</th>
        <th class="text-center" >Total Marks</th>
        <th class="text-center" >Obtained Marks</th>
      </tr>
      @foreach($results as $result)
      <tr>
        <th class="text-center" scope="row">Mid</th>
        
        <td class="text-center" >{{$result->mid_paper_tot_marks}}</td>

        <td class="text-center" >{{$result->mid_paper_obt_marks}}</td>
        

      </tr>
      <tr>
        <th class="text-center" scope="row">Terminal</th>
        <td class="text-center" >{{$result->final_paper_tot_marks}}</td>
        <td class="text-center" >{{$result->final_paper_obt_marks}}</td>
      </tr>
      @endforeach
      
      
     
    </tbody>
  </table>


    <!-- paper result  table end  -->

    

   </div>   <!--card body end -->
 </div>     <!--card for paper result  end -->




@endsection