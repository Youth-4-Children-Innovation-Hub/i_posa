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
                        <th scope="col">Coordinator</th>
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

                        <td>
    <div class="d-flex align-items-center gap-2">
        <!-- Edit Icon Button -->
        <button type="button" class="btn btn-outline-primary btn-sm editBtn" value="{{ $region->id }}" data-bs-toggle="modal" data-bs-target="#EditModal" title="Edit Region">
            <i class="bi bi-pencil"></i>
        </button>
        <!-- Delete Icon Button -->
        <button type="button" class="btn btn-outline-danger btn-sm delBtn" value="{{ $region->id }}" title="Delete Region">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</td>
                        @endcan

                    </tr>
                    @endforeach  
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    





    <!-- model add region -->
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Mkoa</label>
                                    <div class="col-sm-10">
                                    <select class="selectpicker" aria-label="Default select example"
                                            name="name" data-width=100% data-live-search="true">
                                            <option selected>Open  select menu</option>
                                            @foreach ($mikoa as $mkoa)
                                            <option value="{{ $mkoa->name }}">{{ $mkoa->name }}</option>
                                            @endforeach

                                        </select>
                                        <!-- <input name="name" type="text" class="form-control"> -->
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Coordinator</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="cordinator" data-width=100% data-live-search="true">
                                            <option selected>Open this select menu</option>
                                            @foreach ($cordinatorsCreate as $cordinator)
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
                                    <label class="col-sm-2 col-form-label">Coordinator</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" id="reg_select" aria-label="Default select example"
                                            name="cordinator" data-width=100% data-live-search="true">
                                            <option value="" disabled>Open this select menu</option>

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

            var $select = $('#reg_select');
            $select.empty();
            $select.append('<option value="" disabled>Open this select menu</option>');

            if (response && response.cordinators && response.cordinators.length) {
                response.cordinators.forEach(function(c) {
                    $select.append('<option value="' + c.id + '">' + c.name + '</option>');
                });
            }

            $select.selectpicker('refresh');
            $select.selectpicker('val', response.region.cordinator_id);
        },
        error: function() {
            if (typeof Swal === 'undefined') {
                alert('Failed to load region details.');
                return;
            }
            Swal.fire({ icon: 'error', title: 'Error!', text: 'Failed to load region details.' });
        }

    });
});

$(document).on('click', '.delBtn', function() {
    var regid = $(this).val();

    if (typeof Swal === 'undefined') {
        var confirmation = confirm('Are you sure you want to delete this region?');
        if (!confirmation) return;

        $.ajax({
            type: 'POST',
            url: '/delete_region',
            data: { id: regid },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response && response.status) {
                    location.reload();
                } else {
                    alert('Failed to delete region.');
                }
            },
            error: function() {
                alert('Failed to delete region.');
            }
        });

        return;
    }

    Swal.fire({
        icon: 'warning',
        title: 'Delete Region?',
        text: 'Are you sure you want to delete this region?',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (!result.isConfirmed) return;

        $.ajax({
            type: 'POST',
            url: '/delete_region',
            data: { id: regid },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response && response.status) {
                    if (typeof Swal === 'undefined') {
                        location.reload();
                        return;
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Region deleted successfully.',
                        showConfirmButton: false,
                        timer: 1200
                    }).then(() => location.reload());
                } else {
                    if (typeof Swal === 'undefined') {
                        alert('Failed to delete region.');
                        return;
                    }
                    Swal.fire({ icon: 'error', title: 'Error!', text: 'Failed to delete region.' });
                }
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Error!', text: 'Failed to delete region.' });
            }
        });
    });
});
</script>
@endsection

@push('styles')
<style>
    .table .btn i {
        pointer-events: none;
    }
    .gap-2 > * + * {
        margin-left: 0.5rem !important;
    }
</style>
@endpush