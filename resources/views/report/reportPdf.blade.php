<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iposa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       
      
        table {
            font-size: 12px; 
        }
        th, td {
            padding: 0.1rem 0.3rem; 
        }
    </style>
</head>
<body>
<h2 style="text-align: center;">INSTITUTE OF ADULT EDUCATION</h2>
    <br><br>
    <div style="text-align: center;"><img src="{{ public_path('assets/img/iae.png') }}" width="125" height="120" style="display: block; border: 0px;"></div>
    <br>
    <div style="text-align: center;"><b><h4>IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</h4></b></div>
    <p> <b>Introduction</b></p>
    <br>
    <p style="text-align: center;"><b>IPOSA coverage in Tanzania by Region and Districts</b></p>
   
    
    <center>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Region</th>
            <th rowspan="2">District</th>
            <th rowspan="2">Number of IPOSA centers</th>
            <th colspan="2">Number of learners</th>
        </tr>
        <tr>
            <th>Males</th>
            <th>Females</th>
        </tr>
    </thead>
    <tbody>
        @php
            $rowNumber = 1;
            $currentRegion = null;
            $currentDistrict = null;
        @endphp

        @foreach ($center_distribution as $distribution)
            <tr>
                {{-- Check if the region is the same as the previous row --}}
                @if ($currentRegion != $distribution->reg_name)
                    <td rowspan="{{ $distribution->district_count }}">{{ $rowNumber }}</td>
                    <td rowspan="{{ $distribution->district_count }}">{{ $distribution->reg_name }}</td>
                    @php
                        $currentRegion = $distribution->reg_name;
                        $rowNumber += $distribution->total_center_count;
                    @endphp
                @endif

               {{-- Check if the district is the same as the previous row --}}
                @if ($currentDistrict != $distribution->dist_name)
                    <td>{{ $distribution->dist_name }}</td>
                    @php $currentDistrict = $distribution->dist_name; @endphp
                <td>{{ $distribution->center_count }}</td>
                <td">jkdjf</td>
                <td>jo</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>


    </center>
    <p style="text-align: center;"><b>IPOSA Learners and the type of training</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Center Name</th> 
                    <th>No. of learners</th>
                    <th>No of learners on Long-term training</th> 
                    <th>No. of learners on short-term training</th>

                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>dar es salaam</td>
                    <td>ilala</td>
                    <td>ilala</td>
                    <td>100</td>
                    <td>100</td>
                    <td>100</td>
                    
                </tr>
                <tr>
                    <td>1</td>
                    <td>mbeya</td>
                    <td>momba</td>
                    <td>momba center</td>
                    <td>100</td>
                    <td>100</td>
                    <td>100</td>
                    
                </tr>
            </tbody>
        </table>
    </center>

    <p style="text-align: center;"><b>IPOSA Centers and the type of trades </b></p>
   
   <center>
   <table class="table table-bordered">
           <thead>
               <tr>
                   <th>No</th>
                   <th>Region</th>
                   <th>District</th>
                   <th>Center Name</th> 
                   <th>Type of trade</th>
                   <th>Existing Equipment</th> 
                   <th>In use equipment</th>

               </tr>
              
           </thead>
           <tbody>
               <tr>
                   <td>1</td>
                   <td>dar es salaam</td>
                   <td>ilala</td>
                   <td>ilala</td>
                   <td>100</td>
                   <td>100</td>
                   <td>100</td>
                   
               </tr>
               <tr>
                   <td>1</td>
                   <td>mbeya</td>
                   <td>momba</td>
                   <td>momba center</td>
                   <td>100</td>
                   <td>100</td>
                   <td>100</td>
                   
               </tr>
               <tr>
                   <td>1</td>
                   <td>mbeya</td>
                   <td>momba</td>
                   <td>momba center</td>
                   <td>100</td>
                   <td>100</td>
                   <td>100</td>
                   
               </tr>
               <tr>
                   <td>1</td>
                   <td>mbeya</td>
                   <td>momba</td>
                   <td>momba center</td>
                   <td>100</td>
                   <td>100</td>
                   <td>100</td>
                   
               </tr>
               <tr>
                   <td>1</td>
                   <td>mbeya</td>
                   <td>momba</td>
                   <td>momba center</td>
                   <td>100</td>
                   <td>100</td>
                   <td>100</td>
                   
               </tr>
               <tr>
                   <td>1</td>
                   <td>mbeya</td>
                   <td>momba</td>
                   <td>momba center</td>
                   <td>100</td>
                   <td>100</td>
                   <td>100</td>
                   
               </tr>
           </tbody>
       </table>
   </center>
   <p style="text-align: center;"><b>IPOSA Learners and stages of Learning</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Center Name</th> 
                    <th>No. of learners of stg 1</th>
                    <th>No of learners of stage 2</th> 
                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>dar es salaam</td>
                    <td>ilala</td>
                    <td>ilala</td>
                    <td>100</td>
                    <td>100</td>           
                </tr>
                <tr>
                    <td>1</td>
                    <td>mbeya</td>
                    <td>momba</td>
                    <td>momba center</td>
                    <td>100</td>
                    <td>100</td> 
                </tr>
            </tbody>
        </table>
    </center>
    <p style="text-align: center;"><b>IPOSA Learners profile</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Center Name</th> 
                    <th>learner's Name</th>
                    <th>learning stage</th> 
                    <th>learning contact</th> 
                    <th>Name of parent/ Guardian</th>
                    <th>Parent Contact</th>  
                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>dar es salaam</td>
                    <td>ilala</td>
                    <td>ilala</td>
                    <td>100</td>
                    <td>100</td> 
                    <td>ilala</td>
                    <td>100</td>
                    <td>100</td> 
                               
                </tr>
                <tr>
                    <td>1</td>
                    <td>mbeya</td>
                    <td>momba</td>
                    <td>momba center</td>
                    <td>100</td>
                    <td>100</td> 
                    <td>ilala</td>
                    <td>100</td>  
                    <td>100</td>  
                </tr>
            </tbody>
        </table>
    </center>

    <p style="text-align: center;"><b>IPOSA Centers and the No. of IPOSA Empowerment Clubs (IECs)</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>No. of IPOSA centers</th> 
                    <th>No. of IECs</th>
                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>dar es salaam</td>
                    <td>ilala</td>
                    <td>ilala</td>
                    <td>100</td>
                    
                    
                </tr>
                <tr>
                    <td>1</td>
                    <td>mbeya</td>
                    <td>momba</td>
                    <td>momba center</td>
                    <td>100</td> 
                </tr>
            </tbody>
        </table>
    </center>

    <p style="text-align: center;"><b>IPOSA IECs Information</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Center Name</th>
                    <th>Name of IECs</th>
                    <th>Registration Status</th> 
                    <th>Chaiperson Name</th>
                    <th>Chaiperson's Contact</th>
                    <th>Asset at IECs</th> 
                    <th>Capital</th>
                    <th>Contact with TBS, TIRDO or SIDO</th>
                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Momba</td>
                    <td>team craft</td>
                    <td>registered</td>
                    <td>gadafi japhaly</td>
                    <td>0755029113</td>
                    <td>jembe, panga</td>
                    <td>5,000,000</td>
                    <td>yes</td>    
                </tr>
                <tr>
                    <td>1</td>
                    <td>Momba</td>
                    <td>team craft</td>
                    <td>registered</td>
                    <td>gadafi japhaly</td>
                    <td>0755029113</td>
                    <td>jembe, panga</td>
                    <td>5,000,000</td>
                    <td>yes</td>    
                </tr>
            </tbody>
        </table>
    </center>

    <p style="text-align: center;"><b>IPOSA facilitators</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Center Name</th> 
                    <th>No. of Facilitators</th>
                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>dar es salaam</td>
                    <td>ilala</td>
                    <td>ilala</td>
                    <td>100</td>
                    
                    
                </tr>
                <tr>
                    <td>1</td>
                    <td>mbeya</td>
                    <td>momba</td>
                    <td>momba center</td>
                    <td>100</td> 
                </tr>
            </tbody>
        </table>
    </center>

    <p style="text-align: center;"><b>IPOSA facilitators profile for each center</b></p>
   
   <center>
   <table class="table table-bordered">
           <thead>
               <tr>
                   <th>No</th>
                   <th>Center Name</th>
                   <th>Name of Facilitator</th>
                   <th>Gender</th> 
                   <th>Qualification</th>
                   <th>Attended ANFE Training</th>
                   <th>Contact</th>
               </tr>
              
           </thead>
           <tbody>
               <tr>
                   <td>1</td>
                   <td>dar es salaam</td>
                   <td>ilala</td>
                   <td>ilala</td>
                   <td>100</td>
                   <td>ilala</td>
                   <td>100</td>
               </tr>
               <tr>
                   <td>1</td>
                   <td>mbeya</td>
                   <td>momba</td>
                   <td>momba center</td>
                   <td>100</td> 
                   <td>ilala</td>
                   <td>100</td>
               </tr>
           </tbody>
       </table>
   </center>
   
    
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


