@extends('faculty dashboard.faculty master')
@section('dashboard')
<link rel="stylesheet" href="{{asset('faculty files/css/result.css')}}">

<!-- card for  assignment result  start   -->
              
<div id="result" class="card mb-5">
                <span class="card-title text-start mb-2">Assignment result:</span>

                 <div class="card-body">

                  <form> <!-- form of assignment result start  -->


                    <!-- assignment no start  -->

                    <label for="ass_no">Assignment No:</label>
                    <select class="form-select form-select-sm mb-4" aria-label=".form-select-sm example" id="ass_no">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="3">4</option>
                    </select>   
                  <!-- assignment no end  -->

                  <!-- total marks start  -->


                  <div class="input mb-4">
                    <label for="total_marks">Total Marks:</label>
                    <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Enter Total Marks" id="total_marks" value="10">
                  </div>


                  <!-- total marks end  -->

        <!-- date of assignment start  -->
        <div class=" mb-4">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date">
      </div>
        <!-- date of assignment end  -->


                 <!-- assignment resutlt table start  -->

               
                 <table id="result_table" class="table table-striped table-hover">
          
                  <tbody class="mt-5" >
                    <tr>
                      <th class="text-center">Dep</th>
                      <th class="text-center">Programme</th>
                      <th class="text-center">Roll No</th>
                      <th class="text-center">Student Name</th>
                      <th class="text-center">Class</th>
                      <th class="text-center">Sesction</th>
                      <th class="text-center"> Session</th>
                      <th class="text-center">Year</th>
                      <th class="text-center">Obt. Marks</th>

                    </tr>
                    <tr>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="flexRadioDisabled1" id="flexRadioCheckedDisabled" checked disabled>
                          <label class="form-check-label" for="flexRadioCheckedDisabled">
                            CS
                          </label>
                        </div>
                      </td>
                      <th class="text-center">CS</th>
                      <td class="text-center">6291</td>
                      <td class="text-center">Shahzaib Khan</td>
                      <td class="text-center">CS8th</td>
                      <td class="text-center">A</td>
                      <td class="text-center">spring</td>
                      <td class="text-center">2022</td>
                      <td class="text-center">
                        

                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks" value="8">



                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="flexRadioDisabled2" id="flexRadioCheckedDisabled" checked disabled>
                          <label class="form-check-label" for="flexRadioCheckedDisabled">
                            CS
                          </label>
                        </div>
                      </td>
                      <th class="text-center">CS</th>
                      <td class="text-center">6291</td>
                      <td class="text-center">Shahzaib Khan</td>
                      <td class="text-center">CS8th</td>
                      <td class="text-center">A</td>
                      <td class="text-center">spring</td>
                      <td class="text-center">2022</td>
                      <td class="text-center">
                        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks" value="8">

                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="flexRadioDisabled3" id="flexRadioCheckedDisabled" checked disabled>
                          <label class="form-check-label" for="flexRadioCheckedDisabled">
                            CS
                          </label>
                        </div>
                      </td>
                      <th class="text-center">CS</th>

                      <td class="text-center">6291</td>
                      <td class="text-center">Shahzaib Khan</td>
                      <td class="text-center">CS8th</td>
                      <td class="text-center">A</td>
                      <td class="text-center">spring</td>
                      <td class="text-center">2022</td>
                      <td class="text-center">
                        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks" value="6">

                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="flexRadioDisabled4" id="flexRadioCheckedDisabled" checked disabled>
                          <label class="form-check-label" for="flexRadioCheckedDisabled">
                            CS
                          </label>
                        </div>
                      </td>
                      <th class="text-center">CS</th>

                      <td class="text-center">6291</td>
                      <td class="text-center">Shahzaib Khan</td>
                      <td class="text-center">CS8th</td>
                      <td class="text-center">A</td>
                      <td class="text-center">spring</td>
                      <td class="text-center">2022</td>
                      <td class="text-center">
                        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks" value="8">

                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="flexRadioDisabled5" id="flexRadioCheckedDisabled" checked disabled>
                          <label class="form-check-label" for="flexRadioCheckedDisabled">
                            CS
                          </label>
                        </div>
                      </td>
                      <th class="text-center">CS</th>

                      <td class="text-center">6291</td>
                      <td class="text-center">Shahzaib Khan</td>
                      <td class="text-center">CS8th</td>
                      <td class="text-center">A</td>
                      <td class="text-center">spring</td>
                      <td class="text-center">2022</td>
                      <td class="text-center">
                        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks" value="6">

                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="flexRadioDisabled6" id="flexRadioCheckedDisabled" checked disabled>
                          <label class="form-check-label" for="flexRadioCheckedDisabled">
                            CS
                          </label>
                        </div>
                      </td>
                      <th class="text-center">CS</th>

                      <td class="text-center">6291</td>
                      <td class="text-center">Shahzaib Khan</td>
                      <td class="text-center">CS8th</td>
                      <td class="text-center">A</td>
                      <td class="text-center">spring</td>
                      <td class="text-center">2022</td>
                      <td class="text-center">
                        
                        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="obtained marks" value="6">

                      </td>
                    </tr>
                   
                  </tbody>
                </table>

                <input id="submitattendance" type="submit" class="btn btn-success" value="Submit">


                  <!-- Assignment result table end  -->
                </form> <!-- form of assignment result end  -->
                 </div>   <!--card body end -->
               </div>     <!--card for assignment result  end -->

@endsection()