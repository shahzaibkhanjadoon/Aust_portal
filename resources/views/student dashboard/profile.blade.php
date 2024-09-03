<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complete profile</title>
    <link rel="icon" type="image/x-icon" href="images/aust logo.png">
    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         
<!-- external css -->

 <link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

 <!-- font awesome link  -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
     <script>
    </script> 
    <!-- javascript section end  -->
</head> 
<body>


<!-- content section start -->
  <div class="row"><!-- heading row start -->
    <div class="col-12">
      <h2 class="fw-bolder text-center mt-3 bg-primary">Complete Your Profile:</h2>
      @if(Session::has('success'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
    </div> 
  </div>  <!-- heading row end -->
 
  <!-- registeration form start -->
  <form action="{{route('complete_profile')}}" method="post" enctype="multipart/form-data"> 
      @csrf 

  <div id="regform" class="row p-5"> <!-- row 1 for registration form start -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> <!-- col for registration form start -->
      <div class="card"> <!-- card for personal info form start -->
       <h2 class="fw-bolder card-title text-center bg-primary">Personal Information</h2>
       <div class="card-body"><!-- card body for personal info form start -->
        
            <input type="text" class="form-control" id="stu_name" required name="name" placeholder="Enter Student Name">
           
            <input type="text" class="form-control" id="father_name" required name="father_name" placeholder="Enter Father Name">
            @error('father_name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <label class="form-label mt-3 mb-3">Gender:</label>
            
            <label class="radio-inline">
              <input type="radio" name="gender" required value="Male">&nbsp;Male
            </label>
            <label class="radio-inline">
              <input type="radio" name="gender" required value="Female">&nbsp;Female
            </label>
            @error('gender')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Email Adress">
            @error('email')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <input type="text" class="form-control" id="Nationality" required name="nationality" placeholder="Enter Nationality">
            @error('nationality')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <input type="number" class="form-control" id="cnic" required name="cnic" placeholder="Enter CNIC no">
            @error('cnic')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <label for="dob" class="form-label mt-3">Date Of Birth</label>
            <input type="date" class="form-control" required id="dob" name="dob">
            @error('dob')
  <span class="text-danger">{{ $message }}</span>
  @enderror

            <input type="number" class="form-control" id="phone" required name="phone" placeholder="Enter phone no">
            @error('phone')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <input type="text" class="form-control" id="religion" required name="religion" placeholder="Religion">
            @error('religion')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <label for="image" class="form-label mt-3">Profile picture</label>
            <input type="file" required class="form-control" id="image" name="image">
            @error('image')
  <span class="text-danger">{{ $message }}</span>
  @enderror
       </div> <!-- card body for personal info form end-->
      </div> <!-- card for personal info form end -->
    </div> <!-- col 1 for registration form end -->



     <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">  <!-- col 2 for registration form start -->
     

      <div class="card"> <!-- card for acadamic form start -->
        <h2 class="fw-bolder card-title text-center bg-primary">Academic Information</h2>
        <div class="card-body"><!-- card body for academic info form start -->
         
             <input type="number" class="form-control" id="roll_no" name="roll_no" disabled placeholder="Enter Roll no">
             @error('roll_no')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <label for="Admissiondate" class="form-label mt-3">Admission Date</label>
             <input type="date" class="form-control" id="Admissiondate" required name="admission_date">
             @error('admission_date')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="text" class="form-control" id="sscdegreename" required name="ssc_degree_name" placeholder="Enter SSC Degree Name">
             @error('ssc_degree_name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="text" class="form-control" id="sscboardname" required name="ssc_board_name" placeholder="Enter SSC Board Name">
             @error('ssc_board_name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="number" class="form-control" id="ssctotmarks" required name="ssc_tot_marks" placeholder="Enter SSC Total Marks">
             @error('ssc_tot_marks')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="number" class="form-control" id="sscobtmarks" required name="ssc_obt_marks" placeholder="Enter SSC Obtained Marks">
             @error('ssc_obt_marks')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="text" class="form-control" id="hsscdegreename" required name="hssc_degree_name" placeholder="Enter HSSC Degree Name">
             @error('hssc_degree_name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="text" class="form-control" id="hsscboardname" required name="hssc_board_name" placeholder="Enter HSSC Board Name">
             @error('hssc_board_name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="number" class="form-control" id="hssctotmarks" required name="hssc_tot_marks" placeholder="Enter HSSC Total Marks">
             @error('hssc_tot_marks')
  <span class="text-danger">{{ $message }}</span>
  @enderror
             <input type="number" class="form-control mt-4 mb-5" id="hsscobtmarks" required name="hssc_obt_marks" placeholder="Enter HSSC Obtained Marks">
             @error('hssc_obt_marks')
  <span class="text-danger">{{ $message }}</span>
  @enderror
 
 
             
        </div> <!-- card body for acadamic info  form end-->
       </div> <!-- card for acadamics info form end -->



     </div>  <!-- col 2 for registration form end -->


  </div> <!-- row 1 for registration form end -->
  <div id="regform" class="row p-5"><!-- row 2 for registration form start -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <!-- col  for registration form start -->
     <div class="card mt-5">
       <h2 class="card-title text-center bg-primary fw-bolder">Residential Information</h2>
       <div class="card-body">
        <input type="text" class="form-control" id="city" required name="city" placeholder="City">
        @error('city')
  <span class="text-danger">{{ $message }}</span>
  @enderror
        <input type="text" class="form-control" id="mailingadress" required name="mailing_adress" placeholder="Mailing Adress">
        @error('mailing_adress')
  <span class="text-danger">{{ $message }}</span>
  @enderror
        <input type="text" class="form-control" id="domiciledistrict" required name="domicile_dist" placeholder="Domicile District">
        @error('domicile_dist')
  <span class="text-danger">{{ $message }}</span>
  @enderror
        <input type="text" class="form-control" id="domicileprovience" required name="domicile_prov" placeholder="Domicile province">
        @error('domicile_prov')
  <span class="text-danger">{{ $message }}</span>
  @enderror
       </div>
       <div class="card-footer text-end"><button type="submit" class="btn btn-success">Save</button></div>
     </div>
    </div><!-- col for registration form end -->
  </div><!-- row 2 for registration form end -->
  <!-- registeration form end -->
  </form>
</section>
<!--content section end-->
    
   
