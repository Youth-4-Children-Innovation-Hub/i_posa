@extends('home')

@section('contente')
    <div class="pagetitle">
        <h1>Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">reports</li>
                <li>
                    <form action="{{ route('centerReport') }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" >Preview Report</button>
                    </form>
               
                </li>
                <li>
                    <form action="{{ url('upload_center_report') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1">Upload Report</button>
                    </form>
                </li>
               
            </ol>
        </nav>
    </div>
     <!-- Recent Sales -->
     <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
    
    @can('is_admin')
    <table class="table table-borderless bg-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th></th>
                <th scope="col">Report</th>
                <th scope="col">Date</th>
                <th scope="col">sender</th>
               
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $key=>$reports)
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                @if($reports->status == 'New') 
                <td><span class="badge bg-success">{{ $reports->status }}</span></td>
                @else
                <td><span class="badge bg-secondary"><i class="bi bi-check-circle me-1"></i> {{ $reports->status }}</span></td>
                @endif
                <td>{{ $reports->report_name }}</td>
                <td>{{ $reports->date }}</td>
                <td>{{ $reports->hoc_name }} - {{ $reports->role_name }} at {{ $reports->center_name }}</td>
               
                @can('is_hoc')

                <td> 
                
                        <a href="{{ url('/view',$reports->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                    <button type="button" value="{{ $reports->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                </td>
                @endcan
            </tr>
            @endforeach
            
        </tbody>
    </table>
    @endcan

    @canany(['is_hoc', 'is_reg_cordinator', 'is_dist_cordinator'])
    @cannot('is_admin')
    <table class="table table-striped bg-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Report</th>
                <th scope="col">Upload Date</th>
                
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $reports)
            @if($reports->id1 == Auth::user()->id)
            <tr>
                <th scope="row"></th>
                <td>{{ $reports->report_name }}</td>
                <td>{{ $reports->date }}</td>
                
                @canany(['is_hoc', 'is_reg_cordinator', 'is_dist_cordinator'])

                <td> 
                  <!-- <button type="button" value=""
                        class="btn btn-outline-primary btn-sm delBtn">Download</button> -->
                        <a href="{{ url('/download',$reports->report_name) }}" class="btn btn-outline-primary btn-sm">Download</a>
                       
                    <!-- <button type="button" value="{{ $reports->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button> -->
                </td>
                @endcanany
            </tr>
            @endif
            @endforeach

          

        </tbody>
    </table>
    @endcannot
    @endcanany
    

@endsection

@section('scripts')
    <script>
        $('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this report?');
    if (confirmation) {
        // delete it
        var report = $(this).val();
        console.log(report);

        $.ajax({
            type: 'POST',
            url: '/delete_report',
            data: {
                id: report
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    } else {
        //canceled
    }
});


function changeStatus(link) {
    // Change the badge content and class
    var statusBadge = document.getElementById('status-badge');
    statusBadge.innerHTML = '<span class="badge bg-warning">Pending</span>';

    // Send an AJAX request to update the status in the database
    // Assuming you're passing the report ID from your Laravel view
   
    // fetch('/update-status/' + reportId)
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.success) {
    //             console.log('Status updated in the database.');
    //         }
    //     });
}

    </script>
@endsection