@extends('home')
@section('contente')
    <div class="container">

        <div class="pagetitle">
            <h1>Districts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Districts</li>
                   
                    @can('is_reg_cordinator')
                        <li>
                            <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                                data-bs-target="#CreateModal">Add District</button>

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
                        <th scope="col">District</th>
                        <th scope="col">Cordinator</th>
                        <th scope="col">Region</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($districts as $key => $district)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $district->name }}</td>
                            <td>{{ $district->cordinator }}</td>
                            <td>{{ $district->region }}</td>
                            @can('is_reg_cordinator')
                                <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn" data-bs-toggle="modal"
                                        data-bs-target="#EditModal" value="{{ $district->Id }}">Update</button>
                                    <button type="button" value="{{ $district->Id }}"
                                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                                </td>
                            @endcan
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
                        <th scope="col">District</th>
                        <th scope="col">Cordinator</th> 
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($regionDistricts as $key => $district)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $district->name }}</td>
                            <td>{{ $district->cordinator }}</td>
                        </tr>
                    @endforeach
                   
                    </tbody>
                  </table>

                </div>

              </div>
        </div>
        @endcannot
        @endcan

        <!-- model add district -->

        <div class="modal fade" id="CreateModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add District</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('create_district') }}">
                        @csrf

                        <div class="modal-body">

                            <div class="" id="add_region">
                                <div class="card-body">

                                    <!-- General Form Elements -->
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Region</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example"
                                                name="region_id" required data-width=100% data-live-search="true">
                                                <option selected="selected" hidden="hidden" value="">Open this select
                                                    menu
                                                </option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Cordinator</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example"
                                                name="cordinator_id" required data-width=100% data-live-search="true">
                                                <option selected="selected" hidden="hidden" value="">Open this
                                                    select menu
                                                </option>
                                                @foreach ($cordinators as $cordinator)
                                                    <option value="{{ $cordinator->id }}">{{ $cordinator->name }}
                                                    </option>
                                                @endforeach

                                            </select>
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
        </div><!-- End of model add district-->


        <!-- model edit district -->

        <div class="modal fade" id="EditModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update District</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('update_district') }}">
                        @csrf

                        <div class="modal-body">

                            <div class="" id="add_region">
                                <div class="card-body">
                                    <input type="hidden" name="district_id" id="district_id">
                                    <!-- General Form Elements -->
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Region</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example"
                                                name="region_id" id="region_id" required data-width=100%
                                                data-live-search="true">
                                                <option selected="selected" hidden="hidden" value="">Open this
                                                    select menu
                                                </option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Cordinator</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" aria-label="Default select example"
                                                name="cordinator_id" id="cordinator_id" required data-width=100%
                                                data-live-search="true">
                                                <option selected="selected" hidden="hidden" value="">Open this
                                                    select menu
                                                </option>
                                                @foreach ($cordinators as $cordinator)
                                                    <option value="{{ $cordinator->id }}">{{ $cordinator->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
        </div><!-- End of model add district-->



    </div>
@endsection


@section('scripts')
    <script>
        $(document).on('click', '.editBtn', function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                type: "GET",
                url: "/edit_district/" + id,
                success: function(response) {
                    console.log(response);
                    $('#region_id').val(response.district.region_id);
                    $('#region_id').selectpicker('refresh');
                    $('#name').val(response.district.name);
                    $('#district_id').val(id);
                    $('#cordinator_id').val(response.district.cordinator_id);
                    $('#cordinator_id').selectpicker('refresh');
                },

            });
        });

        $('.delBtn').on('click', function() {
            var confirmation = confirm('Are you sure you want to delete this district?');
            if (confirmation) {
                // delete it
                var course_center = $(this).val();
                console.log(course_center);

                $.ajax({
                    type: 'POST',
                    url: '/delete_district',
                    data: {
                        id: course_center
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
