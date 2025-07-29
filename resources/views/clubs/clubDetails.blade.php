@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Clubs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Clubs</li>
               
                <li class="breadcrumb-item active">{{ $club_details->Name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
    <div class="card-body">
        <h5 class="card-title text-center text-primary mb-4">{{ $club_details->Name }} CLUB</h5>

        <!-- Club Info Table -->
        <h6 class="text-primary mb-3 text-center"><i class="bi bi-info-circle me-2"></i>Club Details</h6>
        <table class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td class="fw-bold text-primary" style="width: 45%;">Chairperson Name</td>
                    <td>{{ $club_details->Chairperson }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Contact</td>
                    <td>{{ $club_details->Contact }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Email</td>
                    <td>{{ $club_details->Email }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Funding Sources</td>
                    <td>{{ $club_details->Funding_sources }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Registration Status</td>
                    <td>{{ $club_details->Registration_status }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Assets</td>
                    <td>{{ $club_details->Asset }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Capital</td>
                    <td>{{ $club_details->Capital }}</td>
                </tr>
                <tr>
                    <td class="fw-bold text-primary">Quality Assurance Contact</td>
                    <td>{{ $club_details->QA_Contact }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            @if($user_role->role == 'head of center')
                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#EditModal" value="{{ $club_details->id }}">
                    <i class="bi bi-pencil me-1"></i>Edit Club
                </button>
            @endif

            <form action="{{ route('club_members', ['id' => $club_details->id]) }}" method="GET" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-info">
                    <i class="bi bi-people me-1"></i>Members
                </button>
            </form>

            <form action="{{ route('delete_club', $club_details->id) }}" method="POST">
                @csrf
                @method('DELETE') 
                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="confirmAction(event, 'Are you sure you want to delete this club?')">Delete</button>
            </form>
        </div>
    </div>


    <!-- update teacher -->
    <div class="modal fade" id="EditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Club</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('edit_club') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <input type="hidden" name="club_id" id="club_id" value="{{ $club_details->id }}">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Club Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{ $club_details->Name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Name</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="chairId" id="chair_name" data-width=100%
                                            data-live-search="true" required>
                                            <option value="" selected hidden>Open this select menu</option>
                                            @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="chairName" value="{{ $club_details->Chairperson }}" required>
                                    </div>
                                </div> -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Registration Status</label>
                                    <div class="col-sm-10">
                                    <select class="selectpicker" aria-label="Default select example"
                                            name="registration" id="chair_name" data-width=100%
                                            data-live-search="true" required>
                                            <option selected="selected" hidden="hidden" value="{{ $club_details->Registration_status }}">Open this
                                                select menu
                                            </option>
                                            <option value="Registered">Registered</option>
                                            <option value="Not registered">Not registered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Assets</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="assets" id="name" value="{{ $club_details->Asset }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Funding sources</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="funding" value="{{ $club_details->Funding_sources}}" id="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Capital</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="capital" value="{{ $club_details->Capital }}" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Contact with QA</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="QA"
                                            required>
                                            <option selected>{{ $club_details->QA_Contact }}</option>
                                            @if($club_details->QA_Contact == "No")
                                            <option value="Yes">Yes</option>
                                            @else
                                            <option value="No">No</option>
                                            @endif
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
    </div><!-- End of model add new  course-->

    <!-- update teacher model -->

        

</div>
@endsection


@section('scripts')


<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_club/" + id,
        success: function(response) {
            console.log(response);
            // $('#teacher_id').val(id);
            // $('#name').val(response.teacher.name);
            // $('#phone_number').val(response.teacher.phone_number);
            // $('#email').val(response.teacher.email);

        },

    });
});


</script>
@endsection
