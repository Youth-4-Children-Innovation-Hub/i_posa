@extends('home')
@section('contente')
<div class="container">

    <div class="pagetitle">
        <h1>Regions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Regions</li>
                

                </li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Region</button>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Regions</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                      <th scope="col">#</th>
                        <th scope="col">Region</th>
                        <th scope="col">Cordinator</th>
                        @can('is_admin')

                        <th scope="col">Action</th>
                        @endcan
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($regions as $key => $region)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $region->region }}</td>
                        <td>{{ $region->name }}</td>
                        @can('is_admin')

                        <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn" value="{{ $region->id }}"
                                data-bs-toggle="modal" data-bs-target="#EditModal">Edit</button>
                            <button type="button" class="btn btn-outline-danger btn-sm delBtn"
                                value="{{ $region->id }}">Delete</button>
                        </td>
                        @endcan

                    </tr>
                    @endforeach  
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    {{ $regions->onEachSide(1)->links() }}





    <!-- model add district -->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Region</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_region') }}">
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
                                    <label class="col-sm-2 col-form-label">Cordinator</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="cordinator" data-width=100% data-live-search="true">
                                            <option selected>Open this select menu</option>
                                            @foreach ($cordinators as $cordinator)
                                            <option value="{{ $cordinator->id }}">{{ $cordinator->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>

                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div><!-- End of model add region-->

    <!-- modal edit region-->
    <div class="modal fade" id="EditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Region</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('edit_region') }}">
                    @csrf

                    <div class="modal-body">

                        <div class="" id="edit_region">
                            <div class="card-body">
                                <input type="hidden" name="region_id" id="region_id">
                                <!-- General Form Elements -->
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" id="name" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Cordinator</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" id="reg_select" aria-label="Default select example"
                                            name="cordinator" data-width=100% data-live-search="true">
                                            <option selected>Open this select menu</option>
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
                        <button type="submit" class="btn btn-primary">Update</button>

                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div><!-- End of model add region-->


</div>
@endsection

@section('scripts')
<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    $.ajax({
        type: "GET",
        url: "/edit_region/" + id,
        success: function(response) {
            console.log(response);
            $('#region_id').val(response.region.id);
            $('#name').val(response.region.name);
            $('#reg_select').val(response.region.cordinator_id);
            $('#reg_select').selectpicker('refresh');
        },

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this region?');
    if (confirmation) {
        // delete it
        var regid = $(this).val();
        console.log(regid);

        $.ajax({
            type: 'POST',
            url: '/delete_region',
            data: {
                id: regid
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                location.reload();
            }
        });
    } else {
        //canceled
    }
});
</script>
@endsection