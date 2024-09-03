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
  <form action="{{route('complete_faculty_profile')}}" method="post" enctype="multipart/form-data"> 
      @csrf 

  <div id="regform" class="row p-5"> <!-- row 1 for registration form start -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <!-- col for registration form start -->
      <div class="card"> <!-- card for personal info form start -->
       <h2 class="fw-bolder card-title text-center bg-primary">Profile Information</h2>
       <div class="card-body"><!-- card body for personal info form start -->
        
            <input type="text" class="form-control" id="stu_name" required name="name" placeholder="Enter your Name">
            @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            
            <label class="form-label mt-3 mb-3">Gender:</label>
            
            <label class="radio-inline">
              <input type="radio" name="gender"  value="Male">&nbsp;Male
            </label>
            <label class="radio-inline">
              <input type="radio" name="gender" required value="Female">&nbsp;Female
            </label>
            @error('gender')
  <span class="text-danger">{{ $message }}</span>
  @enderror

  <input type="text" class="form-control" id="employe_id" required name="employe_id" placeholder="Enter your emplye id">
            @error('employe_id')
  <span class="text-danger">{{ $message }}</span>
  @enderror
  <select class="form-control"  name="designation">
    <option>
      Lecturer
</option>
<option>
      Assistant Professor
</option>
<option>
     Assosiate Professor
</option>
<option>
      Professor
</option>
</select>
<br>
  <input type="number" class="form-control" id="cnic" required name="cnic" placeholder="Enter CNIC no">
            @error('cnic')
  <span class="text-danger">{{ $message }}</span>
  @enderror    
  
  <input type="number" class="form-control" id="phone" required name="phone" placeholder="Enter phone no">
            @error('phone')
  <span class="text-danger">{{ $message }}</span>
  @enderror

            <input type="text" class="form-control" id="Nationality" required name="nationality" placeholder="Enter Nationality">
            @error('nationality')
  <span class="text-danger">{{ $message }}</span>
  @enderror
         
  
  <select class="form-control"  name="contract">
    <option>
      Full time
</option>
<option>
      Fixed Contract
</option>
</select>
<br>

<select class="form-control" id="status" name="status">
    
  <option value="Active" selected>Active</option>
          

        </select>
        <br>   

            <input type="text" class="form-control" id="religion" required name="religion" placeholder="Religion">
            @error('religion')
  <span class="text-danger">{{ $message }}</span>
  @enderror
            <label for="image" class="form-label mt-3">Profile picture</label>
            <input type="file" required class="form-control" id="image" name="image">
            @error('image')
  <span class="text-danger">{{ $message }}</span>
  @enderror

  <div class="text-end">
  <button type="submit" class="btn btn-success"> Save
</div>
</div> <!-- card body for personal info form end-->
      </div> <!-- card for personal info form end -->
    </div> <!-- col 1 for registration form end -->

  <!-- registeration form end -->
  </form>
</section>
<!--content section end-->
    
   
