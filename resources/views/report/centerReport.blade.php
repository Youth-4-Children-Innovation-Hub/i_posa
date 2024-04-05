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
    <div style="text-align: center;"><b><h4>THREE MONTHS IMPLEMENTATION REPORT FOR IPOSA CENTERS</h4></b></div>
    <p> <b>1.0Introduction</b></p>
    <p>{{ $challenge->introduction }}</p>
    <br>
  
    <p><b>IPOSA Ownership and Funders</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>Name of the Center</th>
                    <th>Ownership</th>
                    <th>Funders</th>                 
                </tr>  
            </thead>
            <tbody>
                @foreach($owner_funder as $owner_funder)
                    <td>1</td>
                    <td>{{$owner_funder->name}}</td>
                    <td>{{$owner_funder->Ownership}}</td>
                    <td>{{$owner_funder->Funders}}</td>
                @endforeach
            </tbody>
        </table>
    </center>

    <p><b>3:0 IPOSA Learners </b></p>
   
   <center>
   <table class="table table-bordered">
           <thead>
               <tr>
                   <th>No.</th>
                   <th>Name Of the Center</th>
                   <th>Number Of Learners</th>
                   <th>Males</th> 
                   <th>Females</th>
                  
               </tr>
              
           </thead>
           <tbody>
               <tr>
                   <td>1</td>
                   <td>{{$owner_funder->name}}</td>
                   <td>{{$learnersCount}}</td>
                   <td>{{$malesCount}}</td>
                   <td>{{$femalesCount}}</td>  
               </tr>
          
           </tbody>
       </table>
   </center>
   <p><b>3:1 IPOSA Learners and stages of Learning</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>Name Of The Center</th>
                    <th>NO. of Learners stg 1</th>
                    <th>NO. of Learners without 3Rs</th>
                    <th>NO. of learners stage 11</th> 
                </tr>
               
            </thead>
            <tbody>
                <tr>
                   
                    <td>1</td>
                    <td>{{$owner_funder->name}}</td>
                    <td>{{ $stage1Students }}</td>
                    <td>{{ $without3rs }}</td>
                    <td>{{ $stage2Students }}</td>
                            
                </tr>
            </tbody>
        </table>
    </center>
    <p><b>3:2 IPOSA Learners and the type of training</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Name of the Center</th>
                    <th>No. of Learners</th>
                    <th>No. of Learners on Long-term training</th> 
                    <th>No. of Learners on Short-term training</th>
                    
                </tr>
               
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$owner_funder->name}}</td>
                    <td>{{$learnersCount}}</td>
                    <td>{{ $longTerm }}</td>
                    <td>{{ $shortTerm }}</td>
                       
                </tr>
             
            </tbody>
        </table>
    </center>

    <p><b>3:3 IPOSA Learners profile</b></p>
   
   <center>
   <table class="table table-bordered">
           <thead>
               <tr>
                   <th>NO</th>
                   <th>Name of the Center</th>
                   <th>Learners Name</th>
                   <th>Learning stage</th> 
                   <th>Learners contact</th>
                   <th>Name of Parent/ Guardian</th> 
                   <th>Parent contact</th>
               </tr>
           </thead>
           <tbody>
           @php
            $centerName = null; // Initialize centerName variable
           @endphp
              
                @foreach($allLearners as $learner)
                <tr>
                
                   @if ($centerName != $learner->center_name)
                   <td rowspan="{{ $allLearners->where('center_name', $learner->center_name)->count() }}">1</td>
                    <td rowspan="{{ $allLearners->where('center_name', $learner->center_name)->count() }}">
                        {{ $learner->center_name }}
                    </td>
                    @php
                        $centerName = $learner->center_name; // Update centerName
                    @endphp
                   @endif
                   <td>{{ $learner->name }}</td>
                   <td>{{ $learner->stage }}</td>
                   <td>{{ $learner->phone_number }}</td>
                   <td>{{ $learner->parent }}</td>   
                   <td>100</td>
                   </tr>
                @endforeach   
              
            
           </tbody>
       </table>
   </center>

   <p><b>5.0 IPOSA Facilitators</b></p>
   
   <center>
   <table class="table table-bordered">
           <thead>
               <tr>
                   <th>NO</th>
                   <th>Name of the Center</th>
                   <th>Name of facilitator</th>
                   <th>Qualifications</th> 
                   <th>Current employer</th>
               </tr>
           </thead>
           <tbody>
            @foreach($facilitators as $facilitator)
               <tr>
                   <td>1</td>
                   <td>Chitete</td>
                   <td>{{ $facilitator->name }}</td>
                   <td>{{ $facilitator->qualification }}</td>
                   <td>dfids</td>
               </tr>
            @endforeach
           </tbody>
       </table>
   </center>

   

   <p><b>5.0 IPOSA Centers and the type of trades</b></p>
   
   <center>
   <table class="table table-bordered">
           <thead>
               <tr>
                   <th>NO</th>
                   <th>Name of the Center</th>
                   <th>Type of trade</th>
                   <th>Existing Equipment</th> 
                   <th>In use Equipment</th>
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
            
           </tbody>
       </table>
   </center>
   

    <p><b>6:0 IPOSA Centers and the IPOSA Empowerment Clubs (IECs)</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Name of the Center</th>
                    <th>Name of the Empowerment Club</th>
                    <th>Funding Sources</th> 
                </tr>
            </thead>
            <tbody>
                @php
                    $centerName = null; // Initialize centerName variable
                @endphp
           
                @foreach($club1 as $club)
                
                <tr>
                    <td>1</td>
                    @if($centerName != $club->center)
                    <td rowspan="{{ $club1->where('center', $club->center)->count(); }}">{{ $club->center }}</td>
                    @php
                        $centerName = $club->center; // Update centerName
                    @endphp
                    @endif
                    <td>{{ $club->club_name }}</td>
                    <td>{{ $club->funding }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </center>

    <p><b>6:1 IPOSA Empowerment Clubs Information(IECs)</b></p>
   
    <center>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Name of the Center</th>
                    <th>Name of IEC</th> 
                    <th>Registration Status</th>
                    <th>Chaiperson Name</th>
                    <th>Chaiperson's Contact</th>
                    <th>Asset at IECs</th> 
                    <th>Capital</th>
                    <th>Contact with TBS, TIRDO or SIDO</th>
                </tr>
               
            </thead>
            <tbody>
                @php
                    $centerName = null; // Initialize centerName variable
                @endphp
                @foreach($clubInfo as $info)
                <tr>
                @if($centerName != $info->center)
                    <td rowspan="{{ $clubInfo->where('center', $info->center)->count(); }}">1</td>
                    <td rowspan="{{ $clubInfo->where('center', $info->center)->count(); }}">{{ $info->center }}</td>
                    @php
                        $centerName = $info->center; // Update centerName
                    @endphp
                @endif
                    <td>{{ $info->club_name }}</td>
                    <td>{{ $info->Registration_status }}</td>
                    <td>{{ $info->Chairperson }}</td>
                    <td>{{ $info->Contact }}</td>
                    <td>{{ $info->Asset }}</td>
                    <td>{{ $info->Capital }}</td>
                    <td>{{ $info->QA_Contact }}</td>    
                </tr>
                @endforeach
            </tbody>
        </table>
    </center>

    <p><b>7.0 Challenges and the way to overcome those challenges</b></p>
    @php
        $string = "1.dfkhsdhfs\n2.dhifsdfisdfsd\n3.hfdjsfhisdfs";
        $lines = preg_split('/^\d+\./m', $string, -1, PREG_SPLIT_NO_EMPTY);
    @endphp
    @foreach ($lines as $key => $line)
        <p>{{ $key + 1 }}. {{ $line }}</p>
    @endforeach
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


