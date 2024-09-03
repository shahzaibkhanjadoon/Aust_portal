@extends('admin dashboard.admin master')
@section('dashboard')
<div class="row">
    <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5 mb-5">
        <div class="card card-body searchinfo">
          <!-- table of student info start  -->
          @foreach($student_personal_info as $personal_info)
          @foreach($student_class_info as $class_info)
          <span class="badge bg-primary">{{$personal_info->name}}</span>
          @endforeach
         @endforeach
          <table id="#infotable" class="table table-striped table-hover">
          
            <tbody class="mt-5" >
              <tr>
                <th scope="row">Father Name</th>
                <td class="text-center" width="25%">{{$personal_info->father_name}}</td>
                <th class="text-center" width="25%" scope="row">City</th>
                <td class="text-center" width="25%">{{$personal_info->city}}</td>
              </tr>
              <tr>
                <th scope="row">Gender</th>
                <td class="text-center" width="25%">{{$personal_info->Gender}}</td>
                <th class="text-center" width="25%" scope="row" >Nationality</th>
                <td class="text-center" width="25%">{{$personal_info->Nationality}}</td>
              </tr>
              <tr>
                <th scope="row">Programme</th>
                <td class="text-center" width="25%">{{$class_info->programme}}</td>
                <th class="text-center" width="25%" scope="row">Adress</th>
                <td class="text-center" width="25%" >{{$personal_info->mailing_adress}}</td>
              </tr>
              <tr>
                <th scope="row">Session</th>
                <td class="text-center" width="25%">{{$class_info->session}}</td>
                <th  class="text-center" width="25%" scope="row">CNIC</th>
                <td class="text-center" width="25%">{{$personal_info->CNIC}}</td>
              </tr>
              <tr>
                <th  scope="row">Roll no</th>
                <td class="text-center" width="25%">{{$personal_info->roll_no}}</td>
                <th class="text-center" width="25%" scope="row">Email</th>
                <td class="text-center" width="25%">{{$personal_info->email}}</td>
              </tr>
              <tr>
                <th scope="row">Section</th>
                <td class="text-center" width="25%">{{$class_info->section}}</td>
                <th class="text-center" width="25%" scope="row">Domicile</th>
                <td class="text-center" width="25%">{{$personal_info->domicile_district}}</td>
              </tr>
             
              <tr>
                <th scope="row">Semester</th>
                <td class="text-center" width="25%">{{$class_info->semester}}</td>
                <th class="text-center" width="25%" scope="row">Religion</th>
                <td class="text-center" width="25%">{{$personal_info->Religion}}</td>
              </tr>
             
            </tbody>
          </table>

         
         <!-- table of student info end  -->
 
        </div> <!-- col 12  end -->
    </div>  <!-- row end -->
    @endsection