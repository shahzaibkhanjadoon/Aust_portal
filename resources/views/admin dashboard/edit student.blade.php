@extends('admin dashboard.admin master')
@section('dashboard')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard/Edit Student</title>
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
@foreach($editable_data as $data)
<form action="{{url('updatestudent'.$data->id)}}" method="post" enctype="multipart/form-data">  
  @csrf

<div id="regform" class="row"> <!-- row 1 for Edit form start -->
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> <!-- col for Edit form start -->
    <div class="card"> <!-- card for personal info form start -->
     <h2 class="fw-bolder card-title text-center bg-primary">Personal Information</h2>
     <div class="card-body"><!-- card body for personal info form start -->
         
          <input type="text" class="form-control" id="stu_name" name="name" value="{{$data->name}}">
          <input type="text" class="form-control" id="father_name" name="father_name" value="{{$data->father_name}}" >
          <label class="form-label mt-3 mb-3">Gender:</label>
          <label class="radio-inline">
            <input type="radio" name="gender" required   value="Male">&nbsp;Male
          </label>
          <label class="radio-inline">
            <input type="radio" name="gender">&nbsp;Female
          </label>
          
          
          <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}">
          
          <input type="text" class="form-control" id="Nationality" name="nationality" value="{{$data->Nationality}}">
        
          <input type="number" class="form-control" id="cnic" name="cnic" value="{{$data->CNIC}}">
          <label for="dob" class="form-label mt-3">Date Of Birth</label>
          <input type="date" class="form-control" id="dob" name="dob" value="{{$data->Date_of_Birth}}">

          <input type="number" class="form-control" id="phone" name="phone" value="{{$data->phone_no}}">
          <input type="text" class="form-control" id="religion" name="religion" value="{{$data->Religion}}">

          <label for="image" class="form-label mt-3">Image</label>
          <input type="file" class="form-control" id="image" name="image">
          <input type="hidden" name="old_image"  value="{{$data->profile_pic}}">
     </div> <!-- card body for personal info form end-->
    </div> <!-- card for personal info form end -->
  </div> <!-- col 1 for registration form end -->



   <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">  <!-- col 2 for registration form start -->
   

    <div class="card"> <!-- card for acadamic form start -->
      <h2 class="fw-bolder card-title text-center bg-primary">Academic Information</h2>
      <div class="card-body"><!-- card body for academic info form start -->
       
           <input type="number" class="form-control" id="roll_no" name="roll_no" disabled value="{{$data->roll_no}}">
           <label for="Admissiondate" class="form-label mt-3">Admission Date</label>
           <input type="date" class="form-control" id="Admissiondate" name="admission_date" value="{{$data->Admission_date}}">

           <input type="text" class="form-control" id="sscdegreename" name="ssc_degree_name" value="{{$data->ssc_degree_name}}">
           <input type="text" class="form-control" id="sscboardname" name="ssc_board_name" value="{{$data->ssc_board_name}}">
           <input type="number" class="form-control" id="ssctotmarks" name="ssc_tot_marks" value="{{$data->ssc_total_marks}}">
           <input type="number" class="form-control" id="sscobtmarks" name="ssc_obt_marks" value="{{$data->ssc_obt_marks}}">

           <input type="text" class="form-control" id="hsscdegreename" name="hssc_degree_name" value="{{$data->hssc_degree_name}}">
           <input type="text" class="form-control" id="hsscboardname" name="hssc_board_name" value="{{$data->hssc_board_name}}">
           <input type="number" class="form-control" id="hssctotmarks" name="hssc_tot_marks" value="{{$data->hssc_total_marks}}">
           <input type="number" class="form-control mt-4 mb-5" id="hsscobtmarks" name="hssc_obt_marks" value="{{$data->hssc_obt_marks}}">


           
      </div> <!-- card body for acadamic info  form end-->
     </div> <!-- card for acadamics info form end -->



   </div>  <!-- col 2 for registration form end --> 


</div> <!-- row 1 for registration form end -->
<div id="regform" class="row"><!-- row 2 for registration form start -->
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <!-- col  for registration form start -->
   <div class="card mt-5">
     <h2 class="card-title text-center bg-primary fw-bolder">Residential Information</h2>
     <div class="card-body">
      <input type="text" class="form-control" id="city" name="city" value="{{$data->city}}">
      <input type="text" class="form-control" id="mailingadress" name="mailing_adress" value="{{$data->mailing_adress}}">
      <input type="text" class="form-control" id="domiciledistrict" name="domicile_dist" value="{{$data->domicile_district}}">
      <input type="text" class="form-control" id="domicileprovience" name="domicile_prov" value="{{$data->domicile_province}}">
     </div>
     <div class="card-footer text-end"><button type="submit" class="btn btn-success">Update Student</button></div>
   </div>
  </div><!-- col for registration form end -->
</div><!-- row 2 for registration form end -->
<!-- registeration form end -->
</form>
@endforeach
@endsection