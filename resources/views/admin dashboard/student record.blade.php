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


<div id="recordcard" class="row"> <!--  row for record table start -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <!--  col for record table start -->
    @foreach($student_personal_info as $student_personal)
    @foreach($student_class_info as $student_class)
      <div class="card">  <!--card for record table start-->
        <div class="card-body"> <!--card body for record table end-->
     
          <!-- record table start -->

          <table id="recordtable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">personal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Name</th>
                <td>{{$student_personal->name}}</td>
              </tr>
              <tr>
                <th>Father Name</th>
                <td>{{$student_personal->father_name}}</td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>{{$student_personal->Gender}}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{$student_personal->email}}</td>
              </tr>
              <tr>
                <th>Nationality</th>
                <td>{{$student_personal->Nationality}}</td>
              </tr>
              <tr>
                <th>CNIC</th>
                <td>{{$student_personal->CNIC}}</td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td>{{$student_personal->Date_of_Birth}}</td>
              </tr>
              <tr>
                <th>Phone</th>
                <td>{{$student_personal->phone_no}}</td>
              </tr>
              <tr>
                <th>Religion</th>
                <td>{{$student_personal->Religion}}</td>
              </tr>
              <tr>
                <th>Image</th>
                <td><img src="{{asset($student_personal->profile_pic)}}" style="width: 50px;"></td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th scope="col">Academic</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Roll No</th>
                <td>{{$student_personal->roll_no}}</td>
              </tr>
              <tr>
                <th>Admission Date</th>
                <td>{{$student_personal->Admission_date}}</td>
              </tr>
              <tr>
                <th>Department</th>
                <td>{{$student_class->department}}</td>
              </tr>
              <tr>
                <th>programme</th>
                <td>{{$student_class->programme}}</td>
              </tr>
              <tr>
                <th>semester</th>
                <td>{{$student_class->semester}}</td>
              </tr>
              <tr>
                <th>Section</th>
                <td>{{$student_class->section}}</td>
              </tr>
              <tr>
                <th>session</th>
                <td>{{$student_class->session}}</td>
              </tr>
              <tr>
                <th>Year</th>
                <td>{{$student_class->year}}</td>
              </tr>
              
              <tr>
                <th>SSC Degree Name</th>
                <td>{{$student_personal->ssc_degree_name}}</td>
              </tr>
              <tr>
                <th>SSC Board Name</th>
                <td>{{$student_personal->ssc_board_name}}</td>
              </tr>
              <tr>
                <th>SSC Total Marks</th>
                <td>{{$student_personal->ssc_total_marks}}</td>
              </tr>
              <tr>
                <th>SSC Obtained Marks</th>
                <td>{{$student_personal->ssc_obt_marks}}</td>
              </tr>
              <tr>
                <th>HSSC Degree name</th>
                <td>{{$student_personal->hssc_degree_name}}</td>
              </tr>
              <tr>
                <th>HSSC Board Name</th>
                <td>{{$student_personal->hssc_board_name}}</td>
              </tr>
              <tr>
                <th>HSSC Total Marks</th>
                <td>{{$student_personal->hssc_total_marks}}</td>
              </tr>
              <tr>
                <th>HSSC Obtained Marks</th>
                <td>{{$student_personal->hssc_obt_marks}}</td>
              </tr>
            </tbody>
            <thead>
              <tr >
                <th  scope="col">Residential</th>


              </tr>
            </thead>
            <tbody>
              <tr>
                <th>City Adress</th>
                <td>{{$student_personal->city}}</td>
              </tr>
              <tr>
                <th>Mailing Adress</th>
                <td>{{$student_personal->mailing_adress}}</td>
              </tr>
              <tr>
                <th>Domicile District</th>
                <td>{{$student_personal->domicile_district}}</td>
              </tr>
              <tr>
                <th>Domicile Privience</th>
                <td>{{$student_personal->domicile_province}}</td>
              </tr>
             
              <thead>
              <tr >
                <th  scope="col" class="text-end"></th>
                <th  scope="col" class="text-end"><a href="{{route('back_from_student_record')}}"><button class="btn btn-primary">Back</button></a></th>
              </tr>
            </thead>
            
            </tbody>
            
          </table>
         <!-- record table end -->

        </div><!--card  body for record table end-->
      </div><!--card for record table end-->
      @endforeach
      @endforeach
    </div><!--  col for record table end -->
  </div> <!--  row for record table end -->
@endsection