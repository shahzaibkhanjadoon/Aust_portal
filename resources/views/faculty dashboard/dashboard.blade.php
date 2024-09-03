@extends('faculty dashboard.faculty master')
@section('dashboard')


<div id="contentarea" class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
               <!-- card for  personel info  start   -->
              
               <div id="infocard" class="card">
                <span class="card-title text-start mb-2">Personal Information:</span>

                 <div class="card-body">

                 <!-- Information  table start  -->

               
                 <table id="#infotable" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    @foreach($faculty_personal_info as $faculty)
                    <tr>
                      <th scope="row">Employe Id</th>
                      <td class="text-center" width="25%">{{$faculty->Employe_id}}</td>
                      <th class="text-center" width="25%" scope="row">CNIC</th>
                      <td class="text-center" width="25%">{{$faculty->cnic}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Gender</th>
                      <td class="text-center" width="25%">{{$faculty->gender}}</td>
                      <th class="text-center" width="25%" scope="row">Email</th>
                      <td class="text-center" width="25%" >{{$faculty->email}}</td>
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
                      <th class="text-center" width="25%" scope="row">phone</th>
                      <td class="text-center" width="25%">{{$faculty->phone}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Contract</th>
                      <td class="text-center" width="25%">{{$faculty->contract}}</td>
                      <th class="text-center" width="25%" scope="row">Status</th>
                      <td class="text-center" width="25%">{{$faculty->status}}</td>
                    </tr>
                   @endforeach
                   
                  </tbody>
                </table>


                  <!-- Information  table end  -->
            
                 </div>   <!--card body end -->
               </div>     <!--card for personal info  end -->

       




              



              
              <!-- all  content will be placed here  -->
         

               
         </div><!-- col 8 for  content  area  end  -->   


@endsection