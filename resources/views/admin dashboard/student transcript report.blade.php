
<!-- bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('student files/css/courses.css')}}">

<body style="padding:40px;">

 <!--card for courses  start -->
 <div id="courses" class="card">

                 <div class="card-body">
                  <!-- row 1  for uni name and logo start -->
                 <div class="row mb-3"> 
                    <div class="col-4 col-sm-4 col-md-4 col=lg-4 col-xl-4">
                 <img src="{{asset('student files/images/aust logo.png')}}" style="width:70px; height:70px;">
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col=lg-4 col-xl-4 text-center">
                       <strong> Department of COMPUTER SCIENCES 
                        <br>
                        ABBOTTABAD UNIVIRSITY OF SCIENCE AND TECHNOLOGY
                        </div></strong>
                        <div class="col-4 col-sm-4 col-md-4 col=lg-4 col-xl-4 text-end">
                        <strong>
                            Provisional Result
                        </strong>
                        </div>
                 </div>  <!-- row 1  for uni name and logo end  -->


                   <!-- row 2  for gpa table start -->
                   <div class="row mb-3 mt-3"> 
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <b>Programme</b> &nbsp; {{$student_class_info->programme}}
                        <br>
                        <b>Roll No.</b> &nbsp; {{$student_class_info->roll_no}}
                        <br>
                        <b>Name</b> &nbsp; {{$student_class_info->student_name}}
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                    <table id="courses_table" class="table table-striped table-hover">
          
          <tbody >
            <tr>
              <th>Semester</th>
              <th class="text-center">Cr. Hrs</th>
              <th class="text-center">GPA</th>
              <th>Semester</th>
              <th class="text-center">Cr. Hr</th>
              <th class="text-center">GPA</th>
            </tr>
           
            <tr>
              <td>1</td>
              <td class="text-center"> {{$sem1_total_cr_hrs}}</td>
              <td class="text-center"> {{$sem1_gpa}}</td>
              <td class="text-center">5</td>
              <td></td>
              <td class="text-center"> </td>
              
            </tr>
            <tr>
              <td>2</td>
              <td class="text-center"> </td>
              <td class="text-center"> </td>
              <td class="text-center">6 </td>
              <td></td>
              <td class="text-center"> </td>
              
            </tr>
            <tr>
              <td>3</td>
              <td class="text-center"> </td>
              <td class="text-center"> </td>
              <td class="text-center">7 </td>
              <td></td>
              <td class="text-center"> </td>
              
            </tr>
            <tr>
              <td>4</td>
              <td class="text-center"> </td>
              <td class="text-center"> </td>
              <td class="text-center">8 </td>
              <td></td>
              <td class="text-center"> </td>
              
            </tr>
         
           
          </tbody>
        </table>
         </div>         <!-- col 2 end  -->

            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center">
                        <strong>
                            CGPA: &nbsp; {{$cgpa}}
                        </strong>
                        </div>
                 </div>  <!-- row 2  for gpa table  end  -->


                 <!-- courses table start  -->

               
                 <table id="courses_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th>Course Code</th>
                      <th class="text-center">Course Title</th>
                      <th class="text-center">Credit Hours</th>
                      <th class="text-center">Total Marks</th>
                      <th>Obtained Marks</th>
                      <th class="text-center">Grades</th>
                      <th class="text-center">Points Value</th>
                      <th class="text-center">Grade Points</th>
                    </tr>
                   
                    <!-- semester 1  -->
                    @for($i=0; $i<$sem1_lenght_check; $i++)

                    <tr>
                      <td>{{$sem1_course_codes[$i]}}</td>
                      <td class="text-center"> {{$sem1_course_titles[$i]}}</td>
                      <td class="text-center"> {{$sem1_cr_hrs[$i]}}</td>
                      <td class="text-center">100 </td>
                      <td>{{$sem1_obtained_marks[$i]}}</td>
                      <td class="text-center">A</td>
                      <td class="text-center"> {{$sem1_points[$i]}}</td>
                      <td class="text-center">{{$sem1_gp[$i]}} </td>
                    </tr>
                    
                    @endfor
                     <!-- semester 2  -->

                     @if($sem2_lenght_check>0)
                     
                      @for($i=0; $i<$sem2_lenght_check; $i++)

                    <tr>
                      <td>{{$sem2_course_codes[$i]}}</td>
                      <td class="text-center"> {{$sem2_course_titles[$i]}}</td>
                      <td class="text-center"> {{$sem2_cr_hrs[$i]}}</td>
                      <td class="text-center">100 </td>
                      <td>{{$sem2_obtained_marks[$i]}}</td>
                      <td class="text-center">A</td>
                      <td class="text-center"> {{$sem2_points[$i]}}</td>
                      <td class="text-center">{{$sem2_gp[$i]}} </td>
                    </tr>
                    @endfor

                      @else
                      
                    @endif


                   <!-- semester 3  -->
                   @if($sem3_lenght_check>0)
                     
                     @for($i=0; $i<$sem3_lenght_check; $i++)

                   <tr>
                     <td>{{$sem3_course_codes[$i]}}</td>
                     <td class="text-center"> {{$sem3_course_titles[$i]}}</td>
                     <td class="text-center"> {{$sem3_cr_hrs[$i]}}</td>
                     <td class="text-center">100 </td>
                     <td>{{$sem3_obtained_marks[$i]}}</td>
                     <td class="text-center">A</td>
                     <td class="text-center"> {{$sem3_points[$i]}}</td>
                     <td class="text-center">{{$sem3_gp[$i]}} </td>
                   </tr>
                   @endfor

                     @else
                     
                   @endif

                     <!-- semester 4  -->
                     @if($sem4_lenght_check>0)
                     
                     @for($i=0; $i<$sem4_lenght_check; $i++)

                   <tr>
                     <td>{{$sem4_course_codes[$i]}}</td>
                     <td class="text-center"> {{$sem4_course_titles[$i]}}</td>
                     <td class="text-center"> {{$sem4_cr_hrs[$i]}}</td>
                     <td class="text-center">100 </td>
                     <td>{{$sem4_obtained_marks[$i]}}</td>
                     <td class="text-center">A</td>
                     <td class="text-center"> {{$sem4_points[$i]}}</td>
                     <td class="text-center">{{$sem4_gp[$i]}} </td>
                   </tr>
                   @endfor

                     @else
                     
                   @endif

                     <!-- semester 5  -->
                     @if($sem5_lenght_check>0)
                     
                      @for($i=0; $i<$sem5_lenght_check; $i++)

                    <tr>
                      <td>{{$sem5_course_codes[$i]}}</td>
                      <td class="text-center"> {{$sem5_course_titles[$i]}}</td>
                      <td class="text-center"> {{$sem5_cr_hrs[$i]}}</td>
                      <td class="text-center">100 </td>
                      <td>{{$sem5_obtained_marks[$i]}}</td>
                      <td class="text-center">A</td>
                      <td class="text-center"> {{$sem5_points[$i]}}</td>
                      <td class="text-center">{{$sem5_gp[$i]}} </td>
                    </tr>
                    @endfor

                      @else
                      
                    @endif

                     <!-- semester 6  -->
                     @if($sem6_lenght_check>0)
                     
                     @for($i=0; $i<$sem6_lenght_check; $i++)

                   <tr>
                     <td>{{$sem6_course_codes[$i]}}</td>
                     <td class="text-center"> {{$sem6_course_titles[$i]}}</td>
                     <td class="text-center"> {{$sem6_cr_hrs[$i]}}</td>
                     <td class="text-center">100 </td>
                     <td>{{$sem6_obtained_marks[$i]}}</td>
                     <td class="text-center">A</td>
                     <td class="text-center"> {{$sem6_points[$i]}}</td>
                     <td class="text-center">{{$sem6_gp[$i]}} </td>
                   </tr>
                   @endfor

                     @else
                     
                   @endif

                     <!-- semester 7  -->
                     @if($sem7_lenght_check>0)
                     
                     @for($i=0; $i<$sem7_lenght_check; $i++)

                   <tr>
                     <td>{{$sem7_course_codes[$i]}}</td>
                     <td class="text-center"> {{$sem7_course_titles[$i]}}</td>
                     <td class="text-center"> {{$sem7_cr_hrs[$i]}}</td>
                     <td class="text-center">100 </td>
                     <td>{{$sem7_obtained_marks[$i]}}</td>
                     <td class="text-center">A</td>
                     <td class="text-center"> {{$sem7_points[$i]}}</td>
                     <td class="text-center">{{$sem7_gp[$i]}} </td>
                   </tr>
                   @endfor

                     @else
                     
                   @endif

                     <!-- semester 8  -->
                     @if($sem2_lenght_check>0)
                     
                     @for($i=0; $i<$sem2_lenght_check; $i++)

                   <tr>
                     <td>{{$sem7_course_codes[$i]}}</td>
                     <td class="text-center"> {{$sem7_course_titles[$i]}}</td>
                     <td class="text-center"> {{$sem7_cr_hrs[$i]}}</td>
                     <td class="text-center">100 </td>
                     <td>{{$sem7_obtained_marks[$i]}}</td>
                     <td class="text-center">A</td>
                     <td class="text-center"> {{$sem7_points[$i]}}</td>
                     <td class="text-center">{{$sem7_gp[$i]}} </td>
                   </tr>
                   @endfor

                     @else
                     
                   @endif

                    </tbody>
                </table>


                  <!-- Information  table end  -->
            
                 </div>   <!--card body end -->
               </div>     <!--card for courses  end -->

</body>