@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Teachers</li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Teacher</button>
                </li>
                

            </ol>
        </nav>
    </div><!-- End Page Title -->

  
  
    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers1 as $key => $teachers1)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $teachers1->name1 }}</td>
                        <td>{{ $teachers1->email1 }}</td>
                        <td>{{ $teachers1->phone_number1 }}</td>
                        @can('is_hoc')

                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal" value="{{ $teachers1->id }}"
                                class="btn btn-outline-primary btn-sm editBtn">Update</button>
                            <button type="button" value="{{ $teachers1->id }}"
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


    <!-- add new teacher -->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_teacher') }}">
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="gender"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Qualification</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="qualification" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Attended ANFE</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="anfe"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" required>
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

    <!-- update teacher -->
    <div class="modal fade" id="EditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_teacher') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <input type="hidden" name="teacher_id" id="teacher_id">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                            required>
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