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
                  <h5 class="card-title">Districts</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">District</th>
                        <th scope="col">Coordinator</th>
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
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- Edit Icon Button -->
                                        <button type="button" class="btn btn-outline-primary btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#EditModal" value="{{ $district->id }}" title="Edit District">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <!-- Delete Icon Button -->
                                        <button type="button" value="{{ $district->id }}" class="btn btn-outline-danger btn-sm delBtn" title="Delete District">
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
        @endcan
        
        @can('is_reg_cordinator')
        @cannot('is_admin')
        <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Districts</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">District</th>
                        <th scope="col">Coordinator</th> 
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
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Region</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" aria-label="Default select example" name="region" id="region_select" required data-width="100%" data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Select a Region</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                    
                                        <select class="form-control selectpicker" aria-label="Default select example" name="wilaya_id" id="district_select" required data-width="100%" data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Select a District</option>
                                        </select>
                                    </div>
                                </div>

                                    <!-- General Form Elements -->
                                    <!-- <div class="row mb-3">
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
                                    </div> -->

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Coordinator</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" aria-label="Default select example"
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
                            <button type="submit" class="btn btn-primary">Add </button>

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
                                    <input type="hidden" name="district_id" id="edit_district_id">

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Region</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" aria-label="Default select example"
                                                name="region" id="edit_region_select" required data-width="100%"
                                                data-live-search="true">
                                                <option selected="selected" hidden="hidden" value="">Select a Region</option>
                                                @foreach (($editRegions ?? []) as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">District</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" aria-label="Default select example"
                                                name="wilaya_id" id="edit_district_select" required data-width="100%"
                                                data-live-search="true">
                                                <option selected="selected" hidden="hidden" value="">Select a District</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Coordinator</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" aria-label="Default select example"
                                                name="cordinator_id" id="edit_cordinator_id" required data-width="100%"
                                                data-live-search="true">                                            
                                                @foreach (($editCordinators ?? $cordinators) as $cordinator)
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
        </div><!-- End of model add district-->



    </div>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        function refreshSelectpicker($el) {
            if ($.fn && $.fn.selectpicker) {
                $el.selectpicker('refresh');
            }
        }

        function resetDistrictSelect($select, message) {
            $select.empty();
            $select.append('<option selected="selected" hidden="hidden" value="">' + (message || 'Select a District') + '</option>');
            refreshSelectpicker($select);
        }

        function warn(message) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'warning', title: 'Warning', text: message });
            }
        }

        function loadDistrictsForRegion(regionId, $select, currentDistrictId, preselectWilayaId) {
            if (!regionId) {
                resetDistrictSelect($select, 'Select a District');
                return;
            }

            resetDistrictSelect($select, 'Loading...');

            var url = '/districts/' + regionId;
            if (currentDistrictId) {
                url += '?district_id=' + encodeURIComponent(currentDistrictId);
            }

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $select.empty();
                    $select.append('<option selected="selected" hidden="hidden" value="">Select a District</option>');

                    if (!data || data.length === 0) {
                        $select.append('<option value="" disabled>(No available districts)</option>');
                        refreshSelectpicker($select);
                        warn('No available districts for the selected region.');
                        return;
                    }

                    $.each(data, function(key, district) {
                        $select.append('<option value="' + district.id + '">' + district.name + '</option>');
                    });

                    if (preselectWilayaId) {
                        $select.val(preselectWilayaId);
                    }
                    refreshSelectpicker($select);
                },
                error: function(xhr, status, error) {
                    console.log('Failed loading districts:', { status: status, error: error, xhr: xhr });
                    resetDistrictSelect($select, 'Failed to load districts');
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load districts. Please try again.' });
                    }
                }
            });
        }

        // bootstrap-select reliably fires `changed.bs.select`
        $(document).on('changed.bs.select change', '#region_select', function() {
            loadDistrictsForRegion($(this).val(), $('#district_select'));
        });

        $(document).on('changed.bs.select change', '#edit_region_select', function() {
            var districtId = $('#edit_district_id').val();
            loadDistrictsForRegion($(this).val(), $('#edit_district_select'), districtId);
        });

        // Initialize empty district list
        resetDistrictSelect($('#district_select'), 'Select a District');
        resetDistrictSelect($('#edit_district_select'), 'Select a District');

        // Edit button: load current district and populate modal
        $(document).on('click', '.editBtn', function() {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/edit_district/" + id,
                success: function(response) {
                    $('#edit_district_id').val(id);

                    // Region (mikoa)
                    $('#edit_region_select').val(response.mikoa_id || '');
                    refreshSelectpicker($('#edit_region_select'));

                    // Coordinator
                    $('#edit_cordinator_id').val(response.district.cordinator_id);
                    refreshSelectpicker($('#edit_cordinator_id'));

                    // District (wilaya)
                    loadDistrictsForRegion(response.mikoa_id, $('#edit_district_select'), id, response.wilaya_id);
                },
                error: function() {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load district details.' });
                    }
                }
            });
        });

        // Delete button with SweetAlert
        $(document).on('click', '.delBtn', function() {
            var districtId = $(this).val();

            function doDelete() {
                $.ajax({
                    type: 'POST',
                    url: '/delete_district',
                    data: { id: districtId },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response && response.status) {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({ icon: 'success', title: 'Deleted', text: 'District deleted successfully.' })
                                    .then(function() { location.reload(); });
                            } else {
                                location.reload();
                            }
                        } else {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to delete district.' });
                            }
                        }
                    },
                    error: function() {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to delete district.' });
                        }
                    }
                });
            }

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will permanently delete the district.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel'
                }).then(function(result) {
                    if (result.isConfirmed) doDelete();
                });
            } else {
                if (confirm('Are you sure you want to delete this district?')) {
                    doDelete();
                }
            }
        });
    });
</script>

@endsection

@push('styles')
<style>
    .table .btn i { pointer-events: none; }
    .gap-2 > * + * { margin-left: 0.5rem !important; }
</style>
@endpush
