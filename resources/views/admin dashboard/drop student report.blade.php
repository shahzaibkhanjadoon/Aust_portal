@extends('admin dashboard.admin master')
@section('dashboard')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/Student Record</title>
    <link rel="icon" type="image/x-icon" href="images/aust logo.png">

    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->

<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
    <script>
    </script>
    <!-- javascript section end  -->
</head>


  <div id="recordcard" class="row mt-5"> <!--  row for record table start -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <!--  col for record table start -->
      <div class="card">  <!--card for record table start-->
        <div class="card-body"> <!--card body for record table end-->
     
          <!-- record table start -->
          <table id="recordtable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">personal:</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Name</th>
                <td>{{$drop_students->name}}</td>
              </tr>
              <tr>
                <th>Father Name</th>
                <td>{{$drop_students->father_name}}</td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>{{$drop_students->Gender}}</td>
              </tr>
             
              <tr>
                <th>Nationality</th>
                <td>{{$drop_students->Nationality}}</td>
              </tr>
              <tr>
                <th>CNIC</th>
                <td>{{$drop_students->CNIC}}</td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td>{{$drop_students->Date_of_Birth}}</td>
              </tr>
              <tr>
                <th>Phone</th>
                <td>{{$drop_students->phone_no}}</td>
              </tr>
              <tr>
                <th>Releigon</th>
                <td>{{$drop_students->Religion}}</td>
              </tr>
             
            </tbody>
            <thead>
              <tr>
                <th scope="col">Academic:</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Roll no</th>
                <td>{{$drop_students->roll_no}}</td>
              </tr>
              <tr>
                <th>Admission date</th>
                <td>{{$drop_students->Admission_date}}</td>
              </tr>
              <tr>
                <th>SSC Degree name</th>
                <td>{{$drop_students->ssc_degree_name}}</td>
              </tr>
              <tr>
                <th>SSC Degree Board</th>
                <td>{{$drop_students->ssc_board_name}}</td>
              </tr>
              <tr>
                <th>SSC Total Marks</th>
                <td>{{$drop_students->ssc_total_marks}}</td>
              </tr>
              <tr>
                <th>SSC Obtained Marks</th>
                <td>{{$drop_students->ssc_obt_marks}}</td>
              </tr>
              <tr>
                <th>HSSC Degree name</th>
                <td>{{$drop_students->hssc_degree_name}}</td>
              </tr>
              <tr>
                <th>HSSC Degree Board</th>
                <td>{{$drop_students->hssc_board_name}}</td>
              </tr>
              <tr>
                <th>HSSC Total Marks</th>
                <td>{{$drop_students->hssc_total_marks}}</td>
              </tr>
              <tr>
                <th>HSSC Obtained Marks</th>
                <td>{{$drop_students->hssc_obt_marks}}</td>
              </tr>
            </tbody>
            <thead>
              <tr >
                <th  scope="col">Residential:</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>City Adress</th>
                <td>{{$drop_students->city}}</td>
              </tr>
              <tr>
                <th>Mailing Adress</th>
                <td>{{$drop_students->mailing_adress}}</td>
              </tr>
              <tr>
                <th>Domicile District</th>
                <td>{{$drop_students->domicile_district}}</td>
              </tr>
              <tr>
                <th>Domicile Privience</th>
                <td>{{$drop_students->domicile_province}}</td>
              </tr>
              <tr >
                <thead>
                <th  scope="col">Droped From:</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Programme</th>
                <td>{{$drop_students->programme}}</td>
              </tr>
              <tr>
                <th>Session</th>
                <td>{{$drop_students->session}}</td>
              </tr>
              <tr>
                <th>Year</th>
                <td>{{$drop_students->year}}</td>
              </tr>
              <tr>
                <th>semester</th>
                <td>{{$drop_students->semester}}</td>
              </tr>
              <tr>
                <th>Section</th>
                <td>{{$drop_students->section}}</td>
              </tr>
              <tr>
                <th>CGPA</th>
                <td>{{$drop_students->cgpa}}</td>
              </tr>

              
            </tbody>
          </table>
         <!-- record table end -->

        </div><!--card  body for record table end-->
      </div><!--card for record table end-->
    </div><!--  col for record table end -->
  </div> <!--  row for record table end -->
@endsection