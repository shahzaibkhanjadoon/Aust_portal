<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUST PORTAL</title>
    <link rel="icon" type="image/x-icon" href="images/aust logo.png">
  
    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('index files/css/index.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
</head>
<body>
    <section id="header">    <!-- top header section start -->

    <div class="row">    <!-- row for header section start  -->
  
        <div id="logo" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">    <!-- col 1 for header start  -->
            <img src="{{asset('index files/images/aust logo.png')}}">
            AUST PORTAL 

        </div><!-- col 1 for header end -->

        
    </div>     <!-- row for header section end  -->

    
    </section> <!--top header section end-->

<div id="content" class="row"> <!-- row for content start -->

    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 content"> <!-- col 1 content start -->
    <!--   -->
   <a href="{{route('student_login_view')}}">
   <div class="card">
       <div class="card-body">
           <img src="{{asset('index files/images/student.png')}}" class="img img-responsive">
           <h3>Student Login</h3>
       </div>
   </div>
  </a>
  </div> <!-- col 1 content end -->
  <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 content"><!-- col 2 content start -->
    <a href="{{route('login')}}">
    <div class="card">
        <div class="card-body">
            <img src="{{asset('index files/images/admin.png')}} " class="img img-responsive">
            <h3>Admin Login</h3>
        </div>
    </div>
    </a>
  </div> <!-- col 2 content end -->
  <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 content"><!-- col 3 content start -->
    <a href="{{route('faculty_login_view')}}">
    <div class="card">
        <div class="card-body">
            <img  src=" {{asset('index files/images/faculty.png')}} " class="img img-responsive">
            <h3>faculty Login</h3>
        </div>
    </div>
    </a>
  </div> <!-- col 3 content end -->

      
</div> <!-- row for content end -->

    <!-- javascript with popper  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>