@extends('admin dashboard.admin master')
@section('dashboard')
<div class="row">
    <div class="col col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5 mb-5">
        <div class="card card-body searchinfo">
          <!-- table of student info start  -->
          @foreach($faculty_personal_info as $faculty)
          <span class="badge bg-primary">{{$faculty->name}}</span>
          <table id="#infotable" class="table table-striped table-hover">
          
            <tbody class="mt-5" >
              <tr>
                <th scope="row">Employe id</th>
                <td class="text-center" width="25%">{{$faculty->Employe_id}}</td>
                <th class="text-center" width="25%" scope="row">CNIC</th>
                <td class="text-center" width="25%">{{$faculty->Employe_id}}</td>
              </tr>
              <tr>
                <th scope="row">Gender</th>
                <td class="text-center" width="25%">{{$faculty->gender}}</td>
                <th class="text-center" width="25%" scope="row" >Email</th>
                <td class="text-center" width="25%">{{$faculty->email}}</td>
              </tr>
              
              <tr>
                <th scope="row">Nationality</th>
                <td class="text-center" width="25%">{{$faculty->nationality}}</td>
                <th  class="text-center" width="25%" scope="row">Religion</th>
                <td class="text-center" width="25%">{{$faculty->religion}}</td>
              </tr>
              <tr>
                <th  scope="row">Designation</th>
                <td class="text-center" width="25%">{{$faculty->designation}}</td>
                <th class="text-center" width="25%" scope="row">Phone</th>
                <td class="text-center" width="25%">{{$faculty->phone}}</td>
              </tr>
              <tr>
                <th scope="row">contract Type</th>
                <td class="text-center" width="25%">{{$faculty->contract}}</td>
                <th class="text-center" width="25%" scope="row">Status</th>
                <td class="text-center" width="25%">{{$faculty->status}}</td>
              </tr>
             
              
            </tbody>
          </table>

          @endforeach

         <!-- table of student info end  -->
 
        </div> <!-- col 12  end -->
    </div>  <!-- row end -->
    @endsection