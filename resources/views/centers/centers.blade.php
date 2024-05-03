@extends('home')
@section('contente')
    <div class="container">

        <div class="pagetitle">
            <h1>Centers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Centers</li>

                   
                    @can('is_reg_cordinator')
                        <li>
                            <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                                data-bs-target="#CreateModal">Add Center</button>
                        </li>
                    @endcan

                </ol>
            </nav>
        </div><!-- End Page Title -->
        @can('is_admin')
        <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Head of Center</th>
                        <th scope="col">Location</th>
                        <th scope="col">Ownership</th>
                        <th scope="col">Funders</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($centers as $key => $center)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>

                            <td>{{ $center->name }}</td>
                            <td>{{ $center->hod }}</td>
                            <td>{{ $center->district }}, {{ $center->region }}</td>
                            <td>{{ $center->Ownership }}</td>
                            <td>{{ $center->Funders }}</td>
                            <td> <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal"
                                    value="{{ $center->id }}" class="btn btn-outline-primary btn-sm editBtn">Update</button>
                                <button type="button" value="{{ $center->id }}"
                                    class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
         @endcan

         @can('is_reg_cordinator')
         @cannot('is_admin')
         <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Head of Center</th>
                        <th scope="col">District</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($regionCenters as $key => $regionCenters)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>

                            <td>{{ $regionCenters->name }}</td>
                            <td>{{ $regionCenters->hod }}</td>
                            <td>{{ $regionCenters->district }}</td>
                          
                        </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            @endcannot
         @endcanany

         @can('is_dist_cordinator')
         @cannot('is_admin')
         <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Head of Center</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($districtCenters as $key => $centers)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th> 
                            <td>{{ $centers->name }}</td>
                            <td>{{ $centers->hod }}</td>   
                        </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            @endcannot
         @endcan

        <!-- model add center-->

        <div class="modal fade" id="CreateModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Center</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('create_center') }}">
                        @csrf

                        <div class="modal-body">

                            <div class="" id="add_region">
                                <div class="card-body">
                                    <!-- General Form Elements -->
                                    <div class=" row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input name="name" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Head of Center</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example" name="hod"
                                                data-width=100% data-live-search="true">
                                                <option selected>Open this select menu</option>
                                                @foreach ($heads as $head)
                                                    <option value="{{ $head->id }}">{{ $head->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">District</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example"
                                                name="district" data-width=100% data-live-search="true">
                                                <option selected>Open this select menu</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Ownership</label>
                                        <div class="col-sm-10">
                                            <input name="ownership" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class=" row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Funders</label>
                                        <div class="col-sm-10">
                                            <input name="funders" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save </button>

                        </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>
        </div><!-- End of model add center-->


        <!-- model edit center-->

        <div class="modal fade" id="EditModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Center</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('update_center') }}">
                        @csrf

                        <div class="modal-body">

                            <div class="" id="add_region">
                                <input type="hidden" name="center_id" id="center_id">
                                <div class="card-body">
                                    <!-- General Form Elements -->
                                    <div class=" row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input name="name" id="name" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Head of Center</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example"
                                                id="hod" name="hod" data-width=100% data-live-search="true">
                                                <option selected>Open this select menu</option>
                                                @foreach ($heads as $head)
                                                    <option value="{{ $head->id }}">{{ $head->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">District</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example" id=district
                                                name="district" data-width=100% data-live-search="true">
                                                <option selected>Open this select menu</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Ownership</label>
                                        <div class="col-sm-10">
                                            <input name="ownership" id="ownership" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class=" row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Funders</label>
                                        <div class="col-sm-10">
                                            <input name="funders" id="funders" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update </button>

                        </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>
        </div><!-- End of model add center-->



    </div>
    <script></script>
@endsection



@section('scripts')
    <script>
        $(document).on('click', '.editBtn', function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                type: "GET",
                url: "/edit_center/" + id,
                success: function(response) {
                    console.log(response);
                    $('#center_id').val(id);
                    $('#name').val(response.center.name);
                    $('#hod').val(response.center.hod_id);
                    $('#ownership').val(response.center.Ownership);
                    $('#funders').val(response.center.Funders);
                    $('#hod').selectpicker('refresh');

                    $('#district').val(response.center.district_id);
                    $('#center').selectpicker('refresh');
                },

            });
        });

        $('.delBtn').on('click', function() {
            var confirmation = confirm('Are you sure you want to delete this center?');
            if (confirmation) {
                // delete it
                var center = $(this).val();
                console.log(center);

                $.ajax({
                    type: 'POST',
                    url: '/delete_center',
                    data: {
                        id: center
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
