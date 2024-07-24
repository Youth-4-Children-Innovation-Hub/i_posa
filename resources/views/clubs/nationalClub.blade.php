@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Clubs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Clubs</li>
    <!-- <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Club</button>
                </li> -->
                

            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                       
                        <th scope="col">Name</th>
                        <th scope="col">Chairperson</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody> 
                    @foreach($clubs as $key => $clubs)    
                    <tr>
                        <td>{{ $clubs->Name }}</td>
                        <td>{{ $clubs->Chairperson }}</td>
                        <td>{{ $clubs->Contact }}</td>
                        <td>
                            <a href="{{ url('club_details', ['id' => $clubs->id]) }}" type="button" class="btn btn-outline-success btn-sm editBtn" value="">View</a>
                            
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
 

    <!-- add new club-->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Club</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Club Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="chairName" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="contact" required>
                                    </div>
                                </div>
                               
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="name" placeholder="optional">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Registration Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="registration" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Assets</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="assets" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Funding sources</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="funding" id="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Capital</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="capital" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Contact with QA</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="QA"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
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
    </div>

    <!-- Add new teacher model -->

   

</div>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addInputField() {
        var inputGroup = $('<div class="input-group mt-2"><input type="text" name="multiInput[]" class="form-control" id="name"><div class="input-group-append"><button class="btn btn-outline-danger" type="button" onclick="removeInputField(this)">Remove</button></div></div>');
        $('#input-container').append(inputGroup);
    }

    function removeInputField(button) {
        $(button).closest('.input-group').remove();
    }
</script>

<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_teacher/" + id,
        success: function(response) {
            console.log(response);
            $('#teacher_id').val(id);
            $('#name').val(response.teacher.name);
            $('#phone_number').val(response.teacher.phone_number);
            $('#email').val(response.teacher.email);

        },

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this Teacher?');
    if (confirmation) {
        // delete it
        var teacher = $(this).val();
        console.log(teacher);

        $.ajax({
            type: 'POST',
            url: '/delete_teacher',
            data: {
                id: teacher
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
