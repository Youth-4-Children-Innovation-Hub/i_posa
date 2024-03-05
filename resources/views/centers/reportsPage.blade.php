@extends('home')

@section('contente')
    <div class="pagetitle">
        <h1>Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">reports</li>
                @can('is_hoc')
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
                @endcan
               
            </ol>
        </nav>
    </div>
     <!-- Recent reports -->
     @can('is_dist_cordinator')
     <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th scope="col">Report</th>
                        <th scope="col">Sent by</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $key=>$reports)
                      <tr>
                        <th scope="row"><a href="#">{{ $key+1}}</a></th>
                        <td><a href="{{ url('/view',$reports->id) }}" class="text-primary">{{ $reports->report_name }}</a></td>
                        <td>{{ $reports->hoc_name }} on {{ $reports->date }}</td>
                        @if( $reports->approval == 1 )
                        <td><span class="badge bg-warning">Pending</span></td> 
                        @elseif($reports->approval == 2)
                        <td><span class="badge bg-success">Approved</span></td> 
                        @else
                        <td><span class="badge bg-danger">Rejected</span></td> 
                        @endif 
                        <td>
                        @if( $reports->approval == 1 )
                        <a href="" class="btn btn-outline-success btn-sm approveBtn" data-report-id="{{ $reports->id }}">Approve</a>
                        <button type="button" class="btn btn-outline-danger btn-sm editBtn" value="{{ $reports->id }}"
                        data-bs-toggle="modal" data-bs-target="#remarks">Reject</button>
                        @endif
                        </td>
                    @endforeach    
                      </tr>  
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        @endcan
        @can('is_hoc')
     <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th scope="col">Report</th>
                        <th scope="col">Date sent</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $key=>$reports)
                    @if($reports->hod_id == auth()->user()->id)
                      <tr>
                        <th scope="row"><a href="#">{{ $key+1 }}</a></th>
                        <td><a href="{{ url('/view',$reports->id) }}" class="text-primary">{{ $reports->report_name }}</a></td>
                        <td>{{ $reports->date }}</td>
                        @if( $reports->approval == 1 )
                        <td><span class="badge bg-warning">Pending</span></td> 
                        @elseif($reports->approval == 2)
                        <td><span class="badge bg-success">Approved</span></td> 
                        @else
                        <td><span class="badge bg-danger">Rejected</span></td> 
                        <td><a class="btn btn-outline-success btn-sm seeRemarksBtn" type="button" data-bs-toggle="modal"
                         data-bs-target="#seeRemarks" data-remarks="{{ $reports->remark }}">
                          See remarks</a></td> 
                        @endif 
                      </tr>
                    @endif  
                    @endforeach  
                
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
        @endcan
        <!-- End Recent report -->

    <div class="modal fade" id="remarks" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add remarks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add_remarks') }}" method="post">
                    @csrf
                    <div class="modal-body">
                       
                        <div class="" id="add_region">
                            <div class="card-body ">
                              <div class="row mb-3">
                                      <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                      <div class="col-sm-10">
                                      <textarea id="myTextArea" name="remarks" class="form-control"></textarea>
                                      </div>
                              </div>
                              <input type="hidden" id="remarksId" name="id" value="">
                            </div>
                        </div>    
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add remarks </button>
                    </div>  

                </form>
                
            
            </div>
        </div>
    </div>

    <div class="modal fade" id="seeRemarks" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remarks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                       
                        <div class="" id="add_region">
                            <div class="card-body ">
                              <div class="row mb-3">
                                      <p id="remarksContent"></p>
                              </div>
                            </div>
                        </div>    
                    </div> 
            </div>
        </div>
    </div>
    
  
    

@endsection

@section('scripts')
<script>
    // Use JavaScript to update the content of the modal body
    document.addEventListener('DOMContentLoaded', function () {
        var seeRemarksButtons = document.querySelectorAll('.seeRemarksBtn');

        seeRemarksButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the remarks data from the data-remarks attribute
                var remarksData = button.getAttribute('data-remarks');

                // Set the content of the modal body
                document.getElementById('remarksContent').innerText = remarksData;
            });
        });
    });
</script>
<script>
    // Use JavaScript to update the value of the hidden input field when the button is clicked
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.editBtn');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the value from the clicked button
                var id = button.value;

                // Set the value of the hidden input field in the modal form
                document.getElementById('remarksId').value = id;
            });
        });
    });
</script>
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var approveButtons = document.querySelectorAll('.approveBtn');

        approveButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                // Get the report ID from the data-report-id attribute
                var reportId = button.getAttribute('data-report-id');

                // Display a confirmation dialog
                var confirmation = window.confirm("Are you sure you want to approve this report?");

                // If the user clicks OK, proceed to the approval link
                if (confirmation) {
                    window.location.href = "{{ url('/approve') }}/" + reportId;
                }
            });
        });
    });
</script>

@endsection