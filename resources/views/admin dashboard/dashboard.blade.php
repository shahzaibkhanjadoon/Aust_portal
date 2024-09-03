@extends('admin dashboard.admin master')
@section('dashboard')
<div class="row">   <!-- row for search bar start  -->
    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 searchbar">
      <form action="{{route('search_student')}}" method="post"><!-- form for student search  -->
      @csrf
     
   <label for="searchstudent" class="form-label">Student</label>
      
  <input type="number" class="form-control" id="searchstudent" name="roll_no" placeholder="Enter Roll_no.">
  <button type="submit" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;search</button>
     </form>
    
   </div>
   @error('roll_no')
  <span class="text-danger mt-2">{{ $message }}</span>
  @enderror
    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 searchbar">
      <form action="{{route('search_faculty')}}" method="post"><!-- form for faculty search  -->
     @csrf
      <label for="searchfaculty" class="form-label">Faculty:</label>
      
     <input type="email" class="form-control" id="searchfaculty" name="email" placeholder="Enter Email">
    
     <button type="submit" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;search</button>
     </form>
    
    </div> 
    @error('email')
  <span class="text-danger mt-2">{{ $message }}</span>
  @enderror 
  </div>  <!-- row for search bar end    -->

  <div class="row">
    <div class="col-12">
    @if(Session::has('fail'))
          <!-- bootstrap alert  code  -->
<div class="alert alert-danger alert-dismissible mt-5" role="alert">
{{Session::get('fail')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
          @endif
    </div>
  </div>

<section id="countboxes">  <!-- section for count boxes start  -->

  <div class="container"> <!-- container for count boxes start  -->

    <div class="row"> <!-- row for count boxes start  -->

      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"> <!-- col 1 for count boxes start  -->
        <div class="card"> <!-- card 1 for count boxes start  -->

          <span class="card-title">Total Register Students</span>
          <div class="card-body"> 
            <img src="{{asset('admin files/images/student white.png')}}">
          </div>
          <div class="card-footer badge bg-primary">{{$total_students}}</div>

        </div> <!-- card 1 for count boxes end  -->

      </div>   <!-- col 1  for count boxes end  -->

      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"> <!-- col 2 for count boxes start  -->
      

        <div class="card"> <!-- card 2 for count boxes start  -->

          <span class="card-title">Total Register Faculty</span>
          <div class="card-body"> 
            <img src="{{asset('admin files/images/faculty white.png')}}">
          </div>
          <div class="card-footer badge bg-primary">{{$total_faculty}}</div>

        </div> <!-- card 2 for count boxes end  -->

      </div>   <!-- col 2  for count boxes end  -->


      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"> <!-- col 3 for count boxes start  -->

        <div class="card"> <!-- card 3 for count boxes start  -->

          <span class="card-title">Total Register Courses</span>
          <div class="card-body"> 
            <img src="{{asset('admin files/images/courses white.png')}}">
          </div>
          <div class="card-footer badge bg-primary">{{$total_courses}}</div>

        </div> <!-- card 3 for count boxes end  -->
      </div>   <!-- col 3  for count boxes end  -->
    </div><!-- row for count boxes end  -->

  </div> <!-- container for count boxes end  -->

</section> <!-- section for count boxes end -->

<section id="classboxes" class="mt-5"> <!-- section for class boxes start -->
  <h3  class="test-strong fw-bolder">Students Count Per Class:</h3>
  <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target=".cs" aria-expanded="false" aria-controls="cs">Computer Science &nbsp; &nbsp; <i class="fa-solid fa-chevron-down"></i> </button>

  <div class="row cs collapse"> <!-- row 1 for  class CS count boxes start  -->

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 1</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$cs1_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 2</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$cs2_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 3</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$cs3_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 4</div>
        <div class="card-body">
          Totel Students: <span class="badge bg-primary">{{$cs4_total}}</span>
        </div>
      </div>
    </div> 

  </div> <!-- row 1 for  class  CS count boxes end  -->

  <div class="row mt-5 cs collapse"> <!-- row 2 for  class  CS count boxes start  -->

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 5</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$cs5_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 6</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$cs6_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 7</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$cs7_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">CS 8</div>
        <div class="card-body">
          Totel Students: <span class="badge bg-primary">{{$cs8_total}}</span>
        </div>
      </div>
    </div> 

  </div> <!-- row 2 for  class CS count boxes end  -->


  <button class="btn btn-primary mt-3 mb-3" type="button" data-bs-toggle="collapse" data-bs-target=".SE" aria-expanded="false" aria-controls="SE">Software Engineering &nbsp; &nbsp; <i class="fa-solid fa-chevron-down"></i> </button>

  <div class="row collapse SE"> <!-- row 1 for  class SE count boxes start  -->

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 1</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se1_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 2</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se2_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 3</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se3_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 4</div>
        <div class="card-body">
          Totel Students: <span class="badge bg-primary">{{$se4_total}}</span>
        </div>
      </div>
    </div> 

  </div> <!-- row 1 for  class SE count boxes end  -->

  <div class="row mt-5 collapse SE"> <!-- row 2 for  class SE count boxes start  -->

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 5</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se5_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 6</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se6_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 7</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se7_total}}</span>
        </div>
      </div>
    </div> 

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
      <div class="card">
        <div class="card-title fw-bolder">SE 8</div>
        <div class="card-body">
          Total Students: <span class="badge bg-primary">{{$se8_total}}</span>
        </div>
      </div>
    </div> 

  </div> <!-- row 2 for  class SE count boxes end  -->


  <button class="btn btn-primary mt-3 mb-3" type="button" data-bs-toggle="collapse" data-bs-target=".mphil_se" aria-expanded="false" aria-controls="mphil_se">MPHIL SE &nbsp; &nbsp; <i class="fa-solid fa-chevron-down"></i> </button>

  <div class="row collapse mphil_se"> <!-- row 1 for  class mphil SE count boxes start  -->

<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
  <div class="card">
    <div class="card-title fw-bolder">Mphil SE 1</div>
    <div class="card-body">
      Total Students: <span class="badge bg-primary">{{$MPHIL_SE1_total}}</span>
    </div>
  </div>
</div> 

<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
  <div class="card">
    <div class="card-title fw-bolder">Mphil SE 2</div>
    <div class="card-body">
      Total Students: <span class="badge bg-primary">{{$MPHIL_SE2_total}}</span>
    </div>
  </div>
</div> 

<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
  <div class="card">
    <div class="card-title fw-bolder">Mphil SE 3</div>
    <div class="card-body">
      Total Students: <span class="badge bg-primary">{{$MPHIL_SE3_total}}</span>
    </div>
  </div>
</div> 

<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
  <div class="card">
    <div class="card-title fw-bolder">Mphil SE 4</div>
    <div class="card-body">
      Totel Students: <span class="badge bg-primary">{{$MPHIL_SE4_total}}</span>
    </div>
  </div>
</div> 

</div> <!-- row 1 for  class mphilSE count boxes end  -->


  
  
</section> <!-- section for class boxes end -->
@endsection