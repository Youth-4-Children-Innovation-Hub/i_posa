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
    
    <br>
    <p style="text-align: center;"><b>Students Summary in {{strtoupper($district->name)}} District</b></p>

    <!-- Summary Section -->
    <div style="margin: 20px;">
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th>District</th>
                <th>Head of District</th>
                <th>Total Inventories</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$district->name}}</td>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ $inventoriesCount }}</td>
                
                
            </tr>
        </tbody>
    </table>
</div>

    
    <center>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Center</th>
                
                
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $index => $inventory)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->course }}</td>
                <td>{{ $inventory->center }}</td>
                
                
            </tr>
            @endforeach   
        </tbody>
    </table>
    <div style="position: absolute; bottom: 10px; right: 10px; font-size: 12px;">
   <b> Generated on: {{ now()->format('Y-m-d H:i:s') }} by {{ Auth::user()->name }}</b>
</div>

    </center>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
