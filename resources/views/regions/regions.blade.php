@extends('home')
@section('contente')
<div class="container">

    <div class="pagetitle">
        <h1>Regions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Regions</li>
                <li class="mx-3 py-0">
                    <div class="search mx-auto">
                        <form action="{{ url('/search_region') }}" method="GET">
                            <input id="search_text" type="text" placeholder="Search" name="search_querry">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>

                        </form>

                    </div>
                </li>
                <li>
                    <div class="my-1 d-flex" id="paginate">
                        <form method="GET" action="{{ url('/regions') }}">
                            <select class="" name="number" id="exampleFormControlSelect1">
                                @if (isset($paginate))
                                <option value="{{ $paginate }}">{{ $paginate }}</option>
                                @endif
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                                <option value="3">5</option>
                                <option value="3">6</option>
                                <option value="3">7</option>
                                <option value="3">8</option>
                                <option value="3">9</option>
                                <option value="3">10</option>
                                <option value="3">11</option>
                                <option value="3">12</option>
                                <option value="3">13</option>
                            </select>

                            <button type="submit">Show</button>

                        </form>

                    </div>


                </li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Region</button>
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
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
                        data-bs-toggle="modal" data-bs-target="#EditModal">Update</button>
                    <button type="button" class="btn btn-outline-danger btn-sm delBtn"
                        value="{{ $region->id }}">Delete</button>
                </td>
                @endcan

            </tr>
            @endforeach


        </tbody>
    </table>
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
                        <button type="submit" class="btn btn-primary">Save </button>

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
                        <button type="submit" class="btn btn-primary">Update </button>

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