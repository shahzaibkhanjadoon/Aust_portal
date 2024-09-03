<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="icon" type="image/x-icon" href="{{asset('admin files/images/aust logo.png')}}">
   <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('admin files/css/admin login.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
</head>
<body>
  <section id="header">    <!-- top header section start -->

    <div class="row">    <!-- row for header section start  -->

        <div id="logo" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">    <!-- col 1 for header start  -->
            <img src="{{asset('admin files/images/aust logo.png')}}">
            AUST PORTAL 

        </div><!-- col 1 for header end -->

        
    </div>     <!-- row for header section end  -->

    
    </section> <!--top header section end-->

<section id="content"> <!--section for content start-->
<div class="container"> <!--container for content start-->
  <div class="row"> <!--row for content start-->
    <div id="login" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><!--col for content start-->
      <div class="card"> <!--card start-->
      <span  class="card-title mt-3">Admin Login</span> <!--card title-->
        <div class="card-body"> <!--card body start-->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
          <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">  <!--form start-->
            @csrf
          <div class="mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required autofocus>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required autocomplete="current-password">
            </div>
            <button  type="submit" class="btn btn-primary login mb-3">Login</button>
          </form>  <!--form end-->
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