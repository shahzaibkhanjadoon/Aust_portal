@extends('student dashboard.student master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('student files/css/attendance.css')}}">
<!-- bootstrap css -->


<!-- card for attendance start   -->
              
<div id="attendance" class="card">
    <span class="card-title text-start mb-2">Select Your Courses:</span>
    <span class="card-title text-start mb-2 bg-info p-2">Instructions:</span>
    <ul>
      <li><span class="bg-warning">please register carefully as this is one time registration</span></li>
      <li><span class="bg-warning">please do not select course in which prerequsite is already fail</span></li>
    </ul>

     <div class="card-body">

     @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

          @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-danger alert-dismissible" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

     <!-- attendance table start  -->
     <form action="{{route('enroll_courses')}}" method="post">   
      @csrf
     <table id="attendancetable" class="table table-striped table-hover">

      <tbody class="mt-5" >
        <tr>
          <th scope="row" class="bg-primary">Current Semester  Courses:</th>      
          <th scope="row" class="bg-primary"></th>      
          <th scope="row" class="bg-primary"></th>      

        </tr>
      
        <tr>
 <th>
  Course title
</th>
<th>
  Credit Hours
</th>

<th>
  prerequsites
</th>
</tr>
        @foreach($courses as $current_course)
<tr>
<td> 
            <input type="checkbox"  name="current_course[]" value="{{$current_course->course_title}}">
 <strong> <label> {{$current_course->course_title}}</label></strong>

</td>

<td>
{{$current_course->theory_cr_hrs}}-{{$current_course->lab_cr_hrs}}
</td>

<td>
  @if($current_course->prerequsite_title==null)
  No prerequsite
  @else
{{$current_course->prerequsite_title}}
  @endif
</td>
 </tr>

 @endforeach
       
 
        <tr>
          <th scope="row" class="bg-warning">Previous Fail Courses: </th>         
          <th scope="row" class="bg-warning"> </th>         
          <th scope="row" class="bg-warning"> </th>         


        </tr>
 @foreach($failed_courses as $failed)
        <tr>
          <td scope="row">
          <input type="checkbox" name="current_course[]" value="{{$failed->course_title}}" id="current_course_2">
  <label for="current_course_2"> {{$failed->course_title}}</label>
 
        </td>    
        <td scope="row">
  <label for="current_course_2"> {{$failed->theory_cr_hrs}}-{{$failed->lab_cr_hrs}}</label>
        </td>   
        <td>
</td>
        </tr>
        @endforeach
     

       
        
        <tr class="card-footer">
          <th></th>
        <th></th>
        <th class="text-end"><input  type="submit" class="btn btn-success " value="Submit"></th>    
        
        </tr>
        
      </tbody>
    </table>
</form>


      <!-- attendance  table end  -->

     </div>   <!--card body end -->
   </div>     <!--card for attendace   end -->
@endsection