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
    <div style="text-align: center;">
        <img src="{{ public_path('assets/img/iae.png') }}" width="125" height="120" style="display: block; border: 0px;">
    </div>
    <br>
    <div style="text-align: center;"><b><h4>IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</h4></b></div>
    <p><b>Introduction</b></p>
    <br>
    <p style="text-align: center;"><b>Students Summary, at {{ $centerName }}</b></p>

    <!-- Summary Section -->
    <div style="margin: 20px;">
        <p><b>Center Name:</b> {{ $center->name}}</p>
        <p><b>Head of Center:</b> {{ Auth::user()->name }}</p>
        <p><b>Total Students:</b> {{ $totalStudents }}</p>
        <p><b>Male Students:</b> {{ $maleCount }}</p>
        <p><b>Female Students:</b> {{ $femaleCount }}</p>
        <!-- <p><b>Disabled Students:</b> {{ $disabledCount }}</p> -->
        <p><b>Dropouts:</b> {{ $dropoutCount }}</p>
    </div>
    
    <center>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Phone </th> 
                <th>Gender</th>
                <th>Disability</th> 
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ ucfirst($student->gender) }}</td>
                <td>{{ $student->disability }}</td>
                <td>{{ ucfirst($student->status) }}</td>
            </tr>
            @endforeach   
        </tbody>
    </table>
    </center>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
