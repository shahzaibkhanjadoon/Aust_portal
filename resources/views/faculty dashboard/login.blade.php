<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Login</title>
  <link rel="icon" type="image/x-icon" href=" {{asset('faculty files/images/aust logo.png')}}">
   <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('faculty files/css/faculty login.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
</head>
<body>
  <section id="header">    <!-- top header section start -->

    <div class="row">    <!-- row for header section start  -->

        <div id="logo" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">    <!-- col 1 for header start  -->
            <img src="{{asset('faculty files/images/aust logo.png')}}">
            AUST PORTAL 

        </div><!-- col 1 for header end -->

        
    </div>     <!-- row for header section end  -->

    
    </section> <!--top header section end-->
<br>
<br>

<section id="content"> <!--section for content start-->
<div class="container"> <!--container for content start-->
@if(Session::has('login_fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-danger alert-dismissible mt-2" role="alert">
{{Session::get('login_fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
  <div class="row"> <!--row for content start-->
    <div id="login" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><!--col for content start-->
      <div class="card"> <!--card start-->
      <span  class="card-title mt-3">Faculty Login</span> <!--card title-->
        <div class="card-body"> <!--card body start-->
        <!-- isset($guard) ? url($guard.'/login') : route('login') dafault login route -->
          <form method="POST" action="{{ route('faculty_login') }}">  <!--form start-->
            @csrf
          <div class="mb-3">
              <input type="text" class="form-control" id="email" name="email" required autofocus placeholder="Enter Your Email">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="Enter Your Password">
            </div>
            <button  type="submit" class="btn btn-primary login mb-3">Login</button>
          </form>  <!--form end-->
          @if (Route::has('password.request'))

          @endif
        </div> <!--card body end-->
      </div> <!--card end-->
    </div> <!--col for content end-->
  </div> <!--row for content end-->
</div> <!--container for content end-->
</section> <!--section for content end-->
   
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>