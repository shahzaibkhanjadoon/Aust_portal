@extends('student dashboard.student master')
@section('dashboard')
 <!-- card for  personel info  start   -->
 @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif

          @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible mt-3" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
      
 <div id="infocard" class="card">
                <span class="card-title text-start mb-2">Personal Information:</span>

                 <div class="card-body">

                 <!-- Information  table start  -->

               
                 <table id="#infotable" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    @foreach($student_personal_info as $student_personal)
                    <tr>
                    <th scope="row">Father Name</th>
                      <td class="text-center" width="25%">{{$student_personal->father_name}}</td>
                      <th class="text-center" width="25%" scope="row">City</th>
                      <td class="text-center" width="25%">{{$student_personal->city}}</td>
                    </tr>
                   
                    <tr>
                      <th scope="row">Programme</th>
                      <td class="text-center" width="25%">{{$student_class_info->programme}}</td>
                      <th class="text-center" width="25%" scope="row">Adress</th>
                      <td class="text-center" width="25%" >{{$student_personal->mailing_adress}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Session</th>
                      <td class="text-center" width="25%">{{$student_class_info->session}}</td>
                      <th  class="text-center" width="25%" scope="row">CNIC</th>
                      <td class="text-center" width="25%">{{$student_personal->CNIC}}</td>
                    </tr>
                    <tr>
                      <th  scope="row">Roll no</th>
                      <td class="text-center" width="25%">{{$student_personal->roll_no}}</td>
                      <th class="text-center" width="25%" scope="row">Email</th>
                      <td class="text-center" width="25%">{{$student_personal->email}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Section</th>
                      <td class="text-center" width="25%">{{$student_class_info->section}}</td>
                      <th class="text-center" width="25%" scope="row">Domicile</th>
                      <td class="text-center" width="25%">{{$student_personal->domicile_district}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Gender</th>
                      <td class="text-center" width="25%">{{$student_personal->Gender}}</td>
                      <th class="text-center" width="25%" scope="row" >Nationality</th>
                      <td class="text-center" width="25%">{{$student_personal->Nationality}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Semester</th>
                      <td class="text-center" width="25%">{{$student_class_info->semester}}</td>
                      <th class="text-center" width="25%" scope="row">Religion</th>
                      <td class="text-center" width="25%">{{$student_personal->Religion}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>


                  <!-- Information  table end  -->
            
                 </div>   <!--card body end -->
               </div>     <!--card for personal info  end -->

       




              

<!-- card for attendance start   -->
              
<div id="infocard" class="card mb-5">
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

              
              <!-- all  content will be placed here  -->
         
            

@endsection