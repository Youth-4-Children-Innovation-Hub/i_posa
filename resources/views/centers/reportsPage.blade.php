@extends('home')

@section('contente')
    <div class="pagetitle">
        <h1>Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">reports</li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Upload report</button>
                </li>
            </ol>
        </nav>
    </div>
    @can('is_admin')
    <table class="table table-striped bg-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Report</th>
                <th scope="col">Date</th>
                <th scope="col">sender</th>
                <th scope="col">center</th>
                <th scope="col">role</th>
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $reports)
            <tr>
                <th scope="row"></th>
                <td>{{ $reports->report_name }}</td>
                <td>{{ $reports->date }}</td>
                <td>{{ $reports->hoc_name }}</td>
                <td>{{ $reports->center_name }}</td>
                <td>{{ $reports->role_name }}</td>
                @can('is_hoc')

                <td> 
                <a href="{{ url('/download',$reports->report_name) }}" class="btn btn-outline-primary btn-sm">Download</a>
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
                        <a href="{{ url('/view',$reports->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                    <button type="button" value="{{ $reports->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                </td>
                @endcanany
            </tr>
            @endif
            @endforeach

          

        </tbody>
    </table>
    @endcannot
    @endcanany
    
 

      <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ url('upload_report') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <div class="card-body ">
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input class="form-control" name="file" type="file" id="formFile">
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        
                        <button type="submit" class="btn btn-primary">Upload </button>

                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div><!-- End of model add student-->

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
    </script>
@endsection