@extends('admin dashboard.admin master')
@section('dashboard')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
<!-- external css -->
<link rel="stylesheet" href="{{asset('admin files/css/style.css')}}">

<!-- font awesome link -->
<script src="https://kit.fontawesome.com/3a02aa8ab1.js" crossorigin="anonymous"></script>
<!-- javascript section start  -->
    
    <!-- javascript section end  -->
</head>


 <!--card for courses  start -->
 <div id="courses" class="card">
                <span class="card-title text-start mb-2">Courses:</span>

                 <div class="card-body">

                 <!-- courses table start  -->

               
                 <table id="courses_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th>Course Title</th>
                      <th class="text-center">Course Code</th>
                      <th class="text-center">Theory Credit Hours</th>
                      <th class="text-center">Lab Credit Hours</th>
                    </tr>
                    @foreach($courses as $course)
                    <tr>
                      <td>{{$course->course_title}}</td>
                      <td class="text-center">{{$course->course_code}}</td>
                      <td class="text-center"> {{$course->theory_cr_hrs}}</td>
                      <td class="text-center"> {{$course->lab_cr_hrs}}</td>
                    </tr>
                   @endforeach
                    
                   
                  </tbody>
                </table>


                  <!-- Information  table end  -->
            
                 </div>   <!--card body end -->
               </div>     <!--card for courses  end -->
@endsection